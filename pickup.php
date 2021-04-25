
<html>
<head>
	<meta charset = "UTF-8"> <!-- Meta data -->
	<meta name = "pickup" content = "homepage of project">
	<title> "pickup" </title>
	<body>
	<h1> Welcome Back! Input your station you are charging at and your pin number: </h1>
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
					<label> Pleas Insert your 4-digit pin number: </label>
					<input name = "name" type = "number">
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

?>