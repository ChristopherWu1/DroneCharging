
<html>
<head>
	<meta charset = "UTF-8"> <!-- Meta data -->
	<meta name = "pickup" content = "homepage of project">
	<title> Pickup </title>
	<body>
	<h1> Welcome Back! Input your station you are charging at and your pin number: </h1>
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
					<label> Pleas insert your 4-digit pin number: </label>
					<input name = "pin" type = "number">
		</div>
		
		<div>
					<input type = "submit" value = "Submit"> 
		</div>
	</form>
		<div></div>
			<a href = "http://localhost/435project/home.php"> <button> Go Back </button> </a> 
		<div></div>
	</body>

</head>
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
		$station = $_POST['stations'] ?? ""; //?? "" represents setting default to empty string
		$pin = $_POST['pin'] ?? "";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
		
			if(empty($station) || empty($pin))
			{
				echo "<p> All the fields are required. Please Try Again </p>";
			}
			else
			{
				echo $station;
				echo "<br> ";
					
				echo $pin;
				echo "<br>";
				
				$sql = "SELECT Transaction_ID,Station_available FROM station where Station_id = '$station';";
				$result = $conn->query($sql);
				$transactionid = "";
				$stationavail = "";
				if ($result->num_rows > 0) 
				{
					while($row = $result->fetch_assoc()) 
					{
						$transactionid = $row["Transaction_ID"];
						$stationavail =  $row["Station_available"];
						
						echo "<p>". $transactionid . "</p>";
						echo "<p>". $stationavail . "</p>";
					}
				}
				
				$sql = "select Transaction_pin  from transaction where Transaction_ID = '$transactionid'";
				$result = $conn->query($sql);
				$thepin = "";
				if ($result->num_rows > 0) 
				{
					while($row = $result->fetch_assoc()) 
					{
						$thepin = $row["Transaction_pin"];
						echo "<p>". $thepin . "</p>";
					}
				}
				
				if(($stationavail == 'Y') || ($thepin != $pin))
				{
					echo "<p> You have incorrectly inputted your information. Please Try again </p>";
				}
				else
				{
					echo "<p> Test is good. Lolz </p>";
				}
				
				
				
				
				
				
			}
		}
		
	}
?>