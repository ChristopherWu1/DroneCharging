<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8"> <!-- Meta data -->
	<meta name = "home" content = "homepage of project">
	<title> Homepage </title>
	<body>
		<h1> Drone Recharging Station </h1>
		<a href = "http://localhost/435project/pickup.php"> <button> Pick Up </button> </a> 
		<div></div>
		<a href = "http://localhost/435project/dropoff.php"> <button> Drop Off </button> </a> 
		<div></div>
		
	</body>
	<footer>
		<p> Please note the rates we have available: </p>
		<?php 
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "dronecharge";
			$conn = mysqli_connect($servername, $username, $password,$dbname);
			
			if (!$conn) 
			{
			die("<p>Connection failed: </p> " . mysqli_connect_error());
			}
			else
			{
				//echo '<p>Connected successfully</p>';
			}
			
			$sql = "Select * from charging_rates";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) 
			{
				// output data of each row
				while($row = $result->fetch_assoc()) 
				{
				echo "<p>" . $row["charge_type"].  "  costs  $" . $row["charge_rate"]." for " . $row["charge_speed"] ." mAh per minute</p>";
				}
			}
			mysqli_close($conn);
		?>
		<p> Kiosk Hours:  </p>
		<p> Monday - Friday: 9:00AM - 9:00PM</p>
		<p> Weekends: 8:00AM - 8:00PM </p>
		<div class="footer">All Rights Reserved</div>
	</footer>

</html>