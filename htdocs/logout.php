<?php
session_start();
unset($_SESSION['CurrentUser']);
unset($_SESSION['IsAdmin']);
session.destroy();
header("Location: first_page.php");
?>