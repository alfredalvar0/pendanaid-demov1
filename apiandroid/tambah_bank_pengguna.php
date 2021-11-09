<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
require_once ('config.php');

$id_bank_pengguna = $_POST['id_bank_pengguna'];
$id_pengguna = $_POST['id_pengguna'];
$nama_akun = $_POST['nama_akun'];
$no_rek = $_POST['no_rek'];
$bank = $_POST['bank'];
$createddate = $_POST['createddate'];
 
$query = "INSERT INTO tbl_bank_pengguna (id_bank_pengguna, id_pengguna,nama_akun,no_rek,bank, createddate) VALUES ('$id_bank_pengguna','$id_pengguna','$nama_akun','$no_rek','$bank', '$createddate')";

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