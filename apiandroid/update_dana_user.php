<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
require_once ('config.php');

$id = $_POST['id_user'];
$dana_investasi = $_POST['dana_investasi'];
$pinjaman_on_process = $_POST['pinjaman_on_process'];

 
$query = "UPDATE t_dana_user SET dana_investasi='$dana_investasi', pinjaman_on_process='$pinjaman_on_process' WHERE id_user='$id'";

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