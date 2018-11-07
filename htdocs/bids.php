<?php
include('session.php');
include('./components/profile_header.html');
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
</head>
<body>
<div class="container" style="padding-top: 30px"></div>
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
  <button type=\"button\" class=\"list-group-item list-group-item-action\">Bid Amount: $" . $bid_amount . "</button>
</div>
</div>
	        ";
}

?>
</body>
</html>