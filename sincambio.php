<?php
session_start(); 
error_reporting(0);
$_SESSION['direccionCambiar'] = False;
	//===================================================Redirigir a otra pagina============================================
	header("Location: pagar.php?ocultar=1"); 
?>