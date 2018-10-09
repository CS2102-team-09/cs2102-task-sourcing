<html>
<?php 
	session_start();
	$db = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=postgres") or die("Could not connect to database: " .pg_last_error());
?>
<head>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<meta name="viewport" http-equiv="Cache-control" content="width=device-width, initial-scale=1 no-cache">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title> ThinkCan Pte Ltd Task Sourcing </title>
</head>
<body>
	<h1 id="title" align="center"> ThinkCan Pte Ltd Task Sourcing </h1>
	<div id="header">
		<div class="navbar">
			<a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a> 
			<a href="tasks.php"><i class="fa fa-fw fa-search"></i>Search</a> 
			<a href="login.php" name="login_button"><i class="fa fa-fw fa-user"></i>Login</a>
		</div>
	</div>