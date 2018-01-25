<?php
	session_start();  	
	error_reporting(0);
		// conector de BD 
		require_once('tools/mypathdb.php');
	
		$producto = $_POST ['producto'];
		$codigo = $_POST ['codigo'];
		$revisiones= $_POST['revisiones'];
		$unidadesPaquete= $_POST['unidadesPaquete'];
		$valoracion = $_POST ['valoracion'];
		$precio = $_POST ['precio'];
		$foto= $_POST['foto'];
		$fotoAdicional1= $_POST['fotoAdicional1'];
		$fotoAdicional2 = $_POST ['fotoAdicional2'];
		$fotoAdicional3 = $_POST ['fotoAdicional3']; 
		$fotoAdicional4 = $_POST ['fotoAdicional4'];
		$fotoAdicional5 = $_POST ['fotoAdicional5'];
		$descripcion = $_POST ['descripcion'];
		$ingredientes= $_POST['ingredientes'];
		$cantidad = $_POST ['cantidad'];
		$categoria = $_POST ['categoria'];		
		
	// ========================= Actualizar la tabla productos ==========================================================
	
	$query = mysql_query("INSERT INTO tbl_productos (producto, codigo, revisiones, unidadesPaquete, valoracion, precio, foto, fotoAdicional1, fotoAdicional2, fotoAdicional3, fotoAdicional4, fotoAdicional5, descripcion, ingredientes, cantidad, categoria) VALUES ('".$producto."','".$codigo."','".$revisiones."','".$unidadesPaquete."','".$valoracion."','".$precio."','".$foto."','".$fotoAdicional1."','".$fotoAdicional2."','".$fotoAdicional3."','".$fotoAdicional4."','".$fotoAdicional5."','".$descripcion."','".$ingredientes."','".$cantidad."','".$categoria."');");
	
  $dataProducto = mysql_fetch_array($query);
  $data=array("exito" => '1');// 
  die(json_encode($data));
  mysql_close(); //desconectar();
	// var_dump($sql);
	//die();
	
		   
?>