<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
require_once ('config.php');

$id = $_POST['id_user'];
$saldo = $_POST['jml_saldo'];

 
//$query = "INSERT INTO t_data_investasi_user (id, id_user, id_data_pinjaman, pinjaman_on_process, status) VALUES ('$id','$id_user','$id_data_pinjaman','$pinjaman_on_process', '$status')";
$query = "UPDATE t_saldo_sementara SET jml_saldo='$saldo' WHERE id_user='$id'";

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