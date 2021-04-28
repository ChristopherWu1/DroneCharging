<!DOCTYPE html>
<html>
<head>
<style>
body{
background-color:#91E8E1
}
.content
{
  height:200px;
  width:400px;
  position: fixed;
  top:20%;
  left:38%;
  text-align: center;
  margin: auto;
  }
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
.button1 {background-color: #008CBA;} /* Blue */
</style>
<div class ="content">
<title> "pickup" </title>
	<body>
	<h1> Welcome Back! Input the station you are charging at and your pin number: </h1>
	 <?php 
 echo '<p>Hello World</p>'; 
	?>
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
					<label> Please Insert your 4-digit pin number: </label>
					<input name = "name" type = "number">
		</div>
		
		<div>
					<input type = "submit" value = "Submit"> 
		</div>
	</form>
		<div></div>
			<a href = "http://localhost/435project/mainpage.php" class = "button button1">Go Back to Main Page </a> 
		<div></div>
		</div>
	</body>

</head>
</html>

<?php

?>
