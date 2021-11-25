
<?php


$server = "localhost";
$username = "mynimstu_investpro";
$password = "investpro2018";
$database = "mynimstu_investpro";


	$connection = mysqli_connect($server, $username, $password, $database);
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}


?>