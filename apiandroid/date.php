<?php

//if($_SERVER['REQUEST_METHOD']=='POST'){
require_once ('config.php');

$id = 1;
$date = new DateTime();
$d =  $date->format('d-m-Y');
//$query = "INSERT INTO t_data_investasi_user (id, id_user, id_data_pinjaman, pinjaman_on_process, status) VALUES ('$id','$id_user','$id_data_pinjaman','$pinjaman_on_process', '$status')";
$query = "UPDATE t_data_pinjaman SET date='$d' WHERE id='$id'";

$sql = mysqli_query($connection, $query);
$ray = array();

while ($row = mysqli_fetch_array($sql)){
$ray[] = $row;
}


?>