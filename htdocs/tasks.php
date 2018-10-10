<?php
include('session.php');
$connection = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=postgres");

$query = pg_query($connection, "SELECT test.task_id, test_next.owner, test_next.task_title, test_next.description, test_next.status, test_next.date, test_next.start_time, test_next.end_time, test_next.bidder, test_next.amount
FROM (SELECT test.task_id, MAX(test.amount) AS amount
FROM(SELECT b.task_id, b.user_id AS owner, b.task_title, b.description, b.status, b.date, b.start_time, b.end_time, t.user_id AS bidder, CASE WHEN t.amount IS NULL THEN 0 ELSE t.amount END
FROM task_bid_by t RIGHT OUTER JOIN task_managed_by b ON t.task_id = b.task_id
ORDER BY b.task_id, t.amount DESC) AS test
GROUP BY test.task_id) AS test, (SELECT b.task_id, b.user_id AS owner, b.task_title, b.description, b.status, b.date, b.start_time, b.end_time, t.user_id AS bidder, CASE WHEN t.amount IS NULL THEN 0 ELSE t.amount END
FROM task_bid_by t RIGHT OUTER JOIN task_managed_by b ON t.task_id = b.task_id
ORDER BY b.task_id, t.amount DESC) AS test_next
WHERE test.amount = test_next.amount
AND test.task_id = test_next.task_id");

if (!$query) {
    echo "Invalid query provided.";
}

$error='';
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tasks available</title>
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
<?php
$i = 0;
// output data of each row
while($row = pg_fetch_array($query)) {
    $i++;
    $task_owner = $row['owner'];
    $task_title = $row["task_title"];
    $task_status = $row["status"];
    $task_date = $row["date"];
    $task_starttime = $row["start_time"];
    $task_endtime = $row["end_time"];
    $task_description = $row["description"];
    $task_id = $row["task_id"];
    $amount = $row["amount"];

    echo "

				
				
				
<div class='container' style='padding-top: 30px'>
<div class=\"list-group\">
    <button type=\"button\" class=\"list-group-item list-group-item-action list-group-item-primary\">Task Title: " . $task_title . " <span class='badge badge-danger' style='margin-left: 15px'>" . $task_status . "</span></button>
    <button type=\"button\" class=\"list-group-item list-group-item-action\">Description: " . $task_description . "</button>
    <button type=\"button\" class=\"list-group-item list-group-item-action\">Date: " . $task_date . "</button>
    <button type=\"button\" class=\"list-group-item list-group-item-action\">Start Time: " . $task_starttime . "</button>
    <button type=\"button\" class=\"list-group-item list-group-item-action\">End Time: " . $task_endtime . "</button>
    <button type=\"button\" class=\"list-group-item list-group-item-action\">Task Owner: " . $task_owner . "</button>
    <button type=\"button\" class=\"list-group-item list-group-item-action\">Current Bid: $" . $amount . "</button>
    
    </div>
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
            </div>
      </div>
    </div>
	        ";
}

?>
</body>
</html>