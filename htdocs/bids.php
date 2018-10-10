<?php
include('session.php');
$connection = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=postgres");
$signin_user = $_SESSION['login_user'];
$query = pg_query($connection, "SELECT * FROM task_bid_by WHERE user_id='$signin_user'");

if (!$query) {
    echo "Invalid query provided.";
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
                <a class="nav-link active" href="bids.php"> Display Bids <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="createtask.php"> Create a Task <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tasks.php"> Manage Tasks <span class="sr-only">(current)</span></a>
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
while ($row = pg_fetch_array($query)) {
    $i++;

    $user_id = $row['user_id'];
    $task_id = $row["task_id"];
    $bid_amount = $row["amount"];


    $taskQuery = pg_query($connection, "SELECT * FROM task_managed_by WHERE task_id='$task_id'");
    $taskRow = pg_fetch_assoc($taskQuery);
    $task_owner = $taskRow['user_id'];
    $task_title = $taskRow["task_title"];
    $task_description = $taskRow["description"];
    $task_status = $taskRow["status"];
    $task_date = $taskRow["date"];
    $task_starttime = $taskRow["start_time"];
    $task_endtime = $taskRow["end_time"];

    echo "
				
				
<div class='container' style='padding-top: 30px'>
<div class=\"list-group\">
  <button type=\"button\" class=\"list-group-item list-group-item-action list-group-item-primary\">Task Title: " . $task_title . " <span class='badge badge-danger' style='margin-left: 15px'>" . $task_status . "</span></button>
  <button type=\"button\" class=\"list-group-item list-group-item-action\">Description: " . $task_description . "</button>
  <button type=\"button\" class=\"list-group-item list-group-item-action\">Date: " . $task_date . "</button>
  <button type=\"button\" class=\"list-group-item list-group-item-action\">Start Time: " . $task_starttime . "</button>
  <button type=\"button\" class=\"list-group-item list-group-item-action\">End Time: " . $task_endtime . "</button>
  <button type=\"button\" class=\"list-group-item list-group-item-action\">Task Owner: " . $task_owner . "</button>
  <button type=\"button\" class=\"list-group-item list-group-item-action\">Current Bidder: " . $user_id . "</button>
  <button type=\"button\" class=\"list-group-item list-group-item-action\">Bid Amount: " . $bid_amount . "</button>
</div>
</div>
	        ";
}

?>
</body>
</html>