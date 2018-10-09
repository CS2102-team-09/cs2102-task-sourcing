<?php
include('session.php');
if (isset($_POST['submit'])) {
	if (empty($_POST['title']) || empty($_POST['description'])) {
		$error = "Please fill in all the fields!";
	} else {
		// Define all attributes to store
		$title = $_POST['title'];
		$description = $_POST['description'];
		$date = $_POST['date'];
		$start_time = $_POST['start_time'];
		$end_time = $_POST['end_time'];

		$user_id = $_SESSION['login_user'];

        echo "<script>console.log( 'Debug Objects: " . $date . "' );</script>";
        echo "<script>console.log( 'Debug Objects: " . $start_time . "' );</script>";
        echo "<script>console.log( 'Debug Objects: " . $end_time . "' );</script>";

		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=postgres");

		
		// SQL query to fetch information of registerd users and finds user match.
		$query = pg_query($connection, "INSERT INTO task_managed_by (task_title, user_id, date, start_time, end_time, description) VALUES ('$title', '$user_id', '$date', '$start_time', '$end_time', '$description')");
		if ($query) {
			echo "Added successfully!";
			header("location: profile.php"); // Redirecting To Other Page
		} else {
			$error = $end_time;
			echo "Adding failed!";
		}
		pg_close($connection); // Closing Connection
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

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
            <li class="nav-item active">
                <a class="nav-link" href="profile.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Bid a Task <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="createtask.php">Create a Task <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
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


<form id="createtaskform" action="" method="post">
    <label>Title</label>
    <input id="task_title" name="title" placeholder="Write your task title here" type="text">

    <label>Description</label>
    <br>
    <textarea id="task_description" rows="4" cols="50" name="description" form="createtaskform">Write details of your task here</textarea>
    <br>

    <label>Date of task</label>
    <input id="task_date" name="date" type="date">

    <label>Start time</label>
    <input id="task_starttime" name="start_time" type="time">

    <label>End time</label>
    <input id="task_endtime" name="end_time" type="time">

    <br>
    <span><?php echo $error; ?></span>
    <br>

    <input name="submit" type="submit" value=" Submit task ">
</form>

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
</html>