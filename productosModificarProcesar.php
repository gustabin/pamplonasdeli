<?php
	session_start();  	
	error_reporting(0);
		// conector de BD 
		require_once('tools/mypathdb.php');
		//$id=$_SESSION['id'];
				
		$id = $_POST ['prod_id']; //viene oculto
	
		$producto = $_POST ['producto'];
		$codigo = $_POST ['codigo'];
		$revisiones= $_POST['revisiones'];
		$unidadesPaquete= $_POST['unidadesPaquete'];
		$pesoAprox= $_POST['pesoAprox'];
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
		$relacionado1 = $_POST ['relacionado1'];
		$relacionado2 = $_POST ['relacionado2'];
		$relacionado3 = $_POST ['relacionado3'];
		$relacionado4 = $_POST ['relacionado4'];
		
		
		
		
		
	// ========================= Actualizar la tabla productos ==========================================================
	
	$sql="UPDATE tbl_productos SET producto='" .$producto. "', codigo='" .$codigo. "', revisiones=" .$revisiones. ", unidadesPaquete='" .$unidadesPaquete. "', pesoAprox='" .$pesoAprox.
	     "', valoracion=" .$valoracion. ", precio=" .$precio. ", foto='" .$foto. "', fotoAdicional1='" .$fotoAdicional1. "', fotoAdicional2='" .$fotoAdicional2. 
		 "', fotoAdicional3='" .$fotoAdicional3. "', fotoAdicional4='" .$fotoAdicional4. "', fotoAdicional5='" .$fotoAdicional5. 
		 "', relacionado1='" .$relacionado1. "', relacionado2='" .$relacionado2. "', relacionado3='" .$relacionado3. "', relacionado4='" .$relacionado4.
		 "', descripcion='" .$descripcion. "', ingredientes='" .$ingredientes. "', cantidad=" .$cantidad. ", categoria='" .$categoria. "' WHERE id=$id";
	
	// var_dump($sql);
	//die();
	
		   if(mysql_query($sql)){
				 $data=array("exito" => '1');
		  		die(json_encode($data));
		  }
?>