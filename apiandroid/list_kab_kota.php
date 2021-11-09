<?php

require_once ('koneksi_7pilarpro.php');
 $search_query=$_POST['searchQuery'];
$query = "SELECT * FROM tbl_kabkota WHERE province_id = $search_query";

$sql = mysqli_query($connection, $query);
$ray = array();

while ($row = mysqli_fetch_array($sql)){
$ray[] = $row;
}
echo json_encode($ray);




?>