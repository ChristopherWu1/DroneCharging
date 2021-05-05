<style>
/* The alert message box */
.alert {
  padding: 20px;
  background-color: #f44336; /* Red */
  color: white;
  margin-bottom: 15px;
   opacity: 1;
  transition: opacity 0.6s; /* 600ms to fade out */
}
.alert0 {
  padding: 20px;
  background-color: #34eb61; /* green */
  color: white;
  margin-bottom: 15px;
   opacity: 1;
  transition: opacity 0.6s; /* 600ms to fade out */
}

/* The close button */
.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

/* When moving the mouse over the close button */
.closebtn:hover {
  color: black;
}
</style>

<script>
// Get all elements with class="closebtn"
var close = document.getElementsByClassName("closebtn");
var i;

// Loop through all close buttons
for (i = 0; i < close.length; i++) {
  // When someone clicks on a close button
  close[i].onclick = function(){

    // Get the parent of <span class="closebtn"> (<div class="alert">)
    var div = this.parentElement;

    // Set the opacity of div to 0 (transparent)
    div.style.opacity = "0";

    // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>

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
					<label> Pleas insert your 4-digit pin number: </label>  <!-- Pin Number -->
					<input name = "pin" type = "number">
		</div>
		
		<div>
					<input type = "submit" value = "Submit"> <!-- Submit button-->
		</div>
	</form>
		<div></div>
			<a href = "http://localhost/435project/home.php"> <button> Go Back </button> </a> <!-- Button to go back to home.php-->
		<div></div>
	</body>

</head>
</html>

<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "dronecharge";
	$conn = mysqli_connect($servername, $username, $password,$dbname); //connect to server 
	
	
	
	if (!$conn) //connection failed
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	else
	{
		$station = $_POST['stations'] ?? ""; //?? "" represents setting default to empty string
		$pin = $_POST['pin'] ?? "";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
		
			if(empty($station) || empty($pin)) //if any values are empty, user left it blank
			{
				//echo "<p> All the fields are required. Please Try Again </p>";
				echo "<div class='alert'>
					<span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
					All the fields are required. Please Try Again!
					</div>";
			}
			else
			{
				echo $station;
				echo "<br> ";
					
				echo $pin;
				echo "<br>";
				
				$sql = "SELECT Transaction_ID,Station_available FROM station where Station_id = '$station';"; //get transaction_ID and station availibility
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
				
				$sql = "select Transaction_pin  from transaction where Transaction_ID = '$transactionid'"; //get pin that user inputted
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
				
				if(($stationavail == 'Y') || ($thepin != $pin)) //if station availbility is true or the pins do not match
				{
					//echo "<p> You have incorrectly inputted your information. Please Try again </p>";
					echo"
					<div class='alert'>
					<span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
					You have incorrectly inputted your information. Please Try again
					</div>";
				}
				else
				{
					echo "<p> Test is good. Lolz </p>";
					$timeSpent = 0;
					$rate = 0;
					$speed = 0;
					$total_price = 0;
					$transID = 0;
					$total_charge = 0;
					$max_charge = 0;
					$theTime = 0;
					
					
					$sql = "select Transaction_ID from station where Station_id = '$station'";
					$result = $conn->query($sql);
					if($result->num_rows > 0)
					{
						while($row = $result->fetch_assoc()) 
						{
							$transID = $row["Transaction_ID"];
							echo "<p> transaction id: ". $transID . "</p>";
						}
					}
					
					$sql = "insert into transaction_finish(Transaction_ID,Transaction_time_start) values('$transID', 
					(select Transaction_time_start from transaction where Transaction_ID = ('$transID')))";
					if(mysqli_query($conn, $sql))
					{
						echo "<p> Your Drone is done charging </p>";
						$sql = "SELECT TIMESTAMPDIFF(minute,Transaction_time_start,  Transaction_end) as aTime from transaction_finish where Transaction_ID = ('$transID')";//get time spend charging in mintues
						$result = $conn->query($sql);
						if($result->num_rows > 0)
						{
							while($row = $result->fetch_assoc()) 
							{
								
								$timeSpent = $row["aTime"]; //num of mins drone spent charging
								echo "<p> Time spent in minutes: ". $timeSpent . "</p>";
								
								
							}
							
						}
						$sql = "select Transaction_rate,charge_speed from transaction where Transaction_ID = ('$transID')"; //get transaction rate and transaction speed
						$result = $conn->query($sql);
						if($result->num_rows > 0)
						{
							while($row = $result->fetch_assoc()) 
							{
								$rate = $row["Transaction_rate"];
								echo "<p> rate: ". $rate . "</p>";
								
								$speed = $row["charge_speed"];
								echo "<p> speed: ". $speed . "</p>";
									
							}
						}
						$total_charge = $speed * $timeSpent;
						echo "<p> total_charge: ". $total_charge  . "</p>";
						
						$sql = "SELECT drone_battery_life from drone where drone_id = (select drone_id from action where Transaction_id = '$transID')";//get drone battery capacity from drone;
						$result = $conn->query($sql);
						if($result->num_rows > 0)
						{
							while($row = $result->fetch_assoc()) 
							{
								$max_charge = $row["drone_battery_life"];
								echo "<p> max_charge: ". $max_charge  . "</p>";
							}
						}
						
						//$total_price = $rate * $timeSpent;
						//echo "<p>". $total_price . "</p>";
						
						if($total_charge > $max_charge) //if total_charge is greater than the max capacity of drone
						{//set total price to max_charge * rate
							echo "<p> testing when  $total_charge > $max_charge </p>";
							//$total_charge = $max_charge;
							$theTime = $max_charge / $speed ;
							echo " <p> theTime spent in total: ". $theTime . "</p>";
							$total_price = $theTime * $rate;
							echo "<p> price: " .$total_price. "</p> ";
							
							
							
						}
						else //set total price to total_charge * rate
						{
							echo "<p> testing when  $total_charge <= $max_charge </p>";
							//$theTime = $total_charge
							$theTime = $total_charge / $speed ;
							echo " <p> theTime spent in total: ". $theTime . "</p>";
							$total_price = $theTime * $rate;
							echo "<p> price: " .$total_price. "</p> ";
						}
						$sql = "update transaction_finish set Transaction_total = '$total_price' where Transaction_ID = '$transID' "; //
							echo "<p> Test1 </p> ";
							if(mysqli_query($conn, $sql))
							{
								echo "<p> Test2 </p> ";
								$sql = "update station  set Station_available = 'Y',Transaction_ID = '0' where  Station_id = '$station' ";
								if(mysqli_query($conn, $sql))
								{
									echo "<p> Test3 </p> ";
									$sql = "update transaction set Transaction_finished = 'Y' where Transaction_ID = '$transID'";
									if(mysqli_query($conn, $sql))
									{
										echo "<p> Test4 </p> ";
										echo "<p> You owe $".$total_price. ". Pay and  Pick up drone at the station.  </p>
										<a href = 'http://localhost/435project/home.php'> <button> Go Back </button> </a> "
										;
									}
								}
							}
					
			
					
					
						
					}
					
					
					
				}
				
				
				
				
				
				
			}
		}
		
	}
?>