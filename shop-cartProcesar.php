<?php
session_start(); 
error_reporting(0);

$_SESSION['aceptar'] = $_POST['chk_aceptar'];

			if ($_SESSION['aceptar']<>1)  {
				$data = array("error" => '1');
				die(json_encode($data));
			}

			if ($_SESSION['aceptar']==1)  {
			$data=array("exito" => '1'); 
			die(json_encode($data));	
			}
?>