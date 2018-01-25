<?php
// Buscar producto 
	session_start();  

	$_SESSION['nombreProducto'] = $_POST['nombre'];

	$data = array("exito" => '1');
	die(json_encode($data));		

?>