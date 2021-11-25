
<?php



$servername = "localhost";
$username = "mynimstu_investpro";
$password = "investpro2018";
$dbname = "mynimstu_investpro";


try {
    	$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    	die("OOPs something went wrong");
    }

?>