<!DOCTYPE html>
<html>
<head>
<style>
.button 
{
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.content{
  height:200px;
  width:400px;
  position: fixed;
  top:20%;
  left:38%;
  text-align: center;
  margin: auto;
  }
body{
background-color:#91E8E1
}

.button1 {background-color: #4CAF50;} /* Green */
.button2 {background-color: #008CBA;} /* Blue */
</style>
<div class = "content">
<title> app for drone charging station</title>
</head>
<body>
<h1>Welcome to our drone charging station!</h1>
<p> pick whether you're dropping off your drone or picking up your drone:</p>
<a href="http://localhost/435project/pick-up.php" class ="button button1">Pick-up</a>
<a href="http://localhost/435project/drop-off.php" class ="button button2">Drop-off</a>
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
				echo '<p>Connected successfully</p>';
			}
			
			$sql = "Select * from charging_rates";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) 
			{
				// output data of each row
				while($row = $result->fetch_assoc()) 
				{
				echo "<p>" . $row["charge_type"].  "  costs  $" . $row["charge_rate"]. " per minute</p>";
				}
			}
			mysqli_close($conn);
		?>
		<p> Kiosk Hours:  </p>
		<p> Monday - Friday: 9:00AM - 9:00PM</p>
		<p> Weekends: 8:00AM - 8:00PM </p>
</div>
</body>

</html>