<?php 
session_start();
require_once('tools/mypathdb.php');
error_reporting(0);
include "headerOtro.php"; //se usa otro header por conflicto con    ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js
if (!empty($_GET ['id'])) 	
	{
	$id = $_GET ['id'];	//viene en el URL
	} else {
	$id = $_SESSION['id'];
	}	
?>

  <script language="JavaScript" type="text/JavaScript">
    $("body").on('submit', '#formCategoria', function(event) {
		event.preventDefault()
		if ($('#formCategoria').valid()) {
			$.ajax({
				type: "POST",
				url: "categoriaModificarProcesar.php",
				dataType: "json",
				data: $(this).serialize(),
				success: function(respuesta) {
					if (respuesta.error == 1) {
						$('#error1').show();
						setTimeout(function() {
						$('#error1').hide();
						}, 1000);
					}
					if (respuesta.error == 2) {
						$('#error2').show();
						setTimeout(function() {
						$('#error2').hide();
						}, 1000);
					}
					if (respuesta.error == 3) {
						$('#error3').show();
						setTimeout(function() {
						$('#error3').hide();
						}, 1000);
					}
					if (respuesta.exito == 1) {
						$('#exito1').show();
						setTimeout(function() {
						$('#exito1').hide();
						window.location.href='categorias.php'; 
					  }, 1000);
					}
				}
			});
		}
	});	
</script> 



<!-- .................................... $breadcrumb .................................... -->
<section class="section-breadcrumb section-color-graylighter">
    <div class="container">
      <ul class="breadcrumb">
        <li><span id="titulo"></span></li>
      </ul>
    </div>
  </section>
  <!-- .................................... $Titulo .................................... -->
  
    <div class="container" style="margin-top:10px">
      <h2 class="section-title">
        Detalle de la 
        <small>categoria</small>
      </h2>
      </div>
  

 <!-- .................................... $Contenido .................................... -->
  <section class="section-content section-contact section-color-graylighter">
    <div class="container">
      <div class="row">
        <div id="contenido">  
       <div class="span12">
	
    
<?php
    // ========================= Buscar el producto en tbl_productos ==========================================================
	$query="SELECT * FROM tbl_categorias WHERE id = $id";  

	$resultado=mysql_query($query,$dbConn);
	while($data_cat=mysql_fetch_array($resultado))
	{
		$categoria = $data_cat['categoria'];	
		$orden = $data_cat['orden'];	
	}
?>

  	<form class="form-vertical" id="formCategoria" action="">
    <h5>Datos de las categorias</h5>
		<div class="control-group-inline">	 
        	<input name="cat_id" type="hidden" value="<?php echo $id ?>" /> 		
		  Categoria <input name="categoria" type="text" class="span4 required" id="categoria"  maxlength="30" placeholder="categoria" style="width: 29%;" value="<?php echo $categoria ?>">                    	
        Orden <input name="orden" type="text" class="span4 required" id="orden"  maxlength="2" placeholder="orden" style="width: 2%;" value="<?php echo $orden ?>">  </div>   
		<div class="control-group">         
			<button class="btn btn-danger" type="submit" id="enviar"><i class="fa fa-floppy-o"></i> &nbsp; Guardar</button>
			
            <a href="categorias.php"><i class="fa fa-angle-left"></i> &nbsp; Volver atras</a>
         </div>
        
  </form> <!--cierre del formulario !-->

	 <!-- ================= mensajes de EXITO o de ERROR===========================================================  !-->
     <div class="alert alert-success mensaje_form" style="display: none" id="exito1">
		<button data-dismiss="alert" class="close" type="button">x</button>
		<strong>MENSAJE!</strong> <span class="textmensaje">Categoria actualizada</span>          
	 </div> 
     
	 <div class="alert alert-danger mensaje_form" style="display: none" id="error1">
		<button data-dismiss="alert" class="close" type="button">x</button>
		<strong>MENSAJE!</strong> <span class="textmensaje">Debe elegir una categoría existente</span>
	 </div>
     
     <div class="alert alert-danger mensaje_form" style="display: none" id="error2">
		<button data-dismiss="alert" class="close" type="button">x</button>
		<strong>MENSAJE!</strong> <span class="textmensaje">Esta categoría ya existe</span>
	 </div>
     
     <div class="alert alert-danger mensaje_form" style="display: none" id="error3">
		<button data-dismiss="alert" class="close" type="button">x</button>
		<strong>MENSAJE!</strong> <span class="textmensaje">Debe colocar un número</span>
	 </div>

     
</div><!--cierre de spam de formulario !-->
        </div>        
      </div>
    </div>
  </section>