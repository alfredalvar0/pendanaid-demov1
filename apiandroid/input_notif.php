<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
require_once ('config.php');

$id = $_POST['id'];
$id_user = $_POST['id_user'];
$title = $_POST['title'];
$deskripsi = $_POST['deskripsi'];

 
$query = "INSERT INTO t_notif VALUES ('$id','$id_user','$title','$deskripsi', '0')";


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