<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	} else {
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=cs2102team09");
		// To protect MySQL injection for Security purpose
		// $username = stripslashes($username);
		// $password = stripslashes($password);
		// $username = pg_escape_string($connection, $username);
		// $password = pg_escape_string($connection, $password);
		// Selecting Database
		
		// SQL query to fetch information of registerd users and finds user match.
		$query = pg_query($connection, "SELECT * from users where password='$password' AND user_id='$username'");
		$rows = pg_num_rows($query);
		if ($rows == 1) {
			$_SESSION['login_user']=$username; // Initializing Session
			header("location: profile.php"); // Redirecting To Other Page
		} else {
			$error = "Username or Password is invalid";
		}
		pg_close($connection); // Closing Connection
	}
}
?>