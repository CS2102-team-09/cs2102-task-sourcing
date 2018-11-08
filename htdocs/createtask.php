<?php
include('session.php');
include('./components/profile_header.php');
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
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			  You have successfully created a task!
			</div>';
			//header("location: profile.php"); // Redirecting To Other Page
		} else {
			$error = $end_time;
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			  Some fields were filled out incorrectly. Please try again.
			</div>';
		}
		pg_close($connection); // Closing Connection
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create a Task</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>
<body>

<div class="container" style="margin-top: 30px">
<form action="" method="post">
    <div class="form-group">
        <label for="exampleFormControlInput1">Task Title</label>
        <input name="title" type="text" class="form-control" id="exampleFormControlInput1" required>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Task Description</label>
        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="form-group row">
        <label for="example-date-input" class="col-2 col-form-label">Date</label>
        <div class="col-10">
            <input name="date" class="form-control" type="date" value="2018-10-19" id="example-date-input">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-time-input" class="col-2 col-form-label">Start Time</label>
        <div class="col-10">
            <input name="start_time" class="form-control" type="time" value="13:45:00" id="example-time-input">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-time-input" class="col-2 col-form-label">End Time</label>
        <div class="col-10">
            <input name="end_time" class="form-control" type="time" value="13:45:00" id="example-time-input">
        </div>
    </div>
    <div class="form-group"><input name="submit" class="btn btn-success" type="submit" value=" Submit task "></div>
</form>
</div>

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