<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
require_once ('config.php');

$id_admin = $_POST['id_admin'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = md5($_POST["password"]);
$tipe = $_POST['tipe'];
$tipeuser = $_POST['tipeuser'];
$loginfrom = $_POST['loginfrom'];
$status = $_POST['status'];
$createddate = $_POST['createddate'];
 
$query = "INSERT INTO tbl_admin (id_admin,username,email,password,tipe,tipeuser,login_from,status,createddate) VALUES ('$id_admin','$username','$email','$password', '$tipe','$tipeuser','$loginfrom','$status','$createddate')";

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