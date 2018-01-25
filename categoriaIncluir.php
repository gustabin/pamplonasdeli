<?php
	session_start();  
	error_reporting(0);
	// conector de BD 
	require_once('tools/mypathdb.php');

	$categoria = $_POST ['categoria'];
	
	//======================validar que el password tenga mas de 6 caracteres=======================================
	if (strlen($categoria)<5) {
		$data=array("error" => '1');
		die(json_encode($data));
		} 
	if (empty($categoria)) {
		$data=array("error" => '2');
		die(json_encode($data));
		} 
		
	// si todo va bien
	
	// ====================== Insertar los datos en la tabla ===============================
	
	$query_insertar = mysql_query("INSERT INTO tbl_categorias (categoria) VALUES ('$categoria')");

	//Los datos se han insertado correctamente.';		
	$data = array("exito" => '1');
	die(json_encode($data));									
	//desconectar();
	mysql_close();	//cerrar la conexion a la bd
?>