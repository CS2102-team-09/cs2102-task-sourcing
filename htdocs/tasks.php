<?php
include('session.php');
$connection = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=postgres");

$query = pg_query($connection, "SELECT * FROM task_managed_by");

if (!$query) {
    echo "Invalid query provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
                <a class="nav-link" href="profile.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Bid a Task <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="createtask.php">Create a Task <span
                            class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="tasks.php">Manage Tasks <span class="sr-only">(current)</span></a>
            </li>
        </ul>

        <button class="btn btn-outline-success my-2 my-sm-0" type="button" data-toggle="modal"
                data-target="#loginModel">Login
        </button>
        <button class="btn btn-success my-2 my-sm-0" type="button" data-toggle="modal"
                data-target="#signupModel">Signup
        </button>
    </div>
</nav>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>


<?php
$i = 0;
// output data of each row
while ($row = pg_fetch_array($query)) {
    $i++;
    $task_owner = $row['user_id'];
    $task_title = $row["task_title"];
    $task_description = $row["description"];
    echo "
	            <div class='accordion' id='accordion" . $i . "'>
  					<div class='card'>
					    <div class='card-header' id='headingOne" . $i . "'>
					      <h5 class='mb-0'>
					        <button class='btn btn-link' type='button' data-toggle='collapse' data-target='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>" . $task_title . "
					        </button>
					      </h5>
					    </div>

					    <div id='collapseOne' class='collapse show' aria-labelledby='headingOne'>
					      <div class='card-body'>" . $task_description . "
					      </div>
					    </div>
					  </div>
</div>
	        ";
}

?>
</html>