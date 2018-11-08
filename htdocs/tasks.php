<?php
include('session.php');
include('./components/profile_header.php');
$connection = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=postgres");
$login_user = $_SESSION['login_user'];
$query = pg_query($connection, "SELECT m.task_id, m.user_id AS owner, m.task_title, m.description, m.status, m.date, m.start_time, m.end_time, b.user_id AS bidder, (CASE WHEN b.amount is null then 0 else b.amount END) AS amount
from task_bid_by b right outer join task_managed_by m ON m.task_id = b.task_id
WHERE (b.amount >= (select max(b2.amount) from task_bid_by b2 where b2.task_id = b.task_id GROUP BY b2.task_id)
OR b.amount is null)
AND m.user_id <> '$login_user'
GROUP BY m.task_id, m.user_id, m.task_title, m.description, m.status, m.date, m.start_time, m.end_time, b.user_id, b.amount
ORDER BY m.status DESC, m.task_id ASC, b.amount DESC");
if (!$query) {
    echo "Invalid query provided.";
}
$error = '';
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

<?php
$i = 0;
// output data of each row
while ($row = pg_fetch_array($query)) {
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
    if ($task_status == 'no_bids') {
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
                </div>
          </div>
        </div>
                ";
    } elseif ($task_status == 'in_progress') {
        echo "
                    
                    
                    
    <div class='container' style='padding-top: 30px'>
    <div class=\"list-group\">
        <button type=\"button\" class=\"list-group-item list-group-item-action list-group-item-primary\">Task Title: " . $task_title . " <span class='badge badge-warning' style='margin-left: 15px'>" . $task_status . "</span></button>
        <button type=\"button\" class=\"list-group-item list-group-item-action\">Description: " . $task_description . "</button>
        <button type=\"button\" class=\"list-group-item list-group-item-action\">Date: " . $task_date . "</button>
        <button type=\"button\" class=\"list-group-item list-group-item-action\">Start Time: " . $task_starttime . "</button>
        <button type=\"button\" class=\"list-group-item list-group-item-action\">End Time: " . $task_endtime . "</button>
        <button type=\"button\" class=\"list-group-item list-group-item-action\">Task Owner: " . $task_owner . "</button>
        <button type=\"button\" class=\"list-group-item list-group-item-action\">Current Bid: $" . $amount . "</button>
        
        </div>
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
                </div>
          </div>
        </div>
                ";
    } else {
        echo "
                    
                    
                    
    <div class='container' style='padding-top: 30px'>
    <div class=\"list-group\">
        <button type=\"button\" class=\"list-group-item list-group-item-action list-group-item-primary\">Task Title: " . $task_title . " <span class='badge badge-success' style='margin-left: 15px'>" . $task_status . "</span></button>
        <button type=\"button\" class=\"list-group-item list-group-item-action\">Description: " . $task_description . "</button>
        <button type=\"button\" class=\"list-group-item list-group-item-action\">Date: " . $task_date . "</button>
        <button type=\"button\" class=\"list-group-item list-group-item-action\">Start Time: " . $task_starttime . "</button>
        <button type=\"button\" class=\"list-group-item list-group-item-action\">End Time: " . $task_endtime . "</button>
        <button type=\"button\" class=\"list-group-item list-group-item-action\">Task Owner: " . $task_owner . "</button>
        <button type=\"button\" class=\"list-group-item list-group-item-action\">Winning Bid: $" . $amount . "</button>
        
        </div>
        </div>
                ";
    }
}
?>