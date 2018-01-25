<?php
//Si se quiere subir una imagen
session_start();
require_once('tools/mypathdb.php');
error_reporting(0);

include "headerOtro.php"; //se usa otro header por conflicto con    ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js
$id = trim($_GET ['id']);	//viene en el URL
$idProd = $_GET ['idProd'];	//viene en el URL
$foto = $_GET ['foto'];	//viene en el URL

?>
<script Language="JavaScript">
function eliminarFoto(nombreImagen) {
		//$('#barra').show();
		$.ajax({
		type: "POST",
		url: "fotosBorrar.php?foto=<?php echo $foto ?>&id=<?php echo $id ?>&nombreImagen="+nombreImagen,
		dataType: "json",
		data: $(this).serialize(),
		success: function(respuesta) {
			$('#barra').hide();
		    if (respuesta.error == 1) {
			  $('#error1').show();
			setTimeout(function() {
			  $('#error1').hide();
			}, 3000);
		    }
			
			if (respuesta.error == 2) {
			  $('#error2').show();
			setTimeout(function() {
			  $('#error2').hide();
			}, 3000);
		    }
			
			if (respuesta.error == 4) {
			  $('#error4').show();
			setTimeout(function() {
			  $('#error4').hide();
			}, 3000);
		    }
			
			if (respuesta.exito == 1) {
			  $('#mensaje').show();
			  setTimeout(function() {
			  $('#mensaje').hide();
			  window.location.href='fotomodificar.php?id=<?php echo $id ?>&foto=<?php echo $foto ?>&idProd=<?php echo $idProd ?>'; 
			}, 3000);
		    }
			
		}//success
	    });//ajax
	}//function

</script>
<?php
if (isset($_POST['subir'])) {	
   //Recogemos el archivo enviado por el formulario
   $archivo = $_FILES['archivo']['name'];
   //Si el archivo contiene algo y es diferente de vacio
   
   if (isset($archivo) && $archivo != "") 
   	{
      //Obtenemos algunos datos necesarios sobre el archivo
      $tipo = $_FILES['archivo']['type'];
      $tamano = $_FILES['archivo']['size'];
      $temp = $_FILES['archivo']['tmp_name'];
      //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
     if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
        echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
        - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
     }
     else 
	 {
        //Si la imagen es correcta en tamaño y tipo
        //Se intenta subir al servidor
        if (move_uploaded_file($temp, 'img/products/'.$archivo)) 
		{
            //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
            chmod('images/'.$archivo, 0777);
            //Mostramos el mensaje de que se ha subido con éxito
            echo '<div><b>Se ha subido correctamente la imagen: ' .$archivo. '</b></div>';
            //Mostramos la imagen subida
            echo '<p><img src="img/products/'.$archivo.'"></p>';
			?>
            <img src="img/borrar.png" onclick="eliminarFoto('<?php echo $archivo ?>')" style="cursor:pointer;">
            
            <a href='productosModificar.php?id=<?php echo $id ?>'>
                    <img src="img/continuar.png" style="cursor:pointer;">
      		</a>
            <div style="float:left; display:none" id="barra"><img src="img/barra.gif" alt="Cargando..."/><br>Eliminando foto</div>
            <?php	
			//actualizar tabla productos
			switch ($foto) 
			{
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
        }
        else {
           //Si no se ha podido subir la imagen, mostramos un mensaje de error
           echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse. </b></div>';
        }
		 
      }//linea 73
	  
   }//linea 63
   
}//linea 58
	
	/*if ($status=='2') //verificar si la cuenta esta activa o inactiva
		{
		$data=array("error" => '2');
		die(json_encode($data));
		} 
	 
	if(empty($dataUsuario))
		{
		$data=array("error" => '1');
		die(json_encode($data));
		}
		
	if(!empty($_SESSION['nombre']))
		{
		  mysql_close();
		  $data=array("exito" => '1');
		  die(json_encode($data));
		}*/
?>