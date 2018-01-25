<?php 
session_start();
error_reporting(0);
require_once('tools/mypathdb.php');
//include "header.php";
include "headerConfirmar.php"; 
?>
<script type="text/javascript" language="javascript" src="js2/jquery.form.js"></script>
<script type="text/javascript" language="javascript" src="js2/si.files.js"></script>

<style type="text/css">


/* base semi-transparente */
    .overlay{
        display: none;        
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


 /* estilo para la ventana modal */
    .modal {
        display: none;
        
    }
    </style> 


 
   <script Language="JavaScript">
	//FUNCIÓN ERROR BOTON
    function Error() {
        $('#ErrorBoton').show();	 
	}
	
	//FUNCIÓN PARA MODIFICAR
    function Modificar(id) {
		window.location.href='descripcion.php?codProducto=' + id;
    }
	
	//FUNCIÓN PARA ELIMINAR
    function Eliminar(id) {
		window.location.href='eliminarItem.php?codProducto=' + id;		
    }
	
	
	
	function changeHandler(id){
	window.location.href='Procesar.php?id=' + id.value;
	//$('#contenido').load('citasDoctor_Mostrar.php');
	}
</script>


<script language="JavaScript" type="text/JavaScript">
    $("body").on('submit', '#formPagar', function(event) {
	event.preventDefault()
	if ($('#formPagar').valid()) {
		$('#barra').show();
	    $.ajax({
		type: "POST",
		url: "shop-cartProcesar.php",
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
			
			if (respuesta.exito == 1) {
			  $('#mensaje').show();
			  setTimeout(function() {
			  $('#mensaje').hide();
			  window.location.href='pagar.php'; 
			}, 2000);
		    }
		}
	    });
	}
	});	    
</script> 
							<br><br><br>
			<div role="main" class="main shop">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="row featured-boxes">
								<div class="col-md-12">
									<div class="featured-box featured-box-secundary featured-box-cart">
										<div class="box-content">
                                        <div class="row margin-60">
              <div id="light" class="modal">
                <p><h3> Condiciones de entrega</h3>
                <p class="lead">Revise su pedido</p>
                <p>La dirección de envio es donde entregaremos su producto,</p>
                <p style="color:#B11116">la cual debe estar en la ciudad de Maracay</p>
                <p class="lead">Reclamos</p>
                <p>Cualquier objeción sobre su orden deberá hacerla al momento de recibir su pedido, de lo contrario queda sin efecto cualquier tipo de reclamo.</p>
                <p>El tiempo de entrega de cada orden es aproximadamente entre 3 a 5 días.</p>
                <p>Su factura será enviada con el pedido. </p>
                <p></p>
                <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">cerrar</a>
                </p>
              </div>
            </div>   
				
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
                                                            <th class="product-thumbnail">
                                                                Seleccionar
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
	$id_Prod =  $dataProducto['id']; 
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
															<td class="product-price" style="color:#000">
																<span class="amount"><?php echo number_format($precio, 2, ",", "."); ?> Bs</span>
															</td>
                                                            <td class="product-price" style="color:#000">
																<span class="amount"><?php echo $cantidad?></span>
															</td>
															<td class="product-subtotal" style="color:#000">
																<span class="amount"><?php echo number_format($total, 2, ",", "."); ?> Bs</span>
															</td>                                                            
                                                            
                                                            <td><a href="#confirm-delete" role="button" data-toggle="modal" data-href="eliminarItem.php?codProducto=<?php echo $codigoProducto ?>"><i class="fa fa-trash-o fa-2x" style="cursor: pointer;"></i></a></td>                                                              
                                                                                                                        
                    										<td><a href="descripcion.php?codProducto=<?php echo $codigoProducto ?>"><i class="fa fa-pencil-square-o fa-2x" style="cursor: pointer;"></i></a></td>                                                            
														</tr>
                                                       
														 <?php
														}
														?>
														<tr>
															<td class="actions" colspan="6">
																<div class="actions-continue">

<a href="index.php"><button type="button" class="btn btn-danger"><i class="icon-check"></i> Seguir comprando </button></a>
																</div>
															</td>
														</tr>
                                                        
                                                        
                                                        
													</tbody>
												</table>
											
										</div>
									</div>
								</div>
							</div>

							<div class="row featured-boxes cart">
								<div class="col-md-6">
									
								</div>
								<div class="col-md-6">
									<div class="featured-box featured-box-secundary default">
										<div class="box-content">
											<h4 style="color:#000">Total </h4>
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
															<strong style="color:#000"><span class="amount" style="text-align:right"><?php echo number_format($granTotal, 2, ",", "."); ?> &nbsp;Bs</span></strong>
														<?php $_SESSION['granTotal'] = $granTotal; ?>
                                                        </td>
													</tr>
                                                    <tr>
															<td class="actions" colspan="6">
                                                            <form class="form-vertical" id="formPagar">
              <input name="chk_aceptar" type="checkbox" value="1" checked /> He leido y acepto las <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';"> condiciones de entrega.</a> 
          	  
               <div id="fade" class="overlay" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">
</div>
																<div class="actions-continue">
                                                                                                                                
                                                                <?PHP
																 if ($granTotal==0) {
																?>	 
                                                                &nbsp; &nbsp; <button class="btn btn-danger" type="submit"  disabled="disabled">Carro vacio</button>
																  <?PHP
                                                                  } else {
                                                                  ?>
                                                                    <input type="submit" value="Pagar" name="seguir" class="btn btn-lg btn-danger">
                                                                <?PHP
																  }
																  ?>
																</div>
															</form>
             <div class="alert alert-success mensaje_form" style="display: none" id="mensaje">
				<button data-dismiss="alert" class="close" type="button">x</button>
				<strong></strong> <span class="textmensaje">Preparando compra!...</span>
			 </div>
			 <div class="alert alert-danger mensaje_form" style="display: none" id="error1">
				<button data-dismiss="alert" class="close" type="button">x</button>
				<strong></strong> <span class="textmensaje">Debe aceptar las condiciones</span>
			 </div>
             
             
             <div style="float:left; display:none" id="barra"><img src="img/barra3.gif" alt="Cargando..."/><br>Procesando....</div>	
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
            
            //$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
    <?php 			
			include "footer.php"; 
			?>