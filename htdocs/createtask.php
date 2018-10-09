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
		$query = pg_query($connection, "INSERT INTO INSERT INTO task_managed_by (task_title, user_id, date) VALUES ('$title', '$user_id', '$date')");
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
<html>
	<head>
		<title>Create task</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
		<body>
			<div id="profile">
				<b id="welcome">Welcome <i><?php echo $login_session; ?></i>!</b>
				<b id="logout"><a href="logout.php">Log Out</a></b>
			</div>
			<h1>Create a task</h1>
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
		</body>
</html>