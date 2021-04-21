<?php 
		echo '<p>Hello World</p>'; 
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "dronecharge";
		$conn = mysqli_connect($servername, $username, $password,$dbname);
		if (!$conn) 
		{
	  die("Connection failed: " . mysqli_connect_error());
		}
		else
		{
			echo "Connected successfully";
		}
?>