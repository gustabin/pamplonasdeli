<?php
session_start(); 
error_reporting(0);
require_once('tools/mypathdb.php');
$email = strtolower($_POST ['email']);
$clave = $_POST ['password'];

	$query = mysql_query("SELECT * FROM tbl_usuarios WHERE us_email = '$email' AND us_clave = '$clave'"); 
	$dataUsuario = mysql_fetch_array($query);	
	
	$usuario = $dataUsuario['us_tipo']; 
	$userID = $dataUsuario['us_id']; 
	$status = $dataUsuario['us_status']; 
	$_SESSION['user_id'] = $userID;
	$nombre = $dataUsuario['us_nombre']; 
	$apellido = $dataUsuario['us_apellido']; 
	
	if (empty($_SESSION['email'])) {
		$_SESSION['email'] = $dataUsuario['us_email'];
	}	
	
	if (!empty($_SESSION['email'])) {
		// ========================= actualizar la tabla temporal =========================================	
		$query = mysql_query("UPDATE tbl_temporal SET email='$email' WHERE email='".$_SESSION['email']."'");	
		$_SESSION['email'] = $email;
	}
	$_SESSION['nombre'] = $dataUsuario['us_nombre'];
	$_SESSION['apellido'] = $dataUsuario['us_apellido'];
	$_SESSION['telefono']= $dataUsuario['us_telefono'];
	$_SESSION['direccion']= $dataUsuario['us_direccion'];
	$_SESSION['direccionEnvio']= $dataUsuario['us_direccionEnvio'];
	$_SESSION['cedulaRif']= $dataUsuario['us_cedulaRif'];
	$_SESSION['empresa']= $dataUsuario['us_empresa'];
	$_SESSION['$usuario']= $usuario;
	
	if ($status=='2') //verificar si la cuenta esta activa o inactiva
		{
		$data=array("error" => '2');
		die(json_encode($data));
		} 
	 
	if(empty($dataUsuario))
		{
		$data=array("error" => '1');
		die(json_encode($data));
		}
		
	if(!empty($_SESSION['nombre']))
		{
		  mysql_close();
		  $data=array("exito" => '1');
		  die(json_encode($data));
		}
?>