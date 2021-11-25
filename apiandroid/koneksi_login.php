

<?php
	/* ===== www.dedykuncoro.com ===== */
		$server		= "localhost"; //sesuaikan dengan nama server
	$user		= "mynimstu_investpro"; //sesuaikan username
	$password	= "investpro2018"; //sesuaikan password
	$database	= "mynimstu_investpro"; //sesuaikan target database

	
	
	 $con = mysqli_connect($server, $user, $password, $database);
	 if (mysqli_connect_errno()) {
	 	echo "Gagal terhubung MySQL: " . mysqli_connect_error();
	 }

?>