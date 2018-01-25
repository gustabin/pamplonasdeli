<?php
date_default_timezone_set('America/Caracas');
session_start(); 
error_reporting(0);
require_once('tools/mypathdb.php');
$fecha_actual = date("Y-m-d");
$fecha = $fecha_actual;

$codigoProducto = $_POST ['codigoProducto'];
$cantidadInventario = $_POST ['cantidadInventario'];
$cantidad = $_POST ['cantidad'];
$email = $_SESSION['email'];
	
$sql = "SELECT * FROM tbl_temporal WHERE email='".$email."'";

$result = mysql_query($sql);
$numero = mysql_num_rows($result); 
$_SESSION['cantidadDeProductos']= $numero; 

if ($cantidad>$cantidadInventario) {
	$data=array("error" => '3');
	die(json_encode($data));
}

if (empty($cantidad)) {
	$data=array("error" => '1');
	die(json_encode($data));
}

if ($cantidad<=0) {
	$data=array("error" => '1');
	die(json_encode($data));
}

if (!is_numeric($cantidad)) { 
	$data=array("error" => '2');
	die(json_encode($data));
}

$query = mysql_query("SELECT * FROM tbl_temporal WHERE email='".$email."' AND codigoProducto = '".$codigoProducto."'");

$dataProducto = mysql_fetch_array($query);	
if(!empty($dataProducto))
		{
		$sql="UPDATE tbl_temporal SET cantidad='".$cantidad."' WHERE email='".$email."' AND codigoProducto='".$codigoProducto. "'";
		
		  if(mysql_query($sql)){
				$data=array("exito" => '1');
				die(json_encode($data));
		  }
		}	
else {    
	  if (!empty($email)) {
		  $query = mysql_query("INSERT INTO tbl_temporal (email, codigoProducto, cantidad, fecha) VALUES ('".$email."','".$codigoProducto."',  ".$cantidad.", '".$fecha."');");
		  $dataTemporal = mysql_fetch_array($query);
		  
		  $sql = "SELECT * FROM tbl_temporal WHERE email='".$email."'";
		  $result = mysql_query($sql);
		  $numero = mysql_num_rows($result); 
		  $_SESSION['cantidadDeProductos']= $numero; 
	  
		  $data=array("exito" => '1');// 
		  die(json_encode($data));
	  }
			  
	  if (empty($email)) {
		  $email= rand(); //generar email
		  $_SESSION['email'] = $email;
		  $query = mysql_query("INSERT INTO tbl_temporal (email, codigoProducto, cantidad, fecha) VALUES ('".$email."','".$codigoProducto."',  ".$cantidad.", '".$fecha."');");
		  $dataTemporal = mysql_fetch_array($query);
		  
		  $sql = "SELECT * FROM tbl_temporal WHERE email='".$email."'";
		  $result = mysql_query($sql);
		  $numero = mysql_num_rows($result); 
		  $_SESSION['cantidadDeProductos']= $numero;
		  
		  $data=array("exito" => '1');// 
		  die(json_encode($data));
	  }
}
	mysql_close(); //desconectar();
?>