<?php
session_start(); 
require_once('tools/mypathdb.php');
	$prod_id = $_GET ['id'];
   //============================Borrar producto de tabla productos ==============================
	$query=mysql_query("DELETE from tbl_productos WHERE id='$prod_id'");
	//desconectar();		
	mysql_close();
	header("Location: productos.php")
?>