<?php
session_start(); 
require_once('tools/mypathdb.php');

	$cat_id = $_GET ['id'];
   //============================Borrar producto de tabla productos ==============================
	$query=mysql_query("DELETE from tbl_categorias WHERE id='$cat_id'");
	//desconectar();		
	mysql_close();
	header("Location: categorias.php")
?>
