<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        	require_once('config.php');
        
        $ImageData = $_POST['image'];
        $ImageName = $_POST['name'];
        $id_user = $_POST['id_user'];

        $ImagePath = "image/profil/$ImageName";

        $insertSQL = "INSERT INTO t_user_image_profil (image_profil, id_pengguna) values('$ImageName','$id_user')";

        if(mysqli_query($connection, $insertSQL)){
            file_put_contents($ImagePath,base64_decode($ImageData));
            echo "Your Image Has Been Uploaded.";
        }

        mysqli_close($connection);
    } else {
        echo "Please Try Again";
    }
 ?>