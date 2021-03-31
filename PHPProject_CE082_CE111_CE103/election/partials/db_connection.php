<?php
//using PDO
try{
$conn = new PDO('mysql:host=127.0.0.1;dbname=election','root','');
	// echo "Connection is established...<br/>";
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e){
	echo $e->getMessage();
	die();
}



?>