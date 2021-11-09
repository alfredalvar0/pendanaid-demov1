<?php

require_once ('koneksi_7pilarpro.php');
$query = 'SELECT * from tbl_bank';

$sql = mysqli_query($connection, $query);
$ray = array();

while ($row = mysqli_fetch_array($sql)){
$ray[] = $row;
}
echo json_encode($ray);




?>