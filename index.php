<?php 
session_start();
error_reporting(0);
include "header.php"; 
require_once('tools/mypathdb.php'); 
$idCategoria = $_GET['categoria'];
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
                                    $producto = $fila['producto']; 
                                    $codigo = $fila['codigo']; 
                                    ?>
                                    <li><a href="descripcion.php?codProducto=<?php echo $codigo ?>"> <?php echo $producto ?></a></li>                 
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
                <ul class="products product-thumb-info-list" data-plugin-masonry data-plugin-options='{"layoutMode": "fitRows"}'>
                <?php
				//********** Buscar los productos en la tabla PRODUCTOS *********************************************
				if (empty($idCategoria)) {
					$mysql = ("SELECT * FROM tbl_productos"); //todas
					} else {
					$mysql = ("SELECT * FROM tbl_productos WHERE categoria='$idCategoria'"); //todas	
					}
					$consulta_mysql=mysql_query($mysql,$dbConn);
					while($fila=mysql_fetch_array($consulta_mysql))
					{
						$foto = $fila['fotoAdicional1'];  // foto del empaque
						$producto = $fila['producto']; 
						$pesoAprox = $fila['pesoAprox']; 
						$codigo = $fila['codigo']; 
						$cantidad = $fila['cantidad']; 
						$precio = $fila['precio']; 
						$precioAnteriorRelacionado =  $precio*1.05;
				//****************************************************************************************************************
				?>    
                <li class="col-md-4 col-sm-6 col-xs-12 product">
                    <span class="product-thumb-info">
                        <?PHP
                              if ($cantidad==0) {
                                    ?>
                                    <a href="#" class="add-to-cart-product"><span class="info" style="color:#F00">Agotado</span></a>
                                    <?PHP
                                    } else {
                                    ?>
                                    <a href="compraDirecta.php?codProducto=<?php echo $codigo ?>" class="add-to-cart-product"><span class="info" style="color:#F00">
                                    <i class="fa fa-shopping-cart">Agregar al carrito</i></span></a>
                        <?PHP					 
                               } 
                        ?>
                         
                        <a href="shop-product-sidebar.html">
                            <span class="product-thumb-info-image">
                                <a href="descripcion.php?codProducto=<?php echo $codigo ?>"><img alt="" class="img-responsive" src="img/products/<?php echo $foto ?>" /> </a>
                            </span>
                        </a>
                        <span class="product-thumb-info-content">
                            <a href="shop-product-sidebar.html">
                                <h4><a href="descripcion.php?codProducto=<?php echo $codigo ?>"><?php echo $producto ?></a></h4>
                                <span class="product-name" style="color:#fff">Gramaje: <?php echo $pesoAprox ?> | Disponible: <?php echo $cantidad ?></span>
                                <span class="price">
                                    <!--del><span class="amount"><?php //echo number_format($precioAnteriorRelacionado, 2, ",", "."); ?> Bs</span></del!-->
                                    <?php // calculo de precio + iva
                                    $precio = $precio * 0.12 + $precio;
                                    ?>
                                    <ins><span class="amount" style="font-size:12px; color: #FFF;">Total a pagar: <?php echo number_format($precio, 2, ",", "."); ?> Bs</span></ins>
                                </span>
                            </a>
                        </span>
                    </span>
                </li>
				<?php
                  }	                    
                mysql_close(); //desconectar();							
                ?>  
            </ul><img src="img/lineaRoja.png" class="img-responsive">
            
        </div> 
    </div>
                        
        <!-- .................................... $footer .................................... -->
			<?php 
			include "footer.php"; 
			?>        