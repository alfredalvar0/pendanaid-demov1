<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
require_once ('config.php');

$id = $_POST['id_user'];
$id_produk = $_POST['id_produk'];
$jml_invest = $_POST['jml_invest'];

 
$query = "UPDATE t_data_investasi SET jml_invest='$jml_invest' WHERE id_user='$id' AND id_pinjaman_data = '$id_produk'";

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