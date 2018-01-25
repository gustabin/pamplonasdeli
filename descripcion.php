<?php 
session_start();
error_reporting(0);
include "header.php"; 
require_once('tools/mypathdb.php'); 
$idCategoria = $_GET['categoria']; 
?>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

  <link href="css2/jquery-ui.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="css2/jquery.ui.datepicker.css" rel="stylesheet" media="screen" />
  <link href="css2/jquery.ui.core.css" rel="stylesheet" media="screen" />
  <link href="css2/jquery.ui.theme.css" rel="stylesheet" media="screen" />
   

  <!-- .................................... $scripts .................................... -->
  <script type="text/javascript" language="javascript" src="js2/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="js2/jquery-ui.js"></script>
 
  <script src="js2/jquery.min.js"></script>
  <script src="js2/modernizr.min.js"></script>


  <script src="js2/bootstrap.min.js"></script>
  <script src="js2/jquery.fancybox.min.js"></script>
  <script src="js2/jquery.hoverdir.min.js"></script>
  <script src="js2/jquery.isotope.min.js"></script>
  <script src="js2/jquery.masonry.min.js"></script>
  <script src="js2/jquery.fitvids.min.js"></script>
  <script src="js2/jquery.flexslider.min.js"></script>
  <!--script src="<?php// echo INCLUDES ?>js/script.js"></script!--> 

  <script type="text/javascript" language="javascript" src="js2/jquery.validate.js"></script>
  <script type="text/javascript" language="javascript" src="js2/jquery.ui.datepicker.js"></script>
  <script type="text/JavaScript" language="javascript" src="js2/jquery.ui.core.js"></script>
  <script type="text/JavaScript" language="javascript" src="js2/jquery.ui.widget.js"></script>
  <script type="text/JavaScript" language="javascript" src="js2/datepiker_lenguaje.js"></script>
  <script type="text/JavaScript" language="javascript" src="js2/jquery.maskedinput.js"></script>	 
  
   <script type="text/javascript" src="js2/jquery.tablesorter.js"></script> 
  <script type="text/javascript" src="js2/jquery.tablesorter.pager.js"></script> 

<style type="text/css">
input[type="number"] {
   width:50px;
}
</style>  
<?PHP
//************************************************************************************************************

require_once('tools/mypathdb.php');
$codProducto = $_GET['codProducto'];

//********** Buscar el codigo del producto en la tabla PRODUCTOS *********************************************
	$query = mysql_query("SELECT * FROM tbl_productos WHERE codigo = '$codProducto'"); 
	$dataProducto = mysql_fetch_array($query);	
	
		$foto = $dataProducto['foto'];  // foto del empaque
		$producto = $dataProducto['producto']; 
		$unidadesPaquete = $dataProducto['unidadesPaquete']; 
		$pesoAprox = $dataProducto['pesoAprox']; 
		$valoracion = $dataProducto['valoracion']; 	
		$precio = $dataProducto['precio']; 
		$fotoAdicional1 = $dataProducto['fotoAdicional1']; 
		$fotoAdicional2 = $dataProducto['fotoAdicional2']; 
		$fotoAdicional3 = $dataProducto['fotoAdicional3']; 
		$fotoAdicional4 = $dataProducto['fotoAdicional4']; 
		$fotoAdicional5 = $dataProducto['fotoAdicional5']; 
		$relacionado1 = $dataProducto['relacionado1'];
		$relacionado2 = $dataProducto['relacionado2'];
		$relacionado3 = $dataProducto['relacionado3'];
		$relacionado4 = $dataProducto['relacionado4'];
		$descripcion = $dataProducto['descripcion']; 
		$ingredientes = $dataProducto['ingredientes']; 
		$cantidad = $dataProducto['cantidad']; 
		$categoria = $dataProducto['categoria']; 
		$codigo = $dataProducto['codigo']; 
		
		switch ($valoracion) {
	case 0:
        $imagenPuntuacion="img/punto0.jpg";
        break;
    case 1:
        $imagenPuntuacion="img/punto1.jpg";
        break;
    case 2:
        $imagenPuntuacion="img/punto2.jpg";
        break;
    case 3:
        $imagenPuntuacion="img/punto3.jpg";
        break;
	case 4:
        $imagenPuntuacion="img/punto4.jpg";
        break;
	case 5:
        $imagenPuntuacion="img/punto5.jpg";
        break;
}
		$query = mysql_query("SELECT * FROM tbl_categorias WHERE id = '$categoria'");
		$dataCategoria = mysql_fetch_array($query);	
		$nombreCategoria = $dataCategoria['categoria'];
		
	if(empty($dataProducto))
		{
		$data=array("error" => '1');
		die(json_encode($data));
		}
	//mysql_close($dbConn); // Cerrar la conexion con la base de datos
	
//****************************************************************************************************************

//====================Buscar numero de revisiones================= 
	$mysqlRev=("SELECT * FROM tbl_revisiones WHERE producto='".$codProducto."'");
	$resultRev = mysql_query($mysqlRev);
	$numeroComentarios = mysql_num_rows($resultRev);	
?>
<div role="main" class="main shop"> 
    <div class="container">
        <hr class="tall">
        <div class="row">
            
            <div class="col-md-3">
            <article>
                <div class="widget-sidebar">
                    <div class="head">
                        <div class="standart-title-2 standart-title">
                        <a href="index.php?categoria="> <img alt="" class="img-responsive" src="img/productos.gif" /></a>
                        </div>
                    </div>
                    <div class="body">
                        <link rel="stylesheet" href="css/menu.css" type="text/css" media="screen">
                          <ul id="nav">
                            <?php
                                    //================================================Recuperar registros tabla categorias==================================================
                                    $query = ("SELECT * FROM tbl_categorias ORDER BY orden");
                                    $resultado=mysql_query($query,$dbConn);
                                    while($data_cat=mysql_fetch_array($resultado))
                                    {
                                        $categoria = $data_cat['categoria'];	
                                        $id = $data_cat['id'];	
                            ?>
                            <p>                
                            <li><a href="#" class="sub" tabindex="1"><i class="icon-fire"> </i> <?php echo $categoria ?></a>
                                <ul>
                                <?php
                                    //********** Buscar el codigo del producto en la tabla PRODUCTOS *********************************************
                                    $mysql = ("SELECT * FROM tbl_productos WHERE categoria='$id'"); 
                                    $consulta_mysql=mysql_query($mysql,$dbConn);
                                    while($fila=mysql_fetch_array($consulta_mysql))
                                    {
                                    $productoMenu = $fila['producto']; 
                                    $codigo = $fila['codigo']; 
                                    ?>
                                    <li><a href="descripcion.php?codProducto=<?php echo $codigo ?>"> <?php echo $productoMenu ?></a></li>                 
                                    <?php
                                    } // fin del bucle de instrucciones
                                        mysql_free_result($respuesta); // Liberamos los registros
                                    ?>                       
                                </ul>
                            </li>
                                      <?php
                                    } // fin del bucle de instrucciones
                                        mysql_free_result($resultado); // Liberamos los registros
                                    ?>
                            
                        </ul> 
                    </div>
                </div>
            </article>
		</div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">									
                    <p><img src="img/lineaSiPiensas.png" class="img-responsive"></p>
                </div>
            </div>

            <div class="row">
                
                <!-------------------DESDE AQUI-------------!-->
				<div class="container">					
					<div class="row">
						<div class="col-md-3">
							<div class="owl-carousel" data-plugin-options='{"items": 1, "autoHeight": true}'>
								<div>
									<div class="thumbnail">
										<img alt="" class="img-responsive img-rounded" src="img/products/<?php echo $fotoAdicional5 ?>">
									</div>
								</div>
								<div>
									<div class="thumbnail">
										<img alt="" class="img-responsive img-rounded" src="img/products/<?php echo $fotoAdicional2 ?>">
									</div>
								</div>
                                <div>
									<div class="thumbnail">										
                                        <img alt="" class="img-responsive img-rounded" src="img/products/<?php echo $fotoAdicional3 ?>">
									</div>
								</div>
                                <div>
									<div class="thumbnail">										
                                        <img alt="" class="img-responsive img-rounded" src="img/products/<?php echo $fotoAdicional4 ?>">
									</div>
								</div>
							</div> <!--owl-carousel !-->
                            <br>
                            <div class="product_meta">
                                <span class="posted_in">Categoria: </span> <span class="posted_in" style="color:#FFF"> <?php echo $nombreCategoria ?></span>
                            </div>
                            <div class="product_meta">									
                                <a href="index.php"><button type="button" class="btn btn-danger"><i class="icon-check"></i> Seguir comprando </button></a>
                            </div>
                    	</div> <!--col-md-3 !-->

						<div class="col-md-3">
							<div class="summary entry-summary">
								<h4 class="shorter"><strong><?php echo $producto ?></strong></h4>
                                <p class="shorter">
                                    Gramaje: <?php echo $pesoAprox ?> 
								</p>
								<p class="shorter">
									<span class="amount">PMVP: <?php echo number_format($precio, 2, ",", "."); ?>&nbsp;Bs</span>                                    
								</p>
                                <?php // calculo de iva
                                    $iva = $precio * 0.12;
                                    ?>
                                <p class="shorter">
									<span class="amount">IVA: <?php echo number_format($iva, 2, ",", "."); ?>&nbsp;Bs</span>                                    
								</p>
                                 <?php // calculo de total a pagar
                                    $total = $precio + $iva;
                                    ?>
                                <p class="shorter">
									<span class="amount">Total a Pagar: <?php echo number_format($total, 2, ",", "."); ?>&nbsp;Bs</span>                                    
								</p>
								<p class="taller" style="color:#FFF"><?php echo ($descripcion) ?> </p>
								 <script language="JavaScript" type="text/JavaScript">
                                    //Metodo para cargar el formulario  
                                    $("body").on('submit', '#agregarCarrito', function(event) {
                                    event.preventDefault()
                                    if ($('#agregarCarrito').valid()) {
                                        $('#barra').show();
                                        $.ajax({
                                        type: "POST",
                                        url: "descripcion_procesar.php",
                                        dataType: "json",
                                        data: $(this).serialize(),
                                        success: function(respuesta) {
                                            $('#barra').hide();
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
                                            if (respuesta.error == 3) {
                                              $('#error3').show();
                                            setTimeout(function() {
                                              $('#error3').hide();
                                            }, 2000);
                                            }
                                            
                                            if (respuesta.exito == 1) {
                                              $('#mensaje').show();
                                              setTimeout(function() {
                                              $('#mensaje').hide();
                                              window.location.href='descripcion.php?codProducto=<?php echo $codigo ?>'; 
                                            }, 2000);
                                            }
                                        }
                                        });
                                    }
                                    });	    
                                </script>                               
                              	<form class="form-vertical" id="agregarCarrito">
                                    <div class="control-group"> 
                                          Cantidad: 
                                          <INPUT TYPE="NUMBER" MIN="1" MAX="500" STEP="1" VALUE="1" name="cantidad" id="cantidad">
                                          <input name="codigoProducto" type="hidden" value="<?php echo $codProducto ?>">
                                          <input name="cantidadInventario" type="hidden" value="<?php echo $cantidad ?>">
                                          <?PHP
                                           if ($cantidad==0) {
                                          ?>	 
                                          &nbsp; &nbsp; <button class="btn btn-danger" type="submit"  disabled="disabled">Agotado</button>
                                          <?PHP
                                          } else {
                                          ?>
                                          &nbsp; &nbsp; <button class="btn btn-danger" type="submit"><i class="icon-shopping-cart icon-large"></i>&nbsp; Agregar al carrito</button>
                                          <?PHP
                                          }
                                          ?>
                                    </div>
          						</form>
                                <br>
                                 <div class="alert alert-success mensaje_form" style="display: none" id="mensaje">
                                    <button data-dismiss="alert" class="close" type="button">x</button>
                                    <strong></strong> <span class="textmensaje">Carrito actualizado!...</span>
                                 </div>
                                 <div class="alert alert-danger mensaje_form" style="display: none" id="error1">
                                    <button data-dismiss="alert" class="close" type="button">x</button>
                                    <strong></strong> <span class="textmensaje">Cantidad incorrecta</span>
                                 </div>
                                 <div class="alert alert-danger mensaje_form" style="display: none" id="error2">
                                    <button data-dismiss="alert" class="close" type="button">x</button>
                                    <strong></strong> <span class="textmensaje">Solo se aceptan números</span>
                                 </div>
                                  <div class="alert alert-danger mensaje_form" style="display: none" id="error3">
                                    <button data-dismiss="alert" class="close" type="button">x</button>
                                    <strong></strong> <span class="textmensaje">Debe elegir una cantidad menor </span>
                                 </div>
                                 <div style="float:left; display:none" id="barra"><img src="img/barra3.gif" alt="Cargando..."/><br>Ingresando....</div>	
                            </div><!--summary entry-summary !-->
                        </div> <!--col-md-3 !-->
                    </div><!--row !-->

					<div class="row">
						<div class="col-md-6">
							<div class="tabs tabs-product">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#productDescription" data-toggle="tab" style="color:#333">Descripci&oacute;n</a></li>
                                    <li><a href="#productInfo" data-toggle="tab" style="color:#333">Informaci&oacute;n Adicional</a></li>
                                    <!--li><a href="#productReVers" data-toggle="tab">Comentarios (<?php //echo $numeroComentarios ?>)</a></li!-->
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="productDescription">
										<p><?php echo utf8_encode($descripcion) ?></p>
									</div>
                                    <div class="tab-pane" id="productInfo">
                                        <table class="table table-striped push-top">
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        Peso:
                                                    </th>
                                                    <td>
                                                        <?php echo $pesoAprox ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Cantidad
                                                    </th>
                                                    <td>
                                                        <?php echo $unidadesPaquete ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Ingredientes
                                                    </th>
                                                    <td>
                                                        <?php echo utf8_encode($ingredientes) ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div><!--tab-pane !-->									
                				</div><!--tab-content !-->
        					</div> <!--tabs tabs-product !-->
    					</div><!--col-md-6 !-->
					</div><!--row !-->


					<div class="row">
						<div class="col-md-6">
							<h2 style="color:#FFF">Productos <strong>Relacionados</strong></h2>
                            <ul class="products product-thumb-info-list">
                            <?php
                            //====================Buscar productos relacionados ================= 
                                for ($i = 1; $i <= 3; $i++) {   	
                                        switch ($i) {
                                        case 1:
                                            $query =  mysql_query("SELECT * FROM tbl_productos WHERE id ='" .$relacionado1. "'"); 
                                            break;
                                        case 2:
                                            $query =  mysql_query("SELECT * FROM tbl_productos WHERE id ='" .$relacionado2. "'"); 
                                            break;
                                        case 3:
                                            $query =  mysql_query("SELECT * FROM tbl_productos WHERE id ='" .$relacionado3. "'"); 
                                            break;
                                        //case 4:
                                            //$query =  mysql_query("SELECT * FROM tbl_productos WHERE id ='" .$relacionado4. "'"); 
                                            //break;
								}
								$dataRelacionado = mysql_fetch_array($query);
								$fotoRelacionado = $dataRelacionado['fotoAdicional1']; 
								$productoRelacionado = $dataRelacionado['producto']; 
								$precioRelacionado = $dataRelacionado['precio']; 
								$codigoRelacionado = $dataRelacionado['codigo']; 
								$precioAnteriorRelacionado =  $precioRelacionado*1.05;
								?>
                                <li class="col-sm-4 col-xs-6 product">
                                    <span class="product-thumb-info">
                                        <a href="compraDirecta.php?codProducto=<?php echo $codigoRelacionado ?>" class="add-to-cart-product">
                                            <span><i class="fa fa-shopping-cart"></i> Agregar al carrito</span>
                                        </a>
                                        <a href="descripcion.php?codProducto=<?php echo $codigoRelacionado ?>">
                                            <span class="product-thumb-info-image">
                                                <span class="product-thumb-info-act">
                                                    <span class="product-thumb-info-act-left"><em>Ver</em></span>
                                                    <span class="product-thumb-info-act-right"><em><i class="fa fa-plus"></i> Detalles</em></span>
                                                </span>
                                        		<img alt="" class="img-responsive" src="img/products/<? echo $fotoRelacionado ?>">
                                            </span>
                                        </a>
                                        <span class="product-thumb-info-content">
                                        	<a href="descripcion.php?codProducto=<?php echo $codigoRelacionado ?>">
                                                <h4><?php echo $productoRelacionado ?></h4>
                                                <span class="price">
                                                    <!--del style="color:#333"><span class="amount"><?php //echo $precioAnteriorRelacionado ?> Bs</span></del!-->
                                                    <ins style="color:#333"><span class="amount" style="font-size:14px"><?php echo $precioRelacionado ?> Bs</span></ins>
                                                </span>
											</a>
										</span>
									</span>
								</li>
								<?php
                                }
                                ?>                                    
                            </ul>                            
                         </div><!--col-md-6 !-->
					</div> <!--row !-->
			</div> <!--container !-->
                    <!-------------------HASTA AQUI-------------!-->             
            
        </div><!--role="main" !-->
        <br>
         <img src="img/lineaRoja.png" class="img-responsive">

                        
        <!-- .................................... $footer .................................... -->
			<?php 
			include "footer.php"; 
			?>        