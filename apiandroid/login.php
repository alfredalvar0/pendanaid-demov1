<?php
	
	//=================== KALAU PAKAI MYSQLI YANG ATAS SEMUA DI REMARK, TERUS YANG INI RI UNREMARK ========
	 include "koneksi_login.php";
	error_reporting(0);
	 class usr{}
	
	 $username = $_POST["username"];
	  $password = md5($_POST["password"]);
	
	 if ((empty($username)) || (empty($password))) { 
	 	$response = new usr();
	 	$response->success = 0;
	 	$response->message = "Kolom tidak boleh kosong"; 
	 	die(json_encode($response));
	 }
	
	 $query = mysqli_query($con,"SELECT * FROM tbl_admin WHERE email='$username' AND password='$password'");
	
	 $row = mysqli_fetch_array($query);
	
	 if (!empty($row)){
	 	$response = new usr();
	 	$response->success = 1;
	 	$response->message = "Selamat datang ".$row['email'];
	 	$response->id = $row['id_admin'];
	 	$response->username = $row['email'];
	 	$response->name = $row['username'];
	 	$response->tipe = $row['tipe'];
	 	$response->status = $row['status'];
	 	die(json_encode($response));
		
	 } else { 
	 	$response = new usr();
	 	$response->success = 0;
	 	$response->message = "Username atau password salah";
	 	die(json_encode($response));
	 }
	
	 mysqli_close($con);

?>