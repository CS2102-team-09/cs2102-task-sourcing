<?php
include('session.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Create task</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
		<body>
			<h1>Create a task</h1>
			<div id="profile">
				<b id="welcome">Welcome <i><?php echo $login_session; ?></i>! What would you like to do today?</b>
				<b id="logout"><a href="logout.php">Log Out</a></b>
			</div>
			<form action="" method="post">
				<label>Title</label>
				<input id="task_title" name="title" placeholder="Write your task title here" type="text">

				<label>Description</label>
				<input id="task_description" name="description" placeholder="Write details of your task here" type="password">
				
				<label>Start time</label>
				<input id="task_starttime" name="start_time" type="date">
				
				<label>End time</label>
				<input id="task_endtime" name="end_time" type="date">
				
				<input name="submit" type="submit" value=" Submit task ">
		</body>
</html>