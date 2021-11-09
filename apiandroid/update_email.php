<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
require_once ('config.php');

$id = $_POST['id'];
$email = $_POST['email'];

 
$query = "UPDATE tbl_admin SET email='$email' WHERE id_admin='$id'";

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