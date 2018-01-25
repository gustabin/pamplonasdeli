<?php 
session_start();
if (($_SESSION['$usuario']<=2) OR (empty($_SESSION['$usuario']))) { //===============================Redirigir a otra pagina========================================		
	header("Location: index.php");
}
require_once('tools/mypathdb.php');
error_reporting(0);
include "headerOtro.php"; //se usa otro header por conflicto con    ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js
$id = trim($_GET ['id']);	//viene en el URL
$idProd = $_GET ['idProd'];	//viene en el URL
$foto = $_GET ['foto'];	//viene en el URL	
?>
 
<style type="text/css">
		input[type="number"] {
   width:50px; 
}
</style>

<script language="JavaScript" type="text/JavaScript"> //habilita el boton subir solo si se ha seleccionado un archivo
$(document).ready(
    function(){
        $('input:file').change(
            function(){
                if ($(this).val()) {
                    $('input:submit').attr('disabled',false);
                } 
            }
            );
    });
</script>
  <!-- .................................... $Titulo .................................... -->
  
    <div class="container" style="margin-top:10px">
      <h2 class="section-title">
        Inclusion y Eliminación 
        <small>de imagenes</small>
      </h2>
      </div>
  
  <!-- .................................... $Contenido .................................... -->
  <section class="section-content section-contact section-color-graylighter">
    <div class="container">
<div class="row">
        <div id="contenido">  
       		<div class="span12">
                    <form action="fotosProcesar.php?id=<?php echo $id ?>&foto=<?php echo $foto ?>&idProd=<?php echo $idProd ?>" id="formProducto" method="POST" enctype="multipart/form-data"/>
                    Añadir imagen: <input name="archivo" id="archivo" type="file">
                     <input type="submit" name="subir" value="Subir imagen"  disabled />					
                    </form>
                    <a href='productosModificar.php?id=<?php echo $id ?>'>
                    
                    <button class="btn btn-danger" type="submit"><i class="fa-reply icon-large"></i>&nbsp; Volver atras</button>
      		</a>
<div id="result"></div>
                 <!-- ================= mensajes de EXITO o de ERROR===========================================================  !-->
                 <div class="alert alert-success mensaje_form" style="display: none" id="exito1">
                    <button data-dismiss="alert" class="close" type="button">x</button>
                    <strong>MENSAJE!</strong> <span class="textmensaje">Producto actualizado</span>          
                 </div> 
                 
                 <div class="alert alert-success mensaje_form" style="display: none" id="exito2">
                    <button data-dismiss="alert" class="close" type="button">x</button>
                    <strong>MENSAJE!</strong> <span class="textmensaje">Actualización exitosa</span>          
                 </div>       	 
                  
                 <div class="alert alert-danger mensaje_form" style="display: none" id="error1">
                    <button data-dismiss="alert" class="close" type="button">x</button>
                    <strong>MENSAJE!</strong> <span class="textmensaje">Debe elegir un producto existente</span>
                 </div>
                 
                 <div class="alert alert-danger mensaje_form" style="display: none" id="error2">
                    <button data-dismiss="alert" class="close" type="button">x</button>
                    <strong>MENSAJE!</strong> <span class="textmensaje">Este producto ya existe</span>
                 </div>
			</div><!--cierre de spam de formulario !-->
        </div>        
      </div>
    </div>
  </section>

    <!-- .................................... $footer .................................... -->
  <?php //include "footer.html"; ?>