<?php
session_start(); 
error_reporting(0);
require_once('tools/mypathdb.php');
$direccion = $_POST ['Direccion'];

$_SESSION['direccionEnvio'] = $direccion;


	if (strlen($direccion)<20) {
			$data=array("error" => '1');
			die(json_encode($data));
			} 
	
	if (!empty($direccion)) {
		// ========================= actualizar la tabla temporal =========================================	
		$query = mysql_query("UPDATE tbl_usuarios SET us_direccionEnvio='$direccion' WHERE us_email='".$_SESSION['email']."'");	
		
		$_SESSION['direccionCambiar'] = False;
		$data=array("exito" => '1');
		die(json_encode($data));
	}

	 
	if(empty($direccion))
		{
		$data=array("error" => '1');
		die(json_encode($data));
		}
?>