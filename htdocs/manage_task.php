<?php
include ('admin_session.php');
include('./components/admin_header.html');

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
    echo "Invalid Query Provided!";
}

if (isset($_POST['update'])) {
    $task_title = $_POST['task_title'];
    $task_date = $_POST['task_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $description = $_POST['task_description'];


    $update_task_managed_by = pg_query($connection, "UPDATE task_managed_by SET 
      task_title = '$task_title',
      date = '$task_date',
      start_time = '$start_time',
      end_time = '$end_time',
      description = '$description' 
      WHERE task_id = '$_POST[task_id]' 
    ");

    $update_task_bid_by = pg_query($connection, "UPDATE task_bid_by SET
      amount = '$_POST[amount]' WHERE task_id = '$_POST[task_id]'
    ");

    header("Refresh:0");
}

if (isset($_POST['delete'])) {
    $task_id = $_POST['task_id'];
    $delete_task = pg_query($connection, "DELETE FROM task_managed_by WHERE task_id = '$task_id'");
    $delete_task = pg_query($connection, "DELETE FROM task_bid_by WHERE task_id = '$task_id'");
    header("Refresh:0");
}


$i = 0;
while($row = pg_fetch_array($query)) {
    $i++;
    $task_owner = $row['owner'];
    $task_title = $row["task_title"];
    $task_status = $row["status"];
    $task_date = $row["date"];
    $start_time = $row["start_time"];
    $end_time = $row["end_time"];
    $task_description = $row["description"];
    $task_id = $row["task_id"];
    $amount = $row["amount"];

    echo "

				

				
<div class='container' style='padding-top: 30px'>
<form action='' method='post'>
    <div class=\"list-group\">
        <div class='list-group-item list-group-item-action list-group-item-primary'>
            <div class=\"form-group row\">
                <label for=\"task_id\" class=\"col-sm-2 col-form-label\">Task ID:</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" readonly class=\"form-control-plaintext\" id=\"task_id\" name=\"task_id\" value=\"$task_id\">
                </div>
            </div>
        </div>	
        
        <div class='list-group-item list-group-item-action list-group-item'>
            <div class=\"form - group row\">
                <label for=\"task_title\" class=\"col-sm-2 col-form-label\">Task Title:</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" class=\"form-control-plaintext\" id=\"task_title\" name=\"task_title\" value=\"$task_title\">
                </div>
            </div>
        </div>
        
        <div class='list-group-item list-group-item-action'>
            <div class=\"form-group row\">
                <label for=\"task_description\" class=\"col-sm-2 col-form-label\">Description: </label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" class=\"form-control-plaintext\" id=\"task_description\" name=\"task_description\" value=\"$task_description\">
                </div>
            </div>
        </div>	
        
        <div class='list-group-item list-group-item-action'>
            <div class=\"form - group row\">
                <label for=\"task_status\" class=\"col-sm-2 col-form-label\">Status: </label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" class=\"form-control-plaintext\" id=\"task_status\" name=\"task_status\" value=\"$task_status\">
                </div>
            </div>
        </div>	
        
        <div class='list-group-item list-group-item-action'>
            <div class=\"form-group row\">
                <label for=\"task_date\" class=\"col-sm-2 col-form-label\">Date: </label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" class=\"form-control-plaintext\" id=\"task_date\" name=\"task_date\" value=\"$task_date\">
                </div>
            </div>
        </div>	
        
        <div class='list-group-item list-group-item-action'>
            <div class=\"form-group row\">
                <label for=\"start_time\" class=\"col-sm-2 col-form-label\">Start Time: </label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" class=\"form-control-plaintext\" id=\"start_time\" name=\"start_time\" value=\"$start_time\">
                </div>
            </div>
        </div>	
        
        <div class='list-group-item list-group-item-action'>
            <div class=\"form-group row\">
                <label for=\"end_time\" class=\"col-sm-2 col-form-label\">End Time: </label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" class=\"form-control-plaintext\" id=\"end_time\" name=\"end_time\" value=\"$end_time\">
                </div>
            </div>
        </div>	
        
        <div class='list-group-item list-group-item-action'>
            <div class=\"form-group row\">
                <label for=\"task_owner\" class=\"col-sm-2 col-form-label\">Task Owner: </label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" readonly class=\"form-control-plaintext\" id=\"task_owner\" name=\"task_owner\" value=\"$task_owner\">
                </div>
            </div>
        </div>	
        
        <div class='list-group-item list-group-item-action'>
            <div class=\"form-group row\">
                <label for=\"amount\" class=\"col-sm-2 col-form-label\">Current Bid: </label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" readonly class=\"form-control-plaintext\" id=\"amount\" name=\"amount\" value=\"$amount\">
                </div>
            </div>
        </div>	
        
        <div class=\"list-group-item list-group-item-action\">
            <div class=\"form-group row\">
                <div class=\"col-md-2\">
                    <button class='btn btn-success btn-lg' name='update' type='submit' >Update</button>
                </div>
                <button class='btn btn-danger btn-lg' name='delete' type='submit' >Delete</button>
            </div>
        </div>
        
        
    </div>
</form>
</div>
	        ";
}
?>

<!--<form action="" method="post">-->
<!--    <div class="form-row">-->
<!--        <label for="task_title" class="col-sm-2 col-form-label">Task Title:</label>-->
<!--        <div class="col-sm-10">-->
<!--            <input type="text" class="form-control-plaintext" id="task_title" name="task_title" value=".$task_title">-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="form-row">-->
<!--        <label for="task_description" class="col-sm-2 col-form-label">Task Description:</label>-->
<!--        <div class="col-sm-10">-->
<!--            <input type="text" class="form-control-plaintext" id="task_description" name="task_description" value=".$task_description">-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="form-row">-->
<!--        <label for="task_date" class="col-sm-2 col-form-label">Task Date:</label>-->
<!--        <div class="col-sm-10">-->
<!--            <input type="text" class="form-control-plaintext" id="task_date" name="task_date" value=".$task_date">-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="form-row">-->
<!--        <label for="task_starttime" class="col-sm-2 col-form-label">Start Time:</label>-->
<!--        <div class="col-sm-10">-->
<!--            <input type="text" class="form-control-plaintext" id="task_starttime" name="task_starttime" value=".$task_starttime">-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="form-row">-->
<!--        <label for="task_endtime" class="col-sm-2 col-form-label">End Time:</label>-->
<!--        <div class="col-sm-10">-->
<!--            <input type="text" class="form-control-plaintext" id="task_endtime" name="task_endtime" value=".$task_endtime">-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="form-row">-->
<!--        <label for="task_owner" class="col-sm-2 col-form-label">Task Owner:</label>-->
<!--        <div class="col-sm-10">-->
<!--            <input type="text" class="form-control-plaintext" id="task_owner" name="task_owner" value=".$task_owner">-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="form-row">-->
<!--        <label for="amount" class="col-sm-2 col-form-label">Current Bid:</label>-->
<!--        <div class="col-sm-10">-->
<!--            <input type="text" class="form-control-plaintext" id="amount" name="amount" value=".$amount">-->
<!--        </div>-->
<!--    </div>-->
<!--</form>-->
<!---->
<!---->
<!--<div class=\"list-group\">-->
<!--    <button type=\"button\" class=\"list-group-item list-group-item-action list-group-item-primary\">Task Title: " . $task_title . " <span class='badge badge-danger' style='margin-left: 15px'>" . $task_status . "</span></button>-->
<!--    <button type=\"button\" class=\"list-group-item list-group-item-action\">Description: " . $task_description . "</button>-->
<!--    <button type=\"button\" class=\"list-group-item list-group-item-action\">Date: " . $task_date . "</button>-->
<!--    <button type=\"button\" class=\"list-group-item list-group-item-action\">Start Time: " . $task_starttime . "</button>-->
<!--    <button type=\"button\" class=\"list-group-item list-group-item-action\">End Time: " . $task_endtime . "</button>-->
<!--    <button type=\"button\" class=\"list-group-item list-group-item-action\">Task Owner: " . $task_owner . "</button>-->
<!--    <button type=\"button\" class=\"list-group-item list-group-item-action\">Current Bid: $" . $amount . "</button>-->
<!---->
<!--</div>-->