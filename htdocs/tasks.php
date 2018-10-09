<?php
include('session.php');
$connection = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=cs2102team09");

$query = pg_query($connection, "SELECT * FROM task_managed_by");

if (!$query) {
	echo "Invalid query provided.";
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tasks available</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
		<body>
			<div id="profile">
				<b id="welcome">Welcome <i><?php echo $login_session; ?></i>!</b>
				<b id="logout"><a href="logout.php">Log Out</a></b>
			</div>
			<h1>Tasks</h1>
			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
	        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
	        crossorigin="anonymous">
	        </script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
	        	integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
	        	crossorigin="anonymous">
        	</script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
	        	integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
	        	crossorigin="anonymous">
        	</script>
		</body>
		<?php
		$i = 0; 
		// output data of each row
	    while($row = pg_fetch_array($query)) {
	        $i++;
	        $task_owner = $row['user_id'];
	        $task_title = $row["task_title"];
	        $task_description = $row["description"];
	        echo "
	            <div class='accordion' id='accordion".$i."'>
  					<div class='card'>
					    <div class='card-header' id='headingOne".$i."'>
					      <h5 class='mb-0'>
					        <button class='btn btn-link' type='button' data-toggle='collapse' data-target='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>".$task_title."
					        </button>
					      </h5>
					    </div>

					    <div id='collapseOne' class='collapse show' aria-labelledby='headingOne'>
					      <div class='card-body'>".$task_description."
					      </div>
					    </div>
					  </div>
</div>
	        ";
	    }

		?>
</html>