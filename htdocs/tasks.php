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
		<style type="text/css">
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}

		table td {
			transition: all .5s;
		}
		
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 537px;
		}

		.data-table th, 
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
		</style>
	</head>
		<body>
			<div id="profile">
				<b id="welcome">Welcome <i><?php echo $login_session; ?></i>!</b>
				<b id="logout"><a href="logout.php">Log Out</a></b>
			</div>
			<h1>Tasks</h1>
			<table>
				<thead>
				<tr>
					<th>Title</th>
					<th>Description</th>
					<th>Start Time</th>
					<th>End Time</th>
					<th>Date of Task</th>
					<th>Status</th>
					<th>Owner</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$no 	= 1;
				while ($row = pg_fetch_array($query)) {
					echo '<tr>
							<td>'.$row['task_title'].'</td>
							<td>'.$row['description'].'</td>
							<td>'.$row['start_time'].'</td>
							<td>'.$row['end_time'].'</td>
							<td>'. date('F d, Y', strtotime($row['date'])) . '</td>
							<td>'.$row['status'].'</td>
							<td>'.$row['user_id'].'</td>
						</tr>';
					$no++;
				}
				?>
			</tbody>
		</table>
		</body>
</html>