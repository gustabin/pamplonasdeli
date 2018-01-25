<?php 
date_default_timezone_set('America/Caracas');
session_start();
if (empty($_SESSION['nombre'])) 
{ 
	header("Location: registrar.php");   							
}		
if ($_SESSION['cantidadDeProductos']<1)
{
	header("Location: index.php");
}
//include "header.php";
include "headerOtro.php";
error_reporting(0);
require_once('tools/mypathdb.php');
require_once ('lib/mercadopago.php');
?>

<style type="text/css">
<!--
.main .page-top .container .row .col-md-12 h2 {
	color: #000;
}
#destacado {
	color: #000;
}
-->


/* base semi-transparente */
    .overlay{
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #000;
        z-index:1001;
opacity:.75;
        -moz-opacity: 0.75;
        filter: alpha(opacity=75);
    }
    </style> 

<?php 
$ocultar = $_GET ['ocultar'];
 if ($ocultar==1) {
?>
 	<style type="text/css">
	 /* estilo para la ventana modal */
    .modal {
        display: none;
        
    }
    </style>  
<?php  
    }
?>

<script Language="JavaScript">
    $("body").on('submit', '#formDireccion', function(event) {
	event.preventDefault()
	if ($('#formDireccion').valid()) {
	    $.ajax({
		type: "POST",
		url: "direccion.php",
		dataType: "json",
		data: $(this).serialize(),
		success: function(respuesta) {
					
			if (respuesta.exito == 1) {
			  setTimeout(function() {
			  $('#mensaje').hide();
			  window.location.href='pagar.php'; 
			}, 3000);
		    }			
		}
	    });
	}
	});	    

    $("body").on('submit', '#formCambiarDireccion', function(event) {
	event.preventDefault()
	if ($('#formCambiarDireccion').valid()) {
		$('#barra').show();
	    $.ajax({
		type: "POST",
		url: "direccionCambiar.php",
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
					
			if (respuesta.exito == 1) {
			  $('#mensaje').show();
			  setTimeout(function() {
			  $('#mensaje').hide();
			  window.location.href='pagar.php?ocultar=1'; 
			}, 3000);
		    }			
		}
	    });
	}
	});	    
</script>
<div role="main" class="main shop">

				<div class="container">

					<hr class="tall">

					<div class="row">
						<div class="col-md-12">




<div class="row featured-boxes">
								<div class="col-md-12">                                
									<div class="featured-box featured-box-secundary featured-box-cart">
										<div class="box-content">
                                        
												<table cellspacing="0" class="shop_table cart">                                                
													<tr>                    
                									</tr>
                                                    <thead>   
                                                    	<tr>	
                                                        	<th>&nbsp;
																Nombre
															</th>														
															<th>
																Dirección Fiscal 
															</th>
															<?php if (!empty($_SESSION['direccionEnvio'])) { ?>
                                                            <th>
																Dirección de Envio
															</th>
                                                            <?php } ?>
															<th>
																Cédula ó Rif
															</th>
															<th>
																Teléfono
															</th>
														</tr>
													</thead>
													<tbody>
														<tr class="cart_table_item">														   
															<td>
															   <span class="amount"><?php echo $_SESSION['nombre']?>  &nbsp; <?php echo $_SESSION['apellido']?></span>
															</td>
															<td>
															  <span class="amount"><?php echo $_SESSION['direccion']?></span>
															</td>
                                                            <?php
                                                            if (!empty($_SESSION['direccionEnvio'])) { ?>
															<td>
															  <span class="amount"><?php echo $_SESSION['direccionEnvio']?></span>
															</td>
                                                            <?php } ?>
                                                            <td>
																<span class="amount"><?php echo $_SESSION['cedulaRif']?></span>
															</td>															
															<td>
																<span class="amount"><?php echo $_SESSION['telefono']?></span>
															</td>
														</tr>
													</tbody>                                                   
												</table>
											
										</div>
									</div>
								</div>
							</div>

<?php if (empty($_SESSION['direccionCambiar'])) { ?>
						
								                    
									
										
                                            
                                              <div id="light" class="modal featured-box featured-box-secundary featured-box-cart">
                                                <p><h3>ATENCION</h3>               
                                                <form class="form-vertical" id="formDireccion">
                                                  <div class="control-group">                
                                                    <input name="direccion" type="checkbox" value="" checked />   La dirección de envio es la misma de la de facturación?    &nbsp;
                                                    <button class="btn btn-danger" type="submit">Cambiar</button>
                                                  </div>                        
                                                </form>
                                                <p></p>
                                                <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">cerrar</a>                                                
                                                </p>
                                              </div>
                                            
										
									
								
							

<?php } else { ?>
<div class="row featured-boxes">
								<div class="col-md-12">                                
									<div class="featured-box featured-box-secundary featured-box-cart">
										<div class="box-content">
                                        <form class="form-vertical" id="formCambiarDireccion">
                                          <div class="control-group">
                                            Dirección de envio: &nbsp;<input name="Direccion" type="text" class="required" id="Direccion" style="width:75%" placeholder="Dirección" data-msg-required="Por favor ingresa tu dirección.">                          
                                          </div>	
                                          <div class="control-group">         
                                            <button class="btn btn-danger" type="submit">Enviar</button>
                                            <a href="sincambio.php">No cambiar</a>
                                          </div>          
                                          </form>
                                            <div class="alert alert-success mensaje_form" style="display: none" id="mensaje">
                                                <button data-dismiss="alert" class="close" type="button">x</button>
                                                <strong></strong> <span class="textmensaje">Dirección actualizada!...</span>
                                             </div>
                                             
                                             <div class="alert alert-danger mensaje_form" style="display: none" id="error1">
                                                <button data-dismiss="alert" class="close" type="button">x</button>
                                                <strong></strong> <span class="textmensaje">Debe colocar su direccion completa</span>
                                             </div>				 
             <div style="float:center; display:none" id="barra"><img src="img/barra3.gif" alt="Revisando la información..."/><br>Actualizando....</div>	
										</div>
									</div>
								</div>
							</div>

<?php }  ?>



							<div class="row featured-boxes">
								<div class="col-md-12">                                
									<div class="featured-box featured-box-secundary featured-box-cart">
										<div class="box-content">
                                        
												<table cellspacing="0" class="shop_table cart">                                                
													<tr>                    
                </tr><thead>                                                    
														<tr>	
                                                        	<th class="product-thumbnail">&nbsp;
																
															</th>														
															<th class="product-name">
																Producto
															</th>
															<th class="product-price">
																Precio
															</th>
															<th class="product-quantity">
																Cantidad
															</th>
															<th class="product-subtotal">
																Total
															</th>
														</tr>
													</thead>
													<tbody>
<?php
$email = $_SESSION['email'];
$consulta_mysql=("SELECT * FROM tbl_temporal WHERE email='".$email."'");
$resultado_consulta_mysql=mysql_query($consulta_mysql,$dbConn);
while($fila=mysql_fetch_array($resultado_consulta_mysql))
	{
	$codigoProducto= $fila["codigoProducto"];
	$cantidad= $fila["cantidad"];
	
	$query = mysql_query("SELECT * FROM tbl_productos WHERE codigo = '$codigoProducto'"); 
	$dataProducto = mysql_fetch_array($query);	
	$foto = $dataProducto['foto'];  // foto del empaque
	$producto = $dataProducto['producto']; 
	$precio = $dataProducto['precio']; 
	$total =  $cantidad * $precio;
	$subTotal = $subTotal + $total;
	//$titulo = $titulo ." ". $producto;
	?>
	
														<tr class="cart_table_item">														   
															<td class="product-thumbnail">
															  <a href="descripcion.php?codProducto=<?php echo $codigoProducto ?>">
																	<img width="100" height="100" alt="" class="img-responsive" src="img/products/<?php echo $foto?>">
																</a>
															</td>
															<td class="product-name">
															  <a href="descripcion.php?codProducto=<?php echo $codigoProducto ?>"><?php echo $producto?></a>
															</td>
															<td class="product-price">
																<span class="amount"><?php echo number_format($precio, 2, ",", "."); ?> Bs</span>
															</td>
                                                            <td class="product-price">
																<span class="amount"><?php echo $cantidad?></span>
															</td>
															
															<td class="product-subtotal">
																<span class="amount"><?php echo number_format($total, 2, ",", "."); ?> Bs</span>
															</td>
														</tr>
                                                       
														 <?php
														}
														?>
													</tbody>                                                   
												</table>
											
										</div>
									</div>
								</div>
							</div>

							
							<div class="row featured-boxes">
								<div class="col-md-12">      

                                    <div class="featured-box featured-box-secundary featured-box-cart">
										<div class="box-content">
											<h4 align="right" style="color:#000">Total </h4>
											<table cellspacing="0" class="cart-totals">
												<tbody>
													<tr class="total">
														<th>
															<strong>Subtotal</strong>
														</th>
														<td>
															<strong><span class="amount" style="text-align:right"><?php echo number_format($subTotal, 2, ",", "."); ?> &nbsp;Bs</span></strong>
														</td>
													</tr>
													<tr class="total">
														<th>
															Envio
														</th>
														<td>
															<strong><span class="amount" style="text-align:right">Gratis</span></strong>
														</td>
													</tr>
                                                    <tr class="total">
														<th>
															<strong>IVA (12%)</strong>
														</th>
														<td>
                                                        <?php $iva=$subTotal*0.12 ?>
															<strong><span class="amount" style="text-align:right"><?php echo number_format($iva, 2, ",", "."); ?> &nbsp;Bs</span></strong>
														</td>
													</tr>
													<tr class="total">
														<th>
															<strong>Gran Total</strong>
														</th>
														<td>
                                                        <?php $granTotal= $subTotal + $iva ?>
															<strong><span class="amount" style="text-align:right"><?php echo number_format($granTotal, 2, ",", "."); ?> &nbsp;Bs</span></strong>
														</td>
													</tr>
                                                    <tr>
                                                        <td class="actions" colspan="6">
                                                            <div class="actions-continue">
                                                            
                                                            
                                                            
<?php                                                           
$monto = floatval ($granTotal);
$descripcion = "Pamplonas Deli " . $_SESSION['nombre'] ." ". $_SESSION['apellido'] ." ". date("d-m-Y H:i"); //esta linea no funciona
$titulo = $_SESSION['nombre'] ." ". $_SESSION['apellido'] ." ". date("d-m-Y H:i");
$descripcion = "Suscripcion PDF " . $_SESSION['nombre'] ." ". $_SESSION['apellido'];
//$mp = new MP('384765699688552', 'SWCUvzyYSxjorBkDXb99wy6PXdfQ8DKf'); //credenciales arias3000
$mp = new MP('7103852035418908', 'ovFcpqmuEKUQ1uIO5BCm0jx7nNR2prla'); //credenciales pamplonasdeli
	
$mp->sandbox_mode(TRUE);
//$mp->sandbox_mode(FALSE);
$preference_data = array(
    "items" => array(
       array(
           "title" => $titulo,
           "quantity" => 1,
           "currency_id" => "VEF",
		   "description" => $descripcion,
           "unit_price" => $monto
       )
    )
);
$preference = $mp->create_preference ($preference_data);                                                            
?>               
<script type="text/javascript" src="http://mp-tools.mlstatic.com/buttons/render.js"></script>
<script type="text/javascript">
function execute_my_onreturn (json) {
  if (json.collection_status=='approved'){
    alert ('Pago acreditado');
	window.location.href='pagar_Procesar.php';
  } else if(json.collection_status=='pending'){
    alert ('El usuario no completó el pago');
  } else if(json.collection_status=='in_process'){    
    alert ('El pago está siendo revisado');    
  } else if(json.collection_status=='rejected'){
    alert ('El pago fué rechazado, el usuario puede intentar nuevamente el pago');
  } else if(json.collection_status==null){
    alert ('El usuario no completó el proceso de pago, no se ha generado ningún pago');
  }
}
</script>                                
    
                                                            
                                                            
                                                             <a href="<?php echo $preference['response']['init_point']; ?><?php //echo $preference['response']['sandbox_init_point']; ?>" name="MP-Checkout" class="lightblue-M-Ov-VeAll" mp-mode="modal" onreturn="execute_my_onreturn">Pagar</a>
                                                                
                                                            </div>
                                                        </td>
                                                    </tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
            



<script type="text/javascript">
    (function(){function $MPBR_load(){window.$MPBR_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;
    s.src = ("https:"==document.location.protocol?"https://www.mercadopago.com/org-img/jsapi/mptools/buttons/":"http://mp-tools.mlstatic.com/buttons/")+"render.js";
    var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPBR_loaded = true;})();}
    window.$MPBR_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPBR_load) : window.addEventListener('load', $MPBR_load, false)) : null;})();
</script>    
                  
                                				
				  </div>
                        <p></p>
                        <p></p>
				</div>
  </div>
</div>
		
  <?php 			
			//include "otrofootercorto.php"; 
			include "footer.php"; 
			?>
