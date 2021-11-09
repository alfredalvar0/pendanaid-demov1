<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
require_once ('config.php');


$id_pengguna = $_POST['id_pengguna'];
$nama_pengguna = $_POST['username'];
$id_admin = $_POST['id_admin'];
$createddate = $_POST['createddate'];
 
$query = "INSERT INTO tbl_pengguna (id_pengguna,nama_pengguna,id_admin,createddate) VALUES ('$id_pengguna','$nama_pengguna','$id_admin','$createddate')";

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