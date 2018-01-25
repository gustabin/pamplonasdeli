<?php 
session_start();
if (($_SESSION['$usuario']<=2) OR (empty($_SESSION['$usuario']))) { //===============================Redirigir a otra pagina========================================		
	header("Location: index.php");
}
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
    $("body").on('submit', '#formProducto', function(event) {
		event.preventDefault()
		if ($('#formProducto').valid()) {
			$.ajax({
				type: "POST",
				url: "productosModificarProcesar.php",
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
 
<style type="text/css">
		input[type="number"] {
   width:50px;
}
</style>
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
      <a href="productoPDF.php?id=<?php echo $id?>"><img src="img/pdf.jpg" alt="imprimir PDF" width="45" height="45" /></a></h2>
      </div>
  

 <!-- .................................... $Contenido .................................... -->
  <section class="section-content section-contact section-color-graylighter">
    <div class="container">
      <div class="row">
        <div id="contenido">  
       <div class="span12">
	
    
<?php
		//$id=$_SESSION['id'];
    // ========================= Buscar el producto en tbl_productos ==========================================================
	$query="SELECT * FROM tbl_productos WHERE id = $id";  

	$resultado=mysql_query($query,$dbConn);
	while($data_prod=mysql_fetch_array($resultado))
	{
		$foto = $data_prod['foto'];
		$producto = $data_prod['producto'];
		$revisiones = $data_prod['revisiones'];
		$unidadesPaquete = $data_prod['unidadesPaquete'];
		$pesoAprox = $data_prod['pesoAprox'];
		$valoracion = $data_prod['valoracion'];
		$precio = $data_prod['precio'];
		$fotoAdicional1 = $data_prod['fotoAdicional1'];
		$fotoAdicional2 = $data_prod['fotoAdicional2'];
		$fotoAdicional3 = $data_prod['fotoAdicional3'];
		$fotoAdicional4 = $data_prod['fotoAdicional4'];
		$fotoAdicional5 = $data_prod['fotoAdicional5'];
		$relacionado1 = $data_prod['relacionado1'];
		$relacionado2 = $data_prod['relacionado2'];
		$relacionado3 = $data_prod['relacionado3'];
		$relacionado4 = $data_prod['relacionado4'];
		$descripcion = $data_prod['descripcion'];
		$ingredientes = $data_prod['ingredientes'];
		$cantidad = $data_prod['cantidad'];
		$categoria = $data_prod['categoria'];
		$codigo = $data_prod['codigo'];
	}
?>

  	<form class="form-vertical" id="formProducto" action="">
    <h5>Datos del producto</h5>
		<div class="control-group-inline">	 
        	<input name="prod_id" type="hidden" value="<?php echo $id ?>" /> 		
		  Producto <input name="producto" type="text" class="span4 required" id="producto"  maxlength="30" placeholder="producto" style="width: 29%;" value="<?php echo $producto ?>">          
        </div>
        <div class="control-group-inline">
          Código <input name="codigo" type="text" class="span4 required" id="codigo"  maxlength="10" placeholder="codigo" style="width: 6%;" value="<?php echo $codigo ?>">
          revisiones  <input name="revisiones" type="text" class="span4" id="revisiones"  maxlength="2" placeholder="revisiones" style="width: 2%;" value="<?php echo $revisiones ?>">
          Unidades x Paquete  <input name="unidadesPaquete" type="text" class="span4" id="unidadesPaquete" maxlength="6" value="<?php echo $unidadesPaquete ?>" placeholder="unidadesPaquete" style="width: 6%;">   
          Peso Aproximado  <input name="pesoAprox" type="text" class="span4" id="pesoAprox" maxlength="6" value="<?php echo $pesoAprox ?>" placeholder="peso" style="width: 6%;">       
          Valoración <input name="valoracion" type="text" class="span4" id="valoracion" value="<?php echo $valoracion ?>" style="width: 2%;" placeholder="valoracion">
			Precio <input name="precio" type="text" class="span4 required" id="precio"  maxlength="10" placeholder="precio" style="width: 6%;" value="<?php echo $precio ?>">
		</div>       
        <div class="control-group-inline">
          Foto del empaque
            <input name="foto" type="text" class="span4 required" id="foto"  maxlength="40" placeholder="foto" style="width: 30%;" value="<?php echo $foto ?>">
           <a href='fotomodificar.php?id=<?php echo $id ?>&foto=foto&idProd=<?php echo $codigo ?>'>		
                    <i class="fa fa-pencil-square-o fa-2x" style="cursor: pointer;"></i>
      		</a>
          Foto de la Portada 
          <input name="fotoAdicional1" type="text" class="span4" id="fotoAdicional1"  maxlength="40" placeholder="fotoAdicional1" style="width: 30%;" value="<?php echo $fotoAdicional1 ?>">
           <a href='fotomodificar.php?id=<?php echo $id ?>&foto=foto1&idProd=<?php echo $codigo ?>'>			
                    <i class="fa fa-pencil-square-o fa-2x" style="cursor: pointer;"></i>
      		</a>
        </div>
        <div class="control-group-inline">
         Foto Adicional #1 
           <input name="fotoAdicional2" type="text" class="span4" id="fotoAdicional2"  maxlength="40" placeholder="fotoAdicional2" style="width: 30%;" value="<?php echo $fotoAdicional2 ?>">
          <a href='fotomodificar.php?id=<?php echo $id ?>&foto=foto2&idProd=<?php echo $codigo ?>'>      				
                    <i class="fa fa-pencil-square-o fa-2x" style="cursor: pointer;"></i>
      		</a>
          Foto Adicional #2 
          <input name="fotoAdicional3" type="text" class="span4" id="fotoAdicional3"  maxlength="40" placeholder="fotoAdicional3" style="width: 30%;" value="<?php echo $fotoAdicional3 ?>">  
           <a href='fotomodificar.php?id=<?php echo $id ?>&foto=foto3&idProd=<?php echo $codigo ?>'>   				
                    <i class="fa fa-pencil-square-o fa-2x" style="cursor: pointer;"></i>
      		</a>                 
	  	</div>	
        <div class="control-group-inline"> 
          Foto Adicional #3 
            <input name="fotoAdicional4" type="text" class="span4" id="fotoAdicional4"  maxlength="40" placeholder="fotoAdicional4" style="width: 30%;" value="<?php echo $fotoAdicional4 ?>">  
           <a href='fotomodificar.php?id=<?php echo $id ?>&foto=foto4&idProd=<?php echo $codigo ?>'>			
                    <i class="fa fa-pencil-square-o fa-2x" style="cursor: pointer;"></i>
      		</a>     
          Foto Adicional #4 
          <input name="fotoAdicional5" type="text" class="span4" id="fotoAdicional5"  maxlength="40" placeholder="fotoAdicional5" style="width: 30%;" value="<?php echo $fotoAdicional5 ?>">
           <a href='fotomodificar.php?id=<?php echo $id ?>&foto=foto5&idProd=<?php echo $codigo ?>'>		
                    <i class="fa fa-pencil-square-o fa-2x" style="cursor: pointer;"></i>
      		</a>
	  	</div>
        <div class="control-group-inline"> 
          Producto Relacionado #1   
          <SELECT NAME="relacionado1">
<?php  //combobox
$query="SELECT * FROM tbl_productos";  
$resultado=mysql_query($query,$dbConn);
while($data_prod=mysql_fetch_array($resultado))
{
	if ($data_prod['id']==$relacionado1) {
	echo'<OPTION VALUE="'.$data_prod['id'].'"selected="selected">'.$data_prod['producto'].'</OPTION>';
	}else {
	echo'<OPTION VALUE="'.$data_prod['id'].'">'.$data_prod['producto'].'</OPTION>';
	}
}
 
?>
</SELECT>   
          Producto Relacionado #2
          <SELECT NAME="relacionado2">
<?php  //combobox
$query="SELECT * FROM tbl_productos";  
$resultado=mysql_query($query,$dbConn);
while($data_prod=mysql_fetch_array($resultado))
{
	if ($data_prod['id']==$relacionado2) {
	echo'<OPTION VALUE="'.$data_prod['id'].'"selected="selected">'.$data_prod['producto'].'</OPTION>';
	}else {
	echo'<OPTION VALUE="'.$data_prod['id'].'">'.$data_prod['producto'].'</OPTION>';
	}
}
 
?>
</SELECT> 
	  	</div>
         <div class="control-group-inline"> 
          Producto Relacionado #3   
          <SELECT NAME="relacionado3">
<?php  //combobox
$query="SELECT * FROM tbl_productos";  
$resultado=mysql_query($query,$dbConn);
while($data_prod=mysql_fetch_array($resultado))
{
	if ($data_prod['id']==$relacionado3) {
	echo'<OPTION VALUE="'.$data_prod['id'].'"selected="selected">'.$data_prod['producto'].'</OPTION>';
	}else {
	echo'<OPTION VALUE="'.$data_prod['id'].'">'.$data_prod['producto'].'</OPTION>';
	}
}
 
?>
</SELECT>   
          Producto Relacionado #4
          <SELECT NAME="relacionado4">
<?php  //combobox
$query="SELECT * FROM tbl_productos";  
$resultado=mysql_query($query,$dbConn);
while($data_prod=mysql_fetch_array($resultado))
{
	if ($data_prod['id']==$relacionado4) {
	echo'<OPTION VALUE="'.$data_prod['id'].'"selected="selected">'.$data_prod['producto'].'</OPTION>';
	}else {
	echo'<OPTION VALUE="'.$data_prod['id'].'">'.$data_prod['producto'].'</OPTION>';
	}
}
 
?>
</SELECT> 
	  	</div>
        <div class="control-group-inline">
	  		Descripción &nbsp; <textarea name="descripcion" type="text" class="span4 required" id="descripcion"  maxlength="500" placeholder="descripcion" style="width: 90%;"  cols="" rows=""><?php echo ($descripcion) ?></textarea>
		</div>		
        <div class="control-group-inline">
	  		Ingredientes <textarea name="ingredientes" type="text" class="span4" id="ingredientes"  maxlength="500" placeholder="ingredientes" style="width: 90%;"  cols="" rows=""><?php echo ($ingredientes) ?></textarea>
		</div>	

        <div class="control-group-inline">
        	Cantidad en existencia
            <INPUT TYPE="NUMBER" MIN="0" MAX="500" STEP="1" VALUE="<?php echo $cantidad ?>" name="cantidad" id="cantidad">
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
            <a href="productos.php"><i class="fa fa-angle-left"></i> &nbsp; Volver atras</a>
		</div>
  </form> <!--cierre del formulario !-->

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