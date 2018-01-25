<?php
session_start(); 
error_reporting(0);

$_SESSION['direccionCambiar'] = True;
$data=array("exito" => '1');
die(json_encode($data));	
?>