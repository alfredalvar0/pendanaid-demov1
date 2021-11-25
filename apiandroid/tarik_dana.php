<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
require_once ('config.php');

$id_dana = $_POST['id_dana'];
$id_pengguna = $_POST['id_pengguna'];
$id_bank = $_POST['id_bank'];
$nama_akun = $_POST['nama_akun'];
$no_rek = $_POST['no_rek'];
$type_dana = $_POST['type_dana'];
$jumlah_dana = $_POST['jumlah_dana'];
$status_approve = $_POST['status_approve'];
$createddate = $_POST['createddate'];


 
$query = "INSERT INTO trx_dana (id_dana, id_pengguna, id_bank, nama_akun,no_rek, type_dana, jumlah_dana, status_approve, createddate) VALUES ('$id_dana', '$id_pengguna', '$id_bank', '$nama_akun','$no_rek','$type_dana' , '$jumlah_dana', '$status_approve', '$createddate
')";
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