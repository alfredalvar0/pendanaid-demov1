<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
require_once ('config.php');

$id = $_POST['id'];
$id_user = $_POST['id_user'];
$id_data_pinjaman = $_POST['id_data_pinjaman'];
$pinjaman_on_process = $_POST['pinjaman_on_process'];
$status = $_POST['status'];
$title = $_POST['title'];
$hari = $_POST['hari'];
$jumlah_terkumpul = $_POST['jumlah_terkumpul'];
$jumlah_pinjaman = $_POST['jumlah_pinjaman'];
$jumlah_slot = $_POST['jumlah_slot'];
$jumlah_bagi_hasil = $_POST['jumlah_bagi_hasil'];
$pengembalian_pokok_investasi = $_POST['pengembalian_pokok_investasi'];
$tenor = $_POST['tenor'];
$jumlah_lender = $_POST['jumlah_lender'];
$image_url = $_POST['image_url'];
$date = $_POST['date'];

 
$query = "INSERT INTO t_data_investasi VALUES ('$id','$id_user','$id_data_pinjaman','$pinjaman_on_process', '$status','$title','$hari','$jumlah_terkumpul','$jumlah_pinjaman','$jumlah_slot','$jumlah_bagi_hasil','$pengembalian_pokok_investasi','$tenor','$jumlah_lender','$image_url','$date')";
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