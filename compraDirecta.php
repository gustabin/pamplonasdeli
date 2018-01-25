<?php
date_default_timezone_set('America/Caracas');
session_start(); 
error_reporting(0);
require_once('tools/mypathdb.php');
$fecha_actual = date("Y-m-d");
$fecha = $fecha_actual;


$codProducto = $_GET['codProducto'];

//********** Buscar el codigo del producto en la tabla PRODUCTOS *********************************************
	$query = mysql_query("SELECT * FROM tbl_productos WHERE codigo = '$codProducto'"); 
	$dataProducto = mysql_fetch_array($query);	
	
		$foto = $dataProducto['foto'];  // foto del empaque
		$producto = $dataProducto['producto']; 
		$unidadesPaquete = $dataProducto['unidadesPaquete']; 
		$pesoAprox = $dataProducto['pesoAprox']; 
		$valoracion = $dataProducto['valoracion']; 	
		$precio = $dataProducto['precio']; 
		$fotoAdicional1 = $dataProducto['fotoAdicional1']; 
		$fotoAdicional2 = $dataProducto['fotoAdicional2']; 
		$fotoAdicional3 = $dataProducto['fotoAdicional3']; 
		$fotoAdicional4 = $dataProducto['fotoAdicional4']; 
		$fotoAdicional5 = $dataProducto['fotoAdicional5']; 
		$relacionado1 = $dataProducto['relacionado1'];
		$relacionado2 = $dataProducto['relacionado2'];
		$relacionado3 = $dataProducto['relacionado3'];
		$relacionado4 = $dataProducto['relacionado4'];
		$descripcion = $dataProducto['descripcion']; 
		$ingredientes = $dataProducto['ingredientes']; 
		$cantidadInventario = $dataProducto['cantidad']; 
		$categoria = $dataProducto['categoria']; 
		$codigo = $dataProducto['codigo']; 

//if (($cantidadInventario=0) or empty($cantidadInventario)) {
	//header("Location: index.php");
	//die();
//}
	$cantidad = 1; // cantidad asignada en compra directa
	$email = $_SESSION['email'];	
	$sql = "SELECT * FROM tbl_temporal WHERE email='".$email."'";
	$result = mysql_query($sql);
	$numero = mysql_num_rows($result); 
	$_SESSION['cantidadDeProductos']= $numero; 
	
	$query =  mysql_query("SELECT * FROM tbl_temporal WHERE email='".$email."' AND codigoProducto = '".$codProducto."'");
	$dataProducto = mysql_fetch_array($query);	
	if(!empty($dataProducto))
			{
			$sql=mysql_query("UPDATE tbl_temporal SET cantidad='".$cantidad."' WHERE email='".$email."' AND codigoProducto='".$codProducto. "'");
			//$sql=("UPDATE tbl_temporal SET cantidad='".$cantidad."' WHERE email='".$email."' AND codigoProducto='".$codProducto. "'");
			
			  //if(($sql)){
					//$data=array("exito" => '1');					
					//die(json_encode($data));
					header("Location: index.php");
					die();
			  //}
			}
	else {    
		  if (!empty($email)) {
			  $query = mysql_query("INSERT INTO tbl_temporal (email, codigoProducto, cantidad, fecha) VALUES ('".$email."','".$codProducto."',  ".$cantidad.", '".$fecha."');");
			  $dataTemporal = mysql_fetch_array($query);
			  $sql = "SELECT * FROM tbl_temporal WHERE email='".$email."'";
			  $result = mysql_query($sql);
			  $numero = mysql_num_rows($result); 
			  $_SESSION['cantidadDeProductos']= $numero; 
		  
			  //$data=array("exito" => '1');// 
			  //die(json_encode($data));
			  header("Location: index.php");
			  die();
		  }
				  
		  if (empty($email)) {
			  $email= rand(); //generar email
			  $_SESSION['email'] = $email;
			  $query = mysql_query("INSERT INTO tbl_temporal (email, codigoProducto, cantidad, fecha) VALUES ('".$email."','".$codProducto."',  ".$cantidad.", '".$fecha."');");
			  $dataTemporal = mysql_fetch_array($query);
			  
			  $sql = "SELECT * FROM tbl_temporal WHERE email='".$email."'";
			  $result = mysql_query($sql);
			  $numero = mysql_num_rows($result); 
			  $_SESSION['cantidadDeProductos']= $numero;
			  
			  //$data=array("exito" => '1');//  
			  //die(json_encode($data));
			  header("Location: index.php");
			  die();
		  }
	}
		mysql_close(); //desconectar();


	header("Location: index.php");
?>