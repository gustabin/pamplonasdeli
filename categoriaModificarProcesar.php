<?php
	session_start();  	
	error_reporting(0);
		// conector de BD 
		require_once('tools/mypathdb.php');
				
		$id = $_POST ['cat_id']; //viene oculto
		$categoria = $_POST ['categoria'];		
		$orden = $_POST ['orden'];	
		
		if (!is_numeric($orden)) {
			$data=array("error" => '3');
			die(json_encode($data));
		}
		
	// ========================= Actualizar la tabla productos ==========================================================
	
	$sql="UPDATE tbl_categorias SET categoria='" .$categoria. "', orden=" .$orden. " WHERE id=$id";
	//var_dump($sql);
	//die();
		   if(mysql_query($sql)){
				$data=array("exito" => '1');
		  		die(json_encode($data));
		  }
?>