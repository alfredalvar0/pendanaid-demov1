<?php


require_once ('config.php');
//SELECT * FROM actor
//WHERE actor_id IN 
//	(SELECT actor_id FROM film_actor
//	WHERE film_id = 2);
$query = 'SELECT * from trx_produk';

$sql = mysqli_query($connection, $query);
$ray = array();

while ($row = mysqli_fetch_array($sql)){
$ray[] = $row;
}
echo json_encode($ray);





?>