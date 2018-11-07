<?php
include ('admin_session.php');
include('./components/admin_header.html');

$connection = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=postgres");
$query = pg_query($connection, "SELECT * FROM users");

if (!$query) {
    echo "Invalid Query Provided!";
}

if (isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];
    $delete_task = pg_query($connection, "DELETE FROM users WHERE user_id = '$user_id'");
    header("Refresh:0");
}


$i = 0;
while($row = pg_fetch_array($query)) {
    $i++;
    $user_id = $row['user_id'];


    echo "

				

				
<div class='container' style='padding-top: 30px'>
<form action='' method='post'>
    <div class=\"list-group\">
        <div class='list-group-item list-group-item-action'>
            <div class=\"form-group row\">
                <label for=\"user_id\" class=\"col-md-2 col-form-label\">User ID:</label>
                <div class=\"col-md-8\">
                  <input type=\"text\" readonly class=\"form-control-plaintext\" id=\"user_id\" name=\"user_id\" value=\"$user_id\">
                </div>
                <div class=\"col-md-2\">
                    <button class='btn btn-danger btn-lg' name='delete' type='submit' >Delete</button>
                </div>
            </div>
        </div>	
        
    </div>
</form>
</div>
	        ";
}
?>
