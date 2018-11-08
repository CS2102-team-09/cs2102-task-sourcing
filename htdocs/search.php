<?php
include('session.php');
include('./components/profile_header.php');
$login_user = $_SESSION['login_user'];
$connection = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=postgres");
$error = '';
$error_message = "";

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

if (isset($_POST['search'])) {
    $search = $_POST['q'];
    $search = strtolower($search);
    $query = pg_query($connection, "SELECT m.task_id, m.user_id AS owner, m.task_title, m.description, m.status, m.date, m.start_time, m.end_time, b.user_id AS bidder, (CASE WHEN b.amount is null then 0 else b.amount END) AS amount
		from task_bid_by b right outer join task_managed_by m ON m.task_id = b.task_id
		WHERE (b.amount >= (select max(b2.amount) from task_bid_by b2 where b2.task_id = b.task_id GROUP BY b2.task_id)
		OR b.amount is null)
		AND lower(m.task_title) LIKE '%{$search}%'
		GROUP BY m.task_id, m.user_id, m.task_title, m.description, m.status, m.date, m.start_time, m.end_time, b.user_id, b.amount
		ORDER BY m.status DESC, m.task_id ASC, b.amount DESC");
}
if (isset($_POST['submit'])) {
    $bid_amount = $_POST['bid'];
    $taskid = $_POST['task_id'];
    $userid = $_SESSION['login_user'];
    set_error_handler(function($errno, $errstr) use( &$error_message) { $error_message = $errstr; });
    $add_task = pg_query($connection, "INSERT INTO task_bid_by(task_id, user_id, amount) VALUES( 
										'$taskid', '$userid', '$bid_amount')");
    restore_error_handler();
    $error_message = get_string_between($error_message, 'ERROR: ', 'CONTEXT:');

    if ($add_task) {
        header("location: profile.php");
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button> '. $error_message .'
			</div>';
    }
}
if (isset($_POST['update'])) {
    $task_description = $_POST['task_description'];
    $taskid = $_POST['task_id'];
    $task_title = $_POST['task_title'];
    $task_date = $_POST['task_date'];
    $task_starttime = $_POST['task_starttime'];
    $task_endtime = $_POST['task_endtime'];

    set_error_handler(function($errno, $errstr) use( &$error_message) { $error_message = $errstr; });
    $update_task = pg_query($connection, "UPDATE task_managed_by SET task_title='$task_title', description='$task_description', date='$task_date', start_time='$task_starttime', end_time='$task_endtime'
												WHERE task_id='$taskid' ");
    restore_error_handler();
    $error_message = get_string_between($error_message, 'ERROR:', 'CONTEXT:');
    $error_message = str_replace(array("\r", "\n"), '', $error_message);

    if ($update_task) {
        header("location: profile.php");
    } else {
//        $error = 'Invalid query provided, please try again!';
        $error_message = (strpos($error_message, 'A user cannot be at two places at once!') !== false)? 'A user cannot be at two places at once!' : 'Some fields were filled out incorrectly. Please try again.';
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			  '. $error_message .'
			</div>';
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

<div class="container" style="padding-top: 30px">
    <form method="POST" action="search.php">
        <div class="form-group row">
            <input class="form-control" type="text" name="q" placeholder="Search for task title">
        </div>
        <div class="form-group row">
            <input class="bg-success border-success" type="submit" name="search" value="Search">
        </div>
    </form>
</div>
<?php
$i = 0;
// output data of each row
while ($row = pg_fetch_array($query)) {
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
				</div>
				<div class='container' style='padding-top: 30px;'>
				<div class=\"list-group\">
					<button type=\"button\" class=\"list-group-item list-group-item-action list-group-item-primary\">Task Title: " . $task_title . " ";
					
					if ($task_status == 'no_bids') {echo"<span class='badge badge-danger' style='margin-left: 15px'>" . $task_status . "</span></button>";}
					else if ($task_status == 'in_progress') {echo"<span class='badge badge-warning' style='margin-left: 15px'>" . $task_status . "</span></button>";}
					else {echo"<span class='badge badge-success' style='margin-left: 15px'>" . $task_status . "</span></button>";}
					
					echo"
					<button type=\"button\" class=\"list-group-item list-group-item-action\">Description: " . $task_description . "</button>
					<button type=\"button\" class=\"list-group-item list-group-item-action\">Date: " . $task_date . "</button>
					<button type=\"button\" class=\"list-group-item list-group-item-action\">Start Time: " . $task_starttime . "</button>
					<button type=\"button\" class=\"list-group-item list-group-item-action\">End Time: " . $task_endtime . "</button>
					<button type=\"button\" class=\"list-group-item list-group-item-action\">Task Owner: " . $task_owner . "</button>
					<button type=\"button\" class=\"list-group-item list-group-item-action\">Current Bid: $" . $amount . "</button>
    
				</div>";
	if ($task_status != 'completed') {
    if ($login_user != $task_owner) {
        echo "
				<button id='addbidbutton" . $i . "' type='button' class='btn btn-success'>Add bid</button>
						<script type='text/javascript'>
							$('#addbidbutton" . $i . "').on('click', function (e) {
								 var modal = document.getElementById('addbid" . $i . "');
								 modal.style.display = 'inline-block';
							})
						</script>
						<div style='display:none' id='addbid" . $i . "' >
							<form action='' method='post'>
							<div class='container'>
							  <input type='hidden' id='task_id' name='task_id' value='" . $task_id . "'>
							  <input type='hidden' id='user_id' name='user_id' value='" . $task_owner . "'>
							  <div class='form-group'>
							  <div class='form-row'>
								<input type='text' class='form-control' placeholder='Enter Bid Amount' name='bid' required>
								<button class='btn btn-danger' name='submit' type='submit' >Submit Bid</button>
							  </div>
							  </div>
							  <span>" . $error . "</span>
							</div>
						  </form>
						</div>";
    } else {

		
        echo "
						<button id='editbutton" . $i . "' type='button' class='btn btn-success'>Edit</button>
							<script type='text/javascript'>
								$('#editbutton" . $i . "').on('click', function (e) {
									 var modal = document.getElementById('edit" . $i . "');
									 modal.style.display = 'inline-block';
								})
							</script>
							<div style='display:none' id='edit" . $i . "' >
								<form action='' method='post'>
								<div class='container'>
								  <input type='hidden' id='task_id' name='task_id' value='" . $task_id . "'>
								  <div class='form-group'>
								  <div class='form-row'>
									<input type='text' class='form-control' name='task_title' value='" . $task_title . "' required>
									<input type='text' class='form-control' name='task_description' value='" . $task_description . "' required>
									<input type='date' class='form-control' name='task_date' value='" . $task_date . "' required>
									<input type='time' class='form-control' name='task_starttime' value='" . $task_starttime . "' required>
									<input type='time' class='form-control' name='task_endtime' value='" . $task_endtime . "' required>
									<button class='btn btn-danger' name='update' type='submit' >Submit</button>
								  </div>
								  </div>
								  <span>" . $error . "</span>
								</div>
							  </form>
							</div>";

							if ($amount != 0) {
							echo"
							<form action='' method='post'>
							<div class='container' style='padding: 10px 0'>
								<input type='hidden' id='task_id' name='task_id' value='" . $task_id . "'>
								<input type='hidden' id='amount' name='amount' value='" . $amount . "'>
								<div class='form-group'>
								<div class='form-row'>
								<button class='btn btn-primary' name='close' type='submit' style='margin-left: 3px'>Accept</button>
								</div>
								</div>
								<span>" . $error . "</span>
							</div>
							</form>
				  </div>
				</div>";
				}
			
    }
}}
?>




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
</body>
</html>