<?php 
session_start();
require_once('tools/mypathdb.php');	
$email=$_SESSION['email'];
if (empty($_SESSION['nombre']))
	{
		header("Location: login.php");
	}
include "headerOtro.php";
?>
			<div role="main" class="main">

				<section class="page-top">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="index.php">Inicio </a></li>
									&nbsp;<li class="active">Mi cuenta</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h2>Perfil</h2>
							</div>
						</div>
					</div>
				</section>
		
				<div class="container">
					<h2 style="color:#FFF"><strong>Mi cuenta</strong> en Pamplonas Deli.</h2>
					<div class="row">
                    	<div class="tabbable" id="tabs-710934">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#panel-394130" data-toggle="tab" style="color:#000">Datos</a>
                                </li>
                                <li>
                                    <a href="#panel-188025" data-toggle="tab" style="color:#000">Pedidos</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                    <div class="tab-pane active" id="panel-394130">
                                        <p>
                                    <div class="form-group">
                                        <strong>Nombre:</strong> &nbsp; <?php echo $_SESSION['nombre']?>												  
                                    </div>
                                    <div class="form-group">
                                        <strong>Apellido:</strong> &nbsp; <?php echo $_SESSION['apellido']?>
                                    </div>
                                    <div class="form-group">
                                        <strong>Correo: </strong>&nbsp; <?php echo $_SESSION['email']?>
                                    </div>
                                    <div class="form-group">
                                        <strong>Teléfono: </strong>&nbsp; <?php echo $_SESSION['telefono']?>
                                    </div>
                                    <div class="form-group">
                                        <strong>Empresa: </strong>&nbsp; <?php echo $_SESSION['empresa']?>
                                    </div>
                                    <div class="form-group">
                                        <strong>Cédula ó Rif: </strong>&nbsp; <?php echo $_SESSION['cedulaRif']?>
                                    </div>												
                                    <div class="form-group">
                                        <strong>Dirección: </strong>&nbsp; <?php echo $_SESSION['direccion']?>													
                                    </div>  
                                        </p>
                            </div>
                            <div class="tab-pane" id="panel-188025">
                                <h3>
                                    Historico de ordenes
                                </h3>
                                <p>
                                    Fecha &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Número de pedido
                                </p>
								<?php
                                //*******************************
                                $consulta_mysql=("SELECT DISTINCT numPedido, fecha FROM tbl_pedidos WHERE email='".$email."'");
                                $resultado_consulta_mysql=mysql_query($consulta_mysql,$dbConn);
                                while($fila=mysql_fetch_array($resultado_consulta_mysql))
                                    {
                                    $numPedido= $fila["numPedido"];
                                    $fecha= $fila["fecha"]; 
                                    echo $fecha; ?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                    <a href="pedidos.php?numPedido=<?php echo $numPedido ?>"><?php	echo $numPedido; ?></a>
                                    <br><?php	
                                    }                           
                                //******************************** 
                                ?>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
<br><br>
              <!-- .................................... $footer .................................... -->
  <?php   include "footer.php"; ?>