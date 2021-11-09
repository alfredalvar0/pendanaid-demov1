<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
require_once ('config.php');

$id = $_POST['id'];
$id_user = $_POST['id_user'];
$pinjaman_on_process = $_POST['pinjaman_on_process'];
$status = $_POST['status'];
$id_data_pinjaman = $_POST['id_data_pinjaman'];

 
$query = "INSERT INTO t_data_investasi_user (id, id_user, id_data_pinjaman, pinjaman_on_process, status) VALUES ('$id','$id_user','$id_data_pinjaman','$pinjaman_on_process', '$status')";
//$query = "INSERT INTO t_data_investasi_user (id, id_user, pinjaman_on_process, status) VALUES ('1',7','90000', 'Berlangsung')";

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