<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
require_once ('config.php');

$id_dana = $_POST['id_dana'];
$id_pengguna = $_POST['id_pengguna'];
$id_produk = $_POST['id_produk'];
$jumlah_dana = $_POST['jumlah_dana'];
$createddate = $_POST['createddate'];
$status_approve = $_POST['status_approve'];

 
$query = "INSERT INTO trx_dana_invest (id_dana, id_pengguna, id_produk, jumlah_dana, createddate, status_approve) VALUES ('$id_dana', '$id_pengguna', '$id_produk', '$jumlah_dana', '$createddate', '$status_approve')";
$sql = mysqli_query($connection, $query);
$ray = array();
    
while ($row = mysqli_fetch_array($sql)){
$ray[] = $row;
}
echo 'Data Submit Successfully';


}else {
$ray = array(
"status" => "false",
"message" => "Bad Request");
echo 'Try Again';

}


?>