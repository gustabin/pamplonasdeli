<?php 
date_default_timezone_set('America/Caracas');
$numPedido = $_GET['numPedido'];
session_start();
if (empty($_SESSION['nombre'])) 
{ 
	header("Location: registrar.php");   							
}		
include "header.php";
error_reporting(0);
require_once('tools/mypathdb.php');
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
</style>


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
                </tr><thead>                                                    
														<tr>	
                                                        	<th class="product-thumbnail">&nbsp;
																Pedido # &nbsp; <?php echo $numPedido ?>
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

$consulta_mysql=("SELECT * FROM tbl_pedidos WHERE numPedido='".$numPedido."'");
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
															  <a href="descripcion.php?codProducto=<?php echo $codigoProducto ?>" style="color:#000"><?php echo $producto?></a>
															</td>
															<td class="product-price">
																<span class="amount" style="color:#000"><?php echo number_format($precio, 2, ",", "."); ?>&nbsp;Bs</span>
															</td>
                                                            <td class="product-price">
																<span class="amount" style="color:#000"><?php echo $cantidad?></span>
															</td>
															
															<td class="product-subtotal">
																<span class="amount" style="color:#000"><?php echo number_format($total, 2, ",", "."); ?>&nbsp;Bs</span>
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
															<strong><span class="amount" style="text-align:right"><?php echo number_format($subTotal, 2, ",", "."); ?>&nbsp;Bs</span></strong>
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
															<strong><span class="amount" style="text-align:right"><?php echo number_format($iva, 2, ",", "."); ?>&nbsp;Bs</span></strong>
														</td>
													</tr>
													<tr class="total">
														<th>
															<strong>Gran Total</strong>
														</th>
														<td>
                                                        <?php $granTotal= $subTotal + $iva ?>
															<strong><span class="amount" style="text-align:right"><?php echo number_format($granTotal, 2, ",", "."); ?>&nbsp;Bs</span></strong>
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
		
		
				
                   

		
 <!-- .................................... $footer .................................... -->
  <?php include "footer.php"; ?>