<html>
<?php 
	session_start();
?>
<head>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<meta name="viewport" http-equiv="Cache-control" content="width=device-width, initial-scale=1 no-cache">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<div id="acknowledgement">
	<h1 align="center"> Congrats! You have successfully been registered to ThinkCan </h1>

	<button id="login_again_button" class="w3-button w3-border w3-hover-green w3-round-xlarge">Login to Task Source!</button>
		<script type="text/javascript">
			document.getElementById("login_again_button").onclick = function() { 
				location.href = "login.php";
			}
		</script>
</div>
</body>
</html>