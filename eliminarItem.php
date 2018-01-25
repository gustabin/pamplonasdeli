<?php
session_start(); 
//error_reporting(0);
require_once('tools/mypathdb.php');
	$codigoProducto = $_GET ['codProducto'];
    $cit_status=5; //marcar como borrada
	$email = $_SESSION['email'];
	$query = mysql_query("DELETE FROM tbl_temporal WHERE email='".$email."' AND codigoProducto = '".$codigoProducto."'");	
	
	
	$sql = "SELECT * FROM tbl_temporal WHERE email='".$email."'";
	$result = mysql_query($sql);
	$numero = mysql_num_rows($result); 
	$_SESSION['cantidadDeProductos']= $numero;
	
	//desconectar();		
	mysql_close();
	header("Location: shop-cart.php")
?>