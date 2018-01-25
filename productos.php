<?php 
session_start();
if (($_SESSION['$usuario']<=2) OR (empty($_SESSION['$usuario']))) { //===============================Redirigir a otra pagina========================================		
	header("Location: index.php");
}
require_once('tools/mypathdb.php');
error_reporting(0);
include "headerConfirmar.php"; 
?>
<script type="text/javascript" language="javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" language="javascript" src="js/si.files.js"></script>
    

<script Language="JavaScript">
	$(document).ready(function() {
		$('#titulo').html("Mantenimiento de productos");
	});
</script>



<script type='text/javascript'>                             // tablesorter
    $(document).ready(function() {
        $("#sTable").tablesorter({
            headers: {
                3: {   
                    sorter: false
                }
            }
        });
    });
</script>
<script type = "text/javascript">                            // tablesorter pagination
$(document).ready(function() {
    $('#sTable').tablesorter().tablesorterPager({container: $("#pager")}); 
}); 
</script>
<script type="text/javascript">
    $("body").on('submit', '#formProducto', function(event) {
		event.preventDefault()
		if ($('#formProducto').valid()) {
			$.ajax({
				type: "POST",
				url: "productoBuscar.php",
				dataType: "json",
				data: $(this).serialize(),
				success: function(respuesta) {
					if (respuesta.error == 1) {
						$('#error1').show();
						setTimeout(function() {
						$('#error1').hide();
						}, 2000);
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
        <li><span id="titulo"></span></li>
      </ul>
    </div>
  </section>
  <!-- .................................... $Titulo .................................... -->
  
    <div class="container" style="margin-top:10px">
      <h2 class="section-title" style="color:#FFF">
        Inclusion, Consulta, Modificación y Eliminación 
        <small>de productos</small>
      </h2>
      </div>
  
  <!-- .................................... $Contenido .................................... -->
  <section class="section-content section-contact section-color-graylighter">
    <div class="container">
    	<div class="form-group col-md-12">
      		<form  method="post" name="formProducto" id="formProducto">
        		<div class="controls">
          			<input type="text" id="nombre" name="nombre" style="width: 15%;"  placeholder="Nombre del producto" />	  
        		
           			<button id="search-btn" type="submit" name="submit" class="btn btn-danger"><i class="icon-search"></i> Buscar </button>
                
      				<!--a href='historiaParte1.php'!-->                    
                    <a href='productoNuevo.php'>
      				<button type="button" class="btn btn-danger"><i class="icon-plus"></i> Nuevo </button>
      				</a> 
                    <a href='backup.php'>
      				<button type="button" class="btn btn-danger"><i class="icon-download-alt"></i> Backup </button>
      				</a> 
                    <a href='categorias.php'>
      				<button type="button" class="btn btn-danger"><i class="icon-sitemap"></i> Categorías </button>
      				</a> 
                    <a href='logout.php'>
      				<button type="button" class="btn btn-danger"><i class="icon-share"></i> Logout </button>
      				</a> 
                    <a href='index.php'>
      				<button type="button" class="btn btn-danger"><i class="icon-home"></i> Inicio </button>
      				</a> 
                </div>
      		</form>
            	
  		</div>
    
            <div id="sresults" class="col-md-12">
   			<table id="sTable" class="tablesorter table table-bordered table-hover" style="border:1px solid #ECF0F1">
      			<thead>
                <tr>                    
                    <th width="30%" class="header" style="text-align: center">Foto</th>
					<th width="40%" class="header" style="text-align: center">Producto</th>
                    <th width="20%" class="header" style="text-align: center">Unid x Paquete</th>
                    <th width="20%" class="header" style="text-align: center">Peso Aprox</th>
                    <th width="50%" class="header" style="text-align: center">Precio</th>
                    <th width="50%" class="header" style="text-align: center">Cantidad</th>
                    <th width="10%" class="header" style="text-align: center">Seleccionar</th>
                </tr>
            </thead>
            <tbody id="contenido"> 
<?php
		//================================================Recuperar registros tabla productos==================================================
		if (!empty($_SESSION['nombreProducto'])) 
		{	
			$nombre = $_SESSION['nombreProducto'];
			$query = ("SELECT * FROM tbl_productos WHERE producto LIKE '%$nombre%'");
			//echo $query;
		}
		else
		{
			$query = ("SELECT * FROM tbl_productos");
			//echo $query;
		}

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
		$descripcion = $data_prod['descripcion'];
		$ingredientes = $data_prod['ingredientes'];
		$cantidad = $data_prod['cantidad'];
		$categoria = $data_prod['categoria'];
		$codigo = $data_prod['codigo'];
	    ?>
        		<tr>
            		<td><?php echo $foto;?></td>
            		<td>					
                    <a href="descripcion.php?codProducto=<?php echo $codigo ?>" class="thumb-info"><?php echo $producto ?></a>
					</td>
                    <td><?php echo $unidadesPaquete;?></td>
                    <td><?php echo $pesoAprox;?></td>
                    <td><?php echo $precio;?></td>
                    <td><?php echo $cantidad;?></td>
					<td><a href="#confirm-delete" role="button" data-toggle="modal" data-href="productosEliminar.php?id= <?php echo $data_prod['id'] ?>"><i class="fa fa-trash-o fa-2x" style="cursor: pointer;"></i></a></td>
                    <td><a href="productosModificar.php?id=<?php echo $data_prod['id'] ?>"><i class="fa fa-pencil-square-o fa-2x" style="cursor: pointer;"></i></a></td>         
                  </tr>
        <?php } // fin del bucle de instrucciones

mysql_free_result($resultado); // Liberamos los registros
?>

            </tbody>
          </table>
           <!-- pager -->
    <div id="pager" class="pager">
      <form>
        <input class="pagedisplay" readonly type="text">
        <button type="button" class="btn btn-danger first"><i class="icon-fast-backward"></i></button>
        <button type="button" class="btn btn-danger prev"><i class="icon-backward"></i></button>
        <button type="button" class="btn btn-danger next"><i class="icon-forward"></i></button>
        <button type="button" class="btn btn-danger last"><i class="icon-fast-forward"></i></button>

        <select class="styled-select pagesize" style="height:30px; width:auto">
          <option selected="selected" value="10">10</option>
          <option value="20">20</option>
          <option value="30">30</option>
          <option value="50">50</option>
        </select>
      </form>
    </div>
    </div>
    </div>
  </section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirmar Eliminación</h4>
                </div>
            
                <div class="modal-body">
                    <p>Estas seguro que quieres eliminar este producto? Este proceso es irreversible!</p>
                    <p>Quieres proceder?</p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger btn-ok">Eliminar</a>
                </div>
            </div>
        </div>
    </div>

    


    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
           // $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
    
    		<?php 			
			include "otrofootercorto.php"; 
			?>