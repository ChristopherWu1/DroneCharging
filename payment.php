<!DOCTYPE html>
<html>
<style>
/* Styles the non-input buttons */
* {
 font-family: Helvetica;
}
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
  top:22%;
  left:38%;
  text-align: center;
  font-size:18px;
  margin: auto;
  }
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
/*.topnav styles the topbar of the webpage */
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
}
/* Styles the input type buttons */
input[type=submit]
{
	background-color: #4CAF50;
  border: none;
  color: white;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.6), 0 6px 20px 0 rgba(0, 0, 0, 0.25);
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  transition-duration:0.4s;
  font-family:Arial;
  font-size: 16px;
  cursor: pointer;
}
input[type=submit]:hover
{
	background-color:#357a38
}
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
.button1 {
background-color: #ff007f;
}
.button1:hover
{
	background-color:#b30059;
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
	<title> Payment </title>
</head>

<body>
<div class="topnav">
  <a class="active" href="http://localhost/435project/mainpage.php">Home</a>
  <a href="http://localhost/435project/contact.php">Contact</a>
 </div>
  <div class ="content">
	
	
		<div>	
			<p style="font-size:22px"> Please input your credit card credentials </p>
			<form action = "" method = "post">
				<div>
							<label> Please insert your 16-digit credit card number: </label>  <!-- credit card number -->
							<input name = "card" type = "number" style="height:30px">
				</div>
				<div>
							<label> Please insert your expiration date: </label>  <!-- Pin Number -->
							<input name = "expiration" type = "month" style="height:30px">
				</div>
				<div>
							<label> Please insert your CVV number: </label>  <!-- Pin Number -->
							<input name = "cvv" type = "number" style="height:30px">
				</div>
				<div>
							<input type = "submit" name = "creditCard" value = "Submit" > <!-- Submit button-->
				</div>
			</form>
		</div>
			<div></div>
			<!--	<a href = "http://localhost/435project/mainpage.php" class = "button button1"> Go Back  </a>  Button to go back to home.php-->
			<div></div>
	
	
	
</body>



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
		$card = $_POST['card'] ?? "";
		$expiration = $_POST['expiration'] ?? "";
		$cvv = $_POST['cvv'] ?? "";
		$current_date = "";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				
			
				if(empty($card) || empty($expiration)|| empty($cvv)) //if any values are empty, user left it blank
				{
					//echo "<p> All the fields are required. Please Try Again </p>";
					echo "<div class='alert'>
						<span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
						All the fields are required. Please Try Again!
						</div>";
				}
				else
				{
					if(strlen($card) != 16 || strlen($cvv) != 3)
					{
						echo"
					<div class='alert'>
					<span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
					Your credentials are invalid. Please Try again
					</div>";
					}
					else
					{
						$expiration = $expiration. "-01";
						//echo $expiration;
						$sql = "SELECT CURDATE() as theDate;";
						$result = $conn->query($sql);
							if($result->num_rows > 0)
							{
								while($row = $result->fetch_assoc()) 
								{
									$current_date = $row["theDate"];
									//echo $current_date;
								}
							}
						if($current_date > $expiration)
						{
							echo "<div class='alert'>
						<span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
						Your card is expired! Please try another card
						</div>";
						}
						else
						{
							//echo "<p> test1 </p>";
							$sql = "INSERT INTO payment_info(Transaction_ID,card_number,expiration_date,cvv) VALUES ((select Transaction_ID from transaction_finish where Transaction_end = (SELECT max(Transaction_end) FROM transaction_finish)), '$card', '$expiration','$cvv');"; //insert into payment)info
							if(mysqli_query($conn, $sql))
							{
								//echo "<p> test2 </p>";
								$sql = "update transaction set Transaction_finished = 'Y' where Transaction_ID = (select Transaction_ID from transaction_finish where Transaction_end = (SELECT max(Transaction_end) FROM transaction_finish))";//update Transaction_finished
								if(mysqli_query($conn, $sql))
										{
											$sql = "update station  set Station_available = 'Y'  where  Station_id = (select Station_id from action where Transaction_ID = (select Transaction_ID from transaction_finish where Transaction_end = (SELECT max(Transaction_end) FROM transaction_finish)));";//update Station_available
											if(mysqli_query($conn, $sql))
											{
												//echo "<p> test3 </p>";
												echo"
													<div class='alert0'>
													<span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
													You have successfully paid. Thank you for you service!
													</div>
													
													<a href = 'http://localhost/435project/mainpage.php'> <button> Go to homepage </button> </a>
													
													";
											}
										}
							}
						}
					}
				}
			}
	}

?>
</div>
<footer class = "bottomfooter">
<p>All Rights Reserved @2021</p>
</footer>
</html>

