<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>My Profile</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
		<body>
		<div id="profile">
			<b id="welcome">Welcome <i><?php echo $login_session; ?></i>! What would you like to do today?</b>
			<b id="logout"><a href="logout.php">Log Out</a></b>
		</div>
		<a href="createtask.php">Submit a task</a>
		<a href="tasks.php">Pick a task to do</a>
		<a href="pasttasks.php">See completed tasks</a>
		</body>
</html>