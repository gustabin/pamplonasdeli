<?php 
session_start();
require_once('tools/mypathdb.php');
error_reporting(0);
include "headerOtro.php"; //se usa otro header por conflicto con    ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js

?>

  <script language="JavaScript" type="text/JavaScript">
    $("body").on('submit', '#formProducto', function(event) {
		event.preventDefault()
		if ($('#formProducto').valid()) {
			$.ajax({
				type: "POST",
				url: "productoNuevoProcesar.php",
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
					if (respuesta.exito == 1) {
						$('#exito1').show();
						setTimeout(function() {
						$('#exito1').hide();
						window.location.href='productos.php'; 
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
        <li><a href="#"><span id="titulo"></span></a></li>
      </ul>
    </div>
  </section>
  <!-- .................................... $Titulo .................................... -->
  
    <div class="container" style="margin-top:10px">
      <h2 class="section-title">
        Detalle del 
        <small>Producto</small>
      </h2>
      </div>
  

 <!-- .................................... $Contenido .................................... -->
  <section class="section-content section-contact section-color-graylighter">
    <div class="container">
      <div class="row">
        <div id="contenido">  
       <div class="span12">

  	<form class="form-vertical" id="formProducto" action="">
    <h5>Datos del producto</h5>
		<div class="control-group-inline">	 
		  Producto <input name="producto" type="text" class="span4 required" id="producto"  maxlength="30" placeholder="producto" style="width: 29%;" value="">        </div>
        <div class="control-group-inline">
          Código <input name="codigo" type="text" class="span4 required" id="codigo"  maxlength="10" placeholder="codigo" style="width: 6%;" value="">
          revisiones  <input name="revisiones" type="text" class="span4" id="revisiones"  maxlength="2" placeholder="revisiones" style="width: 2%;" value="">
          Unidades x Paquete  <input name="unidadesPaquete" type="text" class="span4" id="unidadesPaquete" maxlength="6" value="" placeholder="unidadesPaquete" style="width: 6%;">        
          Valoración <input name="valoracion" type="text" class="span4" id="valoracion" value="" style="width: 2%;" placeholder="valoracion">
			Precio <input name="precio" type="text" class="span4 required" id="precio"  maxlength="10" placeholder="precio" style="width: 6%;" value="">
		</div>
       
        <div class="control-group-inline">
	  		Descripción &nbsp; <textarea name="descripcion" type="text" class="span4 required" id="descripcion"  maxlength="300" placeholder="descripcion" style="width: 90%;"  cols="" rows=""></textarea>
		</div>		
        <div class="control-group-inline">
	  		Ingredientes <textarea name="ingredientes" type="text" class="span4" id="ingredientes"  maxlength="300" placeholder="ingredientes" style="width: 90%;"  cols="" rows=""></textarea>
		</div>	

        <div class="control-group-inline">
        	Cantidad en existencia
            
            <INPUT TYPE="NUMBER" MIN="0" MAX="500" STEP="1" name="cantidad" id="cantidad" style="width: 5%;" >
	  		Categoria  
            
<SELECT NAME="categoria">
<?php  //combobox
$query="SELECT * FROM tbl_categorias";  
$resultado=mysql_query($query,$dbConn);
while($data_cat=mysql_fetch_array($resultado))
{
	if ($data_cat['id']==$categoria) {
	echo'<OPTION VALUE="'.$data_cat['id'].'"selected="selected">'.$data_cat['categoria'].'</OPTION>';
	}else {
	echo'<OPTION VALUE="'.$data_cat['id'].'">'.$data_cat['categoria'].'</OPTION>';
	}
}
 
?>
</SELECT>  	
        </div>   
		<div class="control-group">         
			<button class="btn btn-danger" type="submit" id="enviar"><i class="fa fa-floppy-o"></i> &nbsp; Guardar</button>
			<button class="btn btn-default" type="reset" id="cancelar"><i class="fa fa-times"></i> &nbsp; Cancelar</button>
            <a href="productos.php"><i class="fa fa-angle-left"></i> &nbsp; Volver atras</a>
        </div>
        
  </form> <!--cierre del formulario !-->

	 <!-- ================= mensajes de EXITO o de ERROR===========================================================  !-->
     <div class="alert alert-success mensaje_form" style="display: none" id="exito1">
		<button data-dismiss="alert" class="close" type="button">x</button>
		<strong>MENSAJE!</strong> <span class="textmensaje">Producto registrado exitosamente</span>          
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