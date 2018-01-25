<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<title>Pamplonas deli</title>		
		<meta name="keywords" content="carne para parrilla" />
		<meta name="description" content="chrorizos, hamburguesas, embutidos">
		<meta name="author" content="Ing Gustavo Arias">
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">
        <!-- Vendor CSS --> 

        <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css">
		<link rel="stylesheet" href="vendor/owlcarousel/owl.carousel.css" media="screen">
		<link rel="stylesheet" href="vendor/owlcarousel/owl.theme.css" media="screen">
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" media="screen">
        
        <link rel="stylesheet" href="css/theme.css">
		<link rel="stylesheet" href="css/theme-elements.css">
		<link rel="stylesheet" href="css/theme-blog.css">
		<link rel="stylesheet" href="css/theme-shop.css">
		<link rel="stylesheet" href="css/theme-animate.css">
        

  
  <link href="css2/style-t12.css" rel="stylesheet">
  
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
		body {
	background-color: #000;
}
.hover_group:hover { 
  opacity: 1;
}
#projectsvg {
  position: relative;
  width: 100%;
  padding-bottom: 13%;
  vertical-align: middle;
  margin: 0;
  overflow: hidden;
}
#projectsvg svg {
  display: inline-block;
  position: absolute;
  top: 0;
  left: 0;
}
        </style>
</head>
	<body>
		<div class="body">        		
                <div class="container-fluid">
                    <div class="row">
                           <img src="img/header.jpg" class="img-responsive" alt="Pamplonas Deli" width="2600">
                    </div>
                </div>
                
			<header id="header">
                
				<div class="container">
                
					<h1 class="logo">
						<a href="index.php">
							<img alt="Pamplonas Deli" width="278" height="83" data-sticky-width="238" data-sticky-height="71" src="img/logo.png">
						</a>
					</h1>
					
					<ul class="social-icons">
						<li class="facebook"><a href="https://www.facebook.com/PamplonasDeliVE" target="_blank" title="Facebook">Facebook</a></li>
						<li class="twitter"><a href="https://twitter.com/PamplonasDeli" target="_blank" title="Twitter">Twitter</a></li>
						<li class="instagram"><a href="https://www.instagram.com/pamplonasdeli/" target="_blank" title="Instagram">Instagram</a></li>
					</ul>
                    
			  <nav>
						<ul class="nav nav-pills nav-top">
                         	<li>
								<a href="index.php" style="color:#526671"><i class="fa fa-home"></i> Inicio</a>
							</li>
							<li>
								<a href="http://pamplonasdeli.com/nosotros/index.php"><i class="fa fa-angle-right"></i>Nosotros</a>
							</li>
							<li>
								<a href="http://pamplonasdeli.com/contactos/index.php"><i class="fa fa-angle-right"></i>Contactos</a>
							</li>
			</ul>
					</nav>
					<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
						<i class="fa fa-bars"></i>
					</button>
				</div>
				<div class="navbar-collapse nav-main-collapse collapse">
					<div class="container">
						<nav class="nav-main mega-menu">
							<ul class="nav nav-pills nav-main" id="mainMenu">								
                               
                            	<?php
								if ($_SESSION['$usuario']==3) {?>
								<li>
									<a href="categorias.php" style="color:#526671"><i class="icon-sort-by-attributes"></i> Categorias</a>
								</li>
								<li>
									<a href="productos.php" style="color:#526671"><i class="fa fa-list-alt"></i> Inventario</a>
								</li>
								<?php }?>
								<?php if (!empty($_SESSION['nombre'])) { 	?>								
								<li><a href="micuenta.php" style="color:#526671"><i class="fa fa-user"></i>&nbsp;<?php echo $_SESSION['nombre'] ." ". $_SESSION['apellido']?></a></li>
						  		<?php		}	?>
                                 <?php 
								  if (empty($_SESSION['nombre'])) { ?>
									<li><a href="login.php" style="color:#526671">Login</a></li>
								  	<?php } else {?>								  
								  	<li><a href="logout.php" style="color:#526671">Cerrar sesión</a></li>
								  <?php } ?>
								<li class="dropdown">
									<a class="dropdown-toggle" href="#" style="color:#526671">
										Servicios
									<i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu">
                                        <li><a href="servicio.php" style="color:#526671">Envios</a></li>                                        
                                    <li><a href="micuenta.php" style="color:#526671">Mi perfil</a></li>
                                        <li><a href="index.php" style="color:#526671">Inicio</a></li>
									</ul>
								</li>
								<?php if (!empty($_SESSION['cantidadDeProductos'])) {
                                            ?>
                                    <li class="dropdown mega-menu-item mega-menu-shop">
                                        <a class="dropdown-toggle mobile-redirect" href="shop-cart.php">
                                            <i class="fa fa-shopping-cart"></i> Carro (<?php echo $_SESSION['cantidadDeProductos']?>)
                                            <i class="fa fa-angle-down"></i>
                                        </a>                                    
									<ul class="dropdown-menu">
										<li>
											<div class="mega-menu-content">
												<div class="row">
													<div class="col-md-12">
														<table cellspacing="0" class="cart">
															<tbody><?php
														error_reporting(0);
														require_once('tools/mypathdb.php');
														$email = $_SESSION['email'];
														$consulta_mysql=("SELECT * FROM tbl_temporal WHERE email='".$email."'");
														$resultado_consulta_mysql=mysql_query($consulta_mysql,$dbConn);
														while($fila=mysql_fetch_array($resultado_consulta_mysql))
															{
															$codigoProducto= $fila["codigoProducto"];
															$query = mysql_query("SELECT * FROM tbl_productos WHERE codigo = '$codigoProducto'"); 
															$dataProducto = mysql_fetch_array($query);	
															$foto = $dataProducto['foto'];  // foto del empaque	 
															$producto = $dataProducto['producto']; 
															$precio = $dataProducto['precio']; 	
															?>
															<tr>
                                                                <td class="product-thumbnail">
                                                                    <a href="descripcion.php?codProducto=<?php echo $codigoProducto ?>">
                                                                        <img width="100" height="100" alt="" class="img-responsive" src="img/products/<?php echo $foto?>">
                                                                    </a>
                                                                </td>
                                                                <td class="product-name">
                                                                    <a href="descripcion.php?codProducto=<?php echo $codigoProducto ?>"><?php echo $producto?><br><span class="amount">																	<strong><?php echo $precio?></strong></span></a>
                                                                </td>
                                                                <td class="product-actions">
                                                                    <a title="Eliminar este producto" class="remove" href="eliminarItem.php?codProducto=<?php echo $codigoProducto ?>">
                                                                        <i class="fa fa-times"></i>
                                                                    </a>
                                                                </td>
                                                                    </tr>
                                                                    <tr>
                                                                     <?php
                                                                }
                                                                ?>
                                                                <td class="product-actions" colspan="6">
                                                                    <div class="actions-continue"> 
                                                                    <a href="shop-cart.php"><input type="submit" value="Ver todo" class="btn btn-lg"></a>															
                                                                    </div>
                                                                </td>
															</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</li>
                                <?php	}	?>
								
						  </ul>
						</nav>
					</div>
				</div>
			</header>