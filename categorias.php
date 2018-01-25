<?php 
session_start();
if (($_SESSION['$usuario']<=2) OR (empty($_SESSION['$usuario']))) { //===============================Redirigir a otra pagina========================================		
	header("Location: index.php");
}
require_once('tools/mypathdb.php');
error_reporting(0);

//include "headerConfirmar.php"; 
include "headerConfirmar.php"; 
?>
<script type="text/javascript" language="javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" language="javascript" src="js/si.files.js"></script>

<script Language="JavaScript">
	$(document).ready(function() {
		$('#titulo').html("Mantenimiento de categorias");
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
    $("body").on('submit', '#formCategoria', function(event) {
		event.preventDefault()
		if ($('#formCategoria').valid()) {
			$.ajax({
				type: "POST",
				url: "categoriaIncluir.php",
				dataType: "json",
				data: $(this).serialize(),
				success: function(respuesta) {
					if (respuesta.error == 1) {
						$('#error1').show();
						setTimeout(function() {
						$('#error1').hide();
						}, 2000);
					}
					if (respuesta.error == 2) {
						$('#error2').show();
						setTimeout(function() {
						$('#error2').hide();
						}, 2000);
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
      <h2 class="section-title" style="color:#FFF">
        Inclusion, Consulta, Modificación y Eliminación 
        <small>de categorias</small>
      </h2>
      </div>
  
  <!-- .................................... $Contenido .................................... -->
  <section class="section-content section-contact section-color-graylighter">
    <div class="container">
    	<div class="form-group col-md-12">
      		<form  method="post" name="formCategoria" id="formCategoria">
        		<div class="controls">
          			<input type="text" id="categoria" name="categoria" style="width: 20%;"  placeholder="Nombre de la categoria" class="span4 required"/>	
                    <input type="text" id="orden" name="orden" style="width: 5%;"  placeholder="orden" class="span4 required"/>	
        		</div>
           			
                <div class="controls">             
      				<button class="btn btn-danger" type="submit"><i class="icon-plus"></i>&nbsp; Nueva</button>
                    <a href="productos.php"><i class="fa fa-angle-left"></i> &nbsp; Volver atras</a>
            	</div>
      		</form>
              <div class="alert alert-success mensaje_form" style="display: none" id="mensaje">
				<button data-dismiss="alert" class="close" type="button">x</button>
				<strong></strong> <span class="textmensaje">Categoria registrada!...</span>
			 </div>
			 <div class="alert alert-danger mensaje_form" style="display: none" id="error1">
				<button data-dismiss="alert" class="close" type="button">x</button>
				<strong></strong> <span class="textmensaje">Coloque una categoria valida</span>
			 </div>
             <div class="alert alert-danger mensaje_form" style="display: none" id="error2">
				<button data-dismiss="alert" class="close" type="button">x</button>
				<strong></strong> <span class="textmensaje">Por favor ingrese una categoría</span>
			 </div>
              
             <div style="float:left; display:none" id="barra"><img src="img/barra3.gif" alt="Cargando..."/><br>Ingresando....</div>	
      			
  		</div>
    
            <div id="sresults" class="col-md-12">
   			<table id="sTable" class="tablesorter table table-bordered table-hover" style="border:1px solid #ECF0F1">
      			<thead>        		
                <tr>                    
                    <th width="80%" class="header" style="text-align: center">Categoría</th>	
                    <th width="10%" class="header" style="text-align: center">Orden</th>					
                    <th width="10%" class="header" style="text-align: center">Seleccionar</th>
                </tr>
            </thead>
            <tbody id="contenido"> 
<?php
		//================================================Recuperar registros tabla categorias==================================================
		if (!empty($_SESSION['categoria'])) 
		{	
			$categoria = $_SESSION['categoria'];
			$query = ("SELECT * FROM tbl_categorias WHERE categoria LIKE '%$categoria%'");
			//echo $query;
		}
		else
		{
			$query = ("SELECT * FROM tbl_categorias ORDER BY orden");
		}

		$resultado=mysql_query($query,$dbConn);
        while($data_cat=mysql_fetch_array($resultado))
      {
		$categoria = $data_cat['categoria'];
		$orden = $data_cat['orden'];
	    ?>
        		<tr>
            		<td><?php echo $categoria;?></td>
                    <td><?php echo $orden;?></td>
            		
                    <td><a href="#confirm-delete" role="button" data-toggle="modal" data-href="categoriasEliminar.php?id= <?php echo $data_cat['id'] ?>"><i class="fa fa-trash-o fa-2x" style="cursor: pointer;"></i></a></td>
                    <td><a href="categoriasModificar.php?id= <?php echo $data_cat['id'] ?>"><i class="fa fa-pencil-square-o fa-2x" style="cursor: pointer;"></i></a></td>  
                  </tr>
        <?php } // fin del bucle de instrucciones

mysql_free_result($resultado); // Liberamos los registros
?>

            </tbody>
          </table>
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