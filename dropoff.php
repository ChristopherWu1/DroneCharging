<!DOCTYPE html>
<html>
<html>
<head>
	<meta charset = "UTF-8"> <!-- Meta data -->
	<meta name = "dropoff" content = "drop off drone home page">
	<title> Drop Off </title>
	<body>
		<h1> Input your Credentials: </h1>
		
		<form action = "" method = "post">
				<select name="stations"> <!-- creates drop down menu -->
					<option selected hidden value = ""> Select Station</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
				</select>
				<div>
					<label> Pleas Insert a 4-digit pin number. We will ask for it at drone pickup: </label>
					<input name = "pin" type = "number">
				</div>
				<div>
					<input type = "radio" name = "charge" value = "Normal"> Normal Charging
					<input type = "radio" name = "charge" value = 'Super'> Super Charging
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
				</div>
				<select name="drone">
					<option selected hidden value = ""> Select Drone</option>
					<option value="Mavic Mini 2">Mavic Mini 2</option>
					<option value="Mavic Pro 2">Mavic Pro 2</option>
					<option value="Mavic Air 2">Mavic Air 2</option>
					<option value="Parrot Anafi">Parrot Anafi</option>
					<option value="Mavic 2 Zoom">Mavic 2 Zoom</option>
					<option value="Ryze Tello">Ryze Tello</option>
					<option value="Phantom 4 Pro V2.0">Phantom 4 Pro V2.0</option>
					<option value="Inspire 2"> Inspire 2</option>
				</select>
				
				<div>
					<input type = "submit" value = "Submit"> 
				</div>
				
		
		</form>
		<div></div>
		<a href = "http://localhost/435project/home.php"> <button> Go Back </button> </a> 
		<div></div>
		
	</body>
	<footer>
		<p> Kiosk Hours:  </p>
		<p> Monday - Friday: 9:00AM - 9:00PM</p>
		<p> Weekends: 8:00AM - 8:00PM </p>
		<div class="footer">All Rights Reserved</div>
	</footer>
</html>

<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "dronecharge";
	$conn = mysqli_connect($servername, $username, $password,$dbname);
	
	//$station = $pin = $charge = $drone = "";
	//$charge = '';
	
	if (!$conn) 
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	else
	{
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				$station = $_POST['stations'] ?? ""; //?? "" represents setting default to empty string
				$pin = $_POST['pin'] ?? "";
				$charge = $_POST['charge'] ?? "";
				$drone = $_POST['drone'] ?? "";
				if(empty($station) || empty($pin) ||  empty($charge) || empty($drone))
				{
					echo "<p> All the fields are required. Please Try Again </p>";
				}
				else
				{
				echo $station;
				echo "<br> ";
				
				echo $pin;
				echo "<br>";
		
				echo $charge;
				echo "<br>";
				
				echo $drone; 
				echo "<br>";
				
				if(strlen($pin) != 4)
				{
					echo "<p>Pin needs to be 4 numbers! Please try again </p>";
				
				}
				echo strlen($pin);//check length of $pin	
				}
				
				$sql = "Select * from station where Station_id = '$station' ";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) 
				{
					// output data of each row
					while($row = $result->fetch_assoc()) 
					{
						echo "<p> Station Availability: ".$row["Station_available"] ."</p>";
						$station_availability = $row["Station_available"];
						
						echo "<p> Station Length: ".$row["Station_length"] ."</p>";
						$station_length = $row["Station_length"];
						
						echo "<p> Station Width: ".$row["Station_width"] ."</p>";
						$station_width = $row["Station_width"];
						
						echo "<p> Station Height: ".$row["Station_height"] ."</p>";
						$station_height = $row["Station_height"];
						
					}
				}
				
				$sql = "Select * from drone where drone_model = '$drone' ";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) 
				{
					// output data of each row
					while($row = $result->fetch_assoc()) 
					{
						
						echo "<p> Drone Length: ".$row["drone_length"] ."</p>";
						$drone_length = $row["drone_length"];
						
						echo "<p> drone Width: ".$row["drone_width"] ."</p>";
						$drone_width = $row["drone_width"];
						
						echo "<p> drone Height: ".$row["drone_height"] ."</p>";
						$drone_height = $row["drone_height"];
						
					}
				}
				
				if($station_availability == 'N')
				{
					echo "<p> Unfortunately, this station is not available. Please Try another station </p>";
				}
				else
				{
					if(($drone_length > $station_length) || ($drone_width > $station_width) || ($drone_height > $station_height))
					{
						echo "<p>The drone you have does not fit the specified station. Please try another station.</p>";
					}
					else
					{
						$sql = "INSERT INTO transaction (Transaction_rate, Transaction_pin) VALUES ((select charge_rate from charging_rates where charge_type =  '$charge'),'$pin')";
						if(mysqli_query($conn, $sql))
						{
							$sql = "INSERT INTO action (Drone_id, Station_id, Transaction_id) VALUES ((Select drone_id from drone where drone_model = '$drone'), '$station', (SELECT max(Transaction_ID) from transaction) )";
							if(mysqli_query($conn, $sql))
							{
								$sql = "UPDATE station SET Station_available = 'Y', Transaction_ID = (SELECT max(Transaction_ID) from transaction) WHERE Station_id = '$station';";
								if(mysqli_query($conn, $sql))
								{
									echo "<p> Drone successfully added </p>";
								}
							}
						}
					}
				}
				
				
				
			}
		
	}

?>