<?php
include('session.php');
$login_user = $_SESSION['login_user'];
$connection = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=password");
	
$error='';

if(isset($_POST['search'])) {
	$search = $_POST['q'];
	$query = pg_query($connection, "SELECT m.task_id, m.user_id AS owner, m.task_title, m.description, m.status, m.date, m.start_time, m.end_time, b.user_id AS bidder, (CASE WHEN b.amount is null then 0 else b.amount END) AS amount
		from task_bid_by b right outer join task_managed_by m ON m.task_id = b.task_id
		WHERE (b.amount >= (select max(b2.amount) from task_bid_by b2 where b2.task_id = b.task_id GROUP BY b2.task_id)
		OR b.amount is null)
		AND m.task_title LIKE '%{$search}%'
		GROUP BY m.task_id, m.user_id, m.task_title, m.description, m.status, m.date, m.start_time, m.end_time, b.user_id, b.amount
		ORDER BY m.status DESC, m.task_id ASC, b.amount DESC");
	$rows = pg_num_rows($query);
	if ($rows=0)
	{
		$error = 'Invalid query provided, please try again!';
	}
}

if (isset($_POST['submit'])) {
    $bid_amount = $_POST['bid'];
    $taskid = $_POST['task_id'];
    $userid = $_SESSION['login_user'];
    $add_task = pg_query($connection, "INSERT INTO task_bid_by(task_id, user_id, amount) VALUES( 
										'$taskid', '$userid', '$bid_amount')");
    if ($add_task) {
        header("location: profile.php");
    } else {
        $error = 'Invalid query provided, please try again!';
    }
}

if (isset($_POST['update'])) {
    $task_description = $_POST['task_description'];
    $taskid = $_POST['task_id'];
	$task_title = $_POST['task_title'];
	$task_date = $_POST['task_date'];
	$task_starttime = $_POST['task_starttime'];
	$task_endtime = $_POST['task_endtime'];
    $update_task = pg_query($connection, "UPDATE task_managed_by SET task_title='$task_title', description='$task_description', date='$task_date', start_time='$task_starttime', end_time='$task_endtime'
												WHERE task_id='$taskid' ");
    if ($update_task) {
        header("location: profile.php");
    } else {
        $error = 'Invalid query provided, please try again!';
    }
}

if (isset($_POST['close'])) {
	//Find winning bidder_id
    $amount = $_POST['amount'];
    $task_id = $_POST['task_id'];
	$bidQuery = pg_query($connection, "SELECT user_id FROM task_bid_by
										WHERE task_id='$task_id' AND amount='$amount'");
	
	if ($bidQuery) {
        $row = pg_fetch_row($bidQuery);
		$bidder_id = $row[0];
    } else {
        $error = 'Invalid query provided, please try again!';
    }

	$update_task = pg_query($connection, "UPDATE task_managed_by SET winning_bid='$amount', winner = '$bidder_id', status = 'completed'
												WHERE task_id='$task_id' ");

	if ($update_task) {
        header("location: profile.php");
    } else {
        $error = 'Invalid query provided, please try again!';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">TaskSource</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="profile.php"> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="bids.php"> My Bids <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="createtask.php"> Create New <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="tasks.php"> All Tasks <span class="sr-only">(current)</span></a>
            </li>
        </ul>

        <a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">Logout</a>

    </div>
</nav>

<div class="container" style="padding-top: 30px"></div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous">
</script>

		<form method="POST" action="search.php">
			<input type="text" name="q" placeholder="Search for task title">
			<input type="submit" name="search" value="Search">
		</form>
<?php		
		$i = 0;
			// output data of each row
			while($row = pg_fetch_array($query)) {
				$i++;
				$task_owner = $row['owner'];
				$task_title = $row['task_title'];
				$task_status = $row['status'];
				$task_date = $row['date'];
				$task_starttime = $row['start_time'];
				$task_endtime = $row['end_time'];
				$task_description = $row['description'];
				$task_id = $row['task_id'];
				$amount = $row['amount'];


				echo "
				<div class='container' style='padding: 30px 0'>
				<div class=\"list-group\">
					<button type=\"button\" class=\"list-group-item list-group-item-action list-group-item-primary\">Task Title: " . $task_title . " <span class='badge badge-danger' style='margin-left: 15px'>" . $task_status . "</span></button>
					<button type=\"button\" class=\"list-group-item list-group-item-action\">Description: " . $task_description . "</button>
					<button type=\"button\" class=\"list-group-item list-group-item-action\">Date: " . $task_date . "</button>
					<button type=\"button\" class=\"list-group-item list-group-item-action\">Start Time: " . $task_starttime . "</button>
					<button type=\"button\" class=\"list-group-item list-group-item-action\">End Time: " . $task_endtime . "</button>
					<button type=\"button\" class=\"list-group-item list-group-item-action\">Task Owner: " . $task_owner . "</button>
					<button type=\"button\" class=\"list-group-item list-group-item-action\">Current Bid: $" . $amount . "</button>
    
				</div>";

				if ($login_user != $task_owner) {
				echo "
				<button id='addbidbutton".$i."' type='button' class='btn btn-success'>Add bid</button>
						<script type='text/javascript'>
							$('#addbidbutton".$i."').on('click', function (e) {
								 var modal = document.getElementById('addbid".$i."');
								 modal.style.display = 'inline-block';
							})
						</script>
						<div style='display:none' id='addbid".$i."' >
							<form action='' method='post'>
							<div class='container'>
							  <input type='hidden' id='task_id' name='task_id' value='".$task_id."'>
							  <input type='hidden' id='user_id' name='user_id' value='".$task_owner."'>
							  <div class='form-group'>
							  <div class='form-row'>
								<input type='text' class='form-control' placeholder='Enter Bid Amount' name='bid' required>
								<button class='btn btn-danger' name='submit' type='submit' >Submit Bid</button>
							  </div>
							  </div>
							  <span>".$error."</span>
							</div>
						  </form>
						</div>";}
				else {
						echo"
						<button id='editbutton".$i."' type='button' class='btn btn-success'>Edit</button>
							<script type='text/javascript'>
								$('#editbutton".$i."').on('click', function (e) {
									 var modal = document.getElementById('edit".$i."');
									 modal.style.display = 'inline-block';
								})
							</script>
							<div style='display:none' id='edit".$i."' >
								<form action='' method='post'>
								<div class='container'>
								  <input type='hidden' id='task_id' name='task_id' value='".$task_id."'>
								  <div class='form-group'>
								  <div class='form-row'>
									<input type='text' class='form-control' name='task_title' value='".$task_title."' required>
									<input type='text' class='form-control' name='task_description' value='".$task_description."' required>
									<input type='date' class='form-control' name='task_date' value='".$task_date."' required>
									<input type='time' class='form-control' name='task_starttime' value='".$task_starttime."' required>
									<input type='time' class='form-control' name='task_endtime' value='".$task_endtime."' required>
									<button class='btn btn-danger' name='update' type='submit' >Submit</button>
								  </div>
								  </div>
								  <span>".$error."</span>
								</div>
							  </form>
							</div>

							<form action='' method='post'>
							<div class='container'>
								<input type='hidden' id='task_id' name='task_id' value='".$task_id."'>
								<input type='hidden' id='amount' name='amount' value='".$amount."'>
								<div class='form-group'>
								<div class='form-row'>
								<button class='btn btn-success' name='close' type='submit' >Close</button>
								</div>
								</div>
								<span>".$error."</span>
							</div>
							</form>

				  </div>
				</div>";}
			}
	?>
	</body>
</html>