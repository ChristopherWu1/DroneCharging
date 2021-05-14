<!DOCTYPE html>
<html>
<head>
<style>
* {
 font-family: Helvetica;
}

/* Styles the buttons */
.button {
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.6), 0 6px 20px 0 rgba(0, 0, 0, 0.25);
  font-family:Arial;
  transition-duration: 0.4s;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
/* Styles the middle center of the page */
.content{
  height:600px;
  width:400px;
  background-color:#e1f7d5;
  box-shadow: 10px 10px 20px 10px black;
  border: 4px outset grey;
  position: fixed;
  top:20%;
  left:38%;
  text-align: center;
  font-size:20px;
  margin: auto;
  }
  /* Background color of the page */
body{
background-color:#e6bbad;
}
/* Styles the bottom part of the page */
.bottomfooter
{
background-color:#e6bbad;
overflow:hidden;
position:fixed;
color:white;
text-align:center;
left:0;
bottom:0;
width:100%
}
/* Styles the top navigation bar of the page */
.topnav {
position:absolute;
top:0;
left:0;
right:0;
  overflow: hidden;
  background-color: #99cfe0;
}
/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
 /* Edits the left hand side of the page */
}
.leftpage
{
position:absolute;
bottom:40%;
left: 10%;
}
/* Edits the right hand side of the page */
.rightpage
{
position:absolute;
bottom: 38%;
right: 10%;
}
/* Style specific buttons */
.button1 {
background-color: #ff007f;
}
.button1:hover
{
	background-color:#b30059;
}
.button2 
{
	background-color: #006bff;
}
.button2:hover
{
	background-color:#004bb3;
}
</style>
<meta charset = "UTF-8">
<meta name = "home" content ="homepage of project">
<title> app for drone charging station</title>
</head>
<body>
<div class="topnav">
  <a class="active" href="http://localhost/435project/mainpage.php">Home</a>
  <a href="http://localhost/435project/contact.php">Contact</a>
</div>
<div class="leftpage">
<img src="drone.jpg">
</div>
<div class = "rightpage">
<img src="drone1.jpg"
</div>
<div class = "content">
<h1>Welcome to our drone charging station!</h1>
<p> Select whether you're dropping off your drone or picking up your drone:</p>
<a href="http://localhost/435project/pick-up.php" class ="button button1">Pick-up</a>
<a href="http://localhost/435project/drop-off.php" class ="button button2">Drop-off</a> 
<!--<a href="http://localhost/435project/payment.php" class ="button button2">payment</a>  comment out later -->
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
<footer class = "bottomfooter">
<p>All Rights Reserved @2021</p>
</footer>

</html>