<?php 	
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'servitec';

	$conection = @mysqli_connect($host,$user,$pass,$db);

	if(!$conection){
		echo "Error en la conexion";
	}
?>