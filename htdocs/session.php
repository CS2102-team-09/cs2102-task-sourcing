<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=cs2102team09");

session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=pg_query($connection, "SELECT * from users where user_id='$user_check'");
$row = pg_fetch_assoc($ses_sql);
$login_session =$row['user_id'];
if(!isset($login_session)){
pg_close($connection); // Closing Connection
header('Location: index.php'); // Redirecting To Home Page
}
?>