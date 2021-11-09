<?php
 
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		require_once('config.php');
		$image = $_POST['image_url'];
	//	$name = $_POST['image_url'];
		
	//	$sql ="SELECT id FROM photos ORDER BY id ASC";
		
	///	$res = mysqli_query($connection,$sql);
		
//		$id = 0;
		
//		while($row = mysqli_fetch_array($res)){
//				$id = $row['id'];
//		}
		
		$path = "image/user_ttd/hjkskj.png";
		
	//	$actualpath = "http://explore-ti.tech/investpro/$path";
        $actualpath = "http://deepercode.online/investpro/$path";	
		$sql = "INSERT INTO t_image_ttd VALUES ('1','$actualpath')";
		
		if(mysqli_query($connection,$sql)){
			file_put_contents($path,base64_decode($image));
			echo "Successfully Uploaded";
		}
		
		mysqli_close($connection);
	}else{
		echo "Error";
	}