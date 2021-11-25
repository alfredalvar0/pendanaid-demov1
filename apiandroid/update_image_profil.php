<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        	require_once('config.php');
        
        $ImageData = $_POST['image'];
        $ImageName = $_POST['name'];
        $id_user = $_POST['id_user'];

        $ImagePath = "image/profil/$ImageName";
        //$query = "UPDATE t_data_investasi SET jml_invest='$jml_invest' WHERE id_user='$id' AND id_pinjaman_data = '$id_produk'";
        //$insertSQL = "INSERT INTO t_user_image_profil (image_profil, id_user) values('$ImageName','$id_user')";
        $insertSQL = "UPDATE t_user_image_profil SET image_profil='$ImageName' WHERE id_pengguna='$id_user' ";
        

        if(mysqli_query($connection, $insertSQL)){
            file_put_contents($ImagePath,base64_decode($ImageData));
            echo "Foto profil berhasil di upadate.";
        }

        mysqli_close($connection);
    } else {
        echo "Please Try Again";
    }
 ?>