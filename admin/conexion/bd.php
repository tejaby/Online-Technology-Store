<?php 
$host="localhost";
$bd="spacepc";
$usuario="root";
$contra="";

try {
	$conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contra);

} catch (Exception $ex) {
	echo $ex->getMessage();
}
?>