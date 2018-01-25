<?php
session_start();
include "lib/corelib.php";
require_once('tools/mypathdb.php');
error_reporting(0);
$id = $_GET ['id'];	//viene en el URL
//$idProd = $_GET ['idProd'];	//viene en el URL
$foto = $_GET ['foto'];	//viene en el URL	
//$url = 'img/user-icon-180x180.png';  
$url = 'img/users.jpg'; 
$nombreImagen=$_REQUEST['nombreImagen'];
//$query=mysql_query("DELETE FROM tbl_imagenes WHERE ima_nombre = '$nombreImagen'");

        $imagenProducto = 'img/products/';
        //$foto_2 = 'img/products/180X180/';
        unlink($imagenProducto.$_REQUEST["nombreImagen"]);
        //unlink($foto_2.$_REQUEST["nombreImagen"]);
		
//actualizar tabla productos
$archivo="producto.png";
//var_dump("UPDATE tbl_productos SET foto='" .$archivo. "' WHERE id=$id");
//die();

switch ($foto) {
    case foto:
        $sql=mysql_query("UPDATE tbl_productos SET foto='" .$archivo. "' WHERE id=$id");
        break;
    case foto1:
        $sql=mysql_query("UPDATE tbl_productos SET fotoAdicional1='" .$archivo. "' WHERE id=$id");
        break;
    case foto2:
        $sql=mysql_query("UPDATE tbl_productos SET fotoAdicional2='" .$archivo. "' WHERE id=$id");
        break;
	case foto3:
        $sql=mysql_query("UPDATE tbl_productos SET fotoAdicional3='" .$archivo. "' WHERE id=$id");
        break;
    case foto4:
        $sql=mysql_query("UPDATE tbl_productos SET fotoAdicional4='" .$archivo. "' WHERE id=$id");
        break;
	 case foto5:
        $sql=mysql_query("UPDATE tbl_productos SET fotoAdicional5='" .$archivo. "' WHERE id=$id");
        break;
}

//===================================================Redirigir a otra pagina============================================
//	header("Location: subir.php");

		  mysql_close();
		  $data=array("exito" => '1');
		  die(json_encode($data));
?>