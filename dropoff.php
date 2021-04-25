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
				<select name="station"> <!-- creates drop down menu -->
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
					<input type = "radio" name = "charge" value = "N"> Normal Charging
					<input type = "radio" name = "charge" value = 'S'> Super Charging
				</div>
				<select name="drone">
					<option selected hidden value = ""> Select Drone</option>
					<option value="Mavik Mini 2">Mavik Mini 2</option>
					<option value="Mavik Pro 2">Mavik Pro 2</option>
					<option value="Mair Air 2">Mavik Air 2</option>
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
				$station = $_POST['station'] ?? ""; //?? "" represents setting default to empty string
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
					echo "<p>Pin needs to be 4 numbers! Please try again /p>";
				
				}
				
				echo strlen($pin);//check length of $pin
				}
				
				
				
			}
		
	}

?>