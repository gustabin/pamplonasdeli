<?php
	session_start(); 
	require_once('tools/mypathdb.php');			
	$fecha_actual = date("Y-m-d");
	$fecha = $fecha_actual;
	$email=$_SESSION['email'];
	$nombre=$_SESSION['nombre'];
	$apellido=$_SESSION['apellido'];
	$telefono=$_SESSION['telefono'];
	$empresa=$_SESSION['empresa'];
	$cedulaRif=$_SESSION['cedulaRif'];
	$direccion=$_SESSION['direccion'];
	$direccionEnvio=$_SESSION['direccionEnvio'];

$productos= "<table cellspacing=0 class=shop_table cart>                                                
    <thead>                                                    
      <tr>	
	      <th class=product-name>
              Imagen
          </th>
          <th class=product-name>
              Producto
          </th>
          <th class=product-price>
              Precio
          </th>
          <th class=product-quantity>
              Cantidad
          </th>
          <th class=product-subtotal>
              Total
          </th>
      </tr>
  </thead>
  <tbody>";

//obtener el ultimo id  en la tabla tbl_pedidos	
	$rs = mysql_query("SELECT MAX(id) AS id FROM tbl_pedidos");
	if ($row = mysql_fetch_row($rs)) {
	$idPedido = $row[0];
	}
	
	$queryPedidos = mysql_query("SELECT * FROM tbl_pedidos WHERE id = '$idPedido'");
	$dataPedidos = mysql_fetch_array($queryPedidos);	
	$numPedido = $dataPedidos['numPedido'];
	$numPedido = $numPedido + 1;
	$numPedido = str_pad($numPedido, 4, "0", STR_PAD_LEFT);
	
$consulta_mysql=("SELECT * FROM tbl_temporal WHERE email='".$email."'");
$resultado_consulta_mysql=mysql_query($consulta_mysql,$dbConn);
while($fila=mysql_fetch_array($resultado_consulta_mysql))
	{
	$codigoProducto= $fila["codigoProducto"];
	$cantidad= $fila["cantidad"];

	// Insertar registros en la tabla pedidos tbl_pedidos
	$queryPedido = "INSERT INTO tbl_pedidos (email, codigoProducto, cantidad, fecha, numPedido) VALUES ('".$email."', '".$codigoProducto."', ".$cantidad.", '".$fecha."', '".$numPedido."');";	
	
	
	$insertarPedido = mysql_query($queryPedido); 	
	
	$query = mysql_query("SELECT * FROM tbl_productos WHERE codigo = '$codigoProducto'"); 
	$dataProducto = mysql_fetch_array($query);	
	$foto = $dataProducto['foto'];  // foto del empaque
	$producto = $dataProducto['producto']; 
	$precio = $dataProducto['precio']; 
	$cantidadInventario = $dataProducto['cantidad']; 
	$total =  $cantidad * $precio;	
	$subTotal = $subTotal + $total;
	$iva=$subTotal*0.12;
	$granTotal= $subTotal + $iva;
    $productos = $productos ."<tr class=cart_table_item>	 
        <td class=product-thumbnail>
          <a href=http://www.pamplonasdeli.com/ventasonline/descripcion.php?codProducto=". $codigoProducto ."> 
				<img width=100 height=100 class=img-responsive src=http://www.pamplonasdeli.com/ventasonline/img/products/" .$foto.">
          
        </td>
        <td class=product-name>
          <a href=http://www.pamplonasdeli.com/ventasonline/descripcion.php?codProducto=". $codigoProducto .">".$producto."</a>
        </td>
        <td class=product-price>
            <span class=amount>". $precio."</span>
        </td>
        <td style=text-align:center>
            <span class=amount >". $cantidad."</span>
        </td>
        
        <td class=product-subtotal>
            <span class=amount>". $total ."</span>
        </td>
    </tr>";
	
	//Descontar la cantidad de productos de la tabla productos (actualizar inventario)
	$cantidadActual= $cantidadInventario - $cantidad;
  $query = mysql_query("UPDATE tbl_productos SET cantidad='$cantidadActual' WHERE codigo = '$codigoProducto'"); 
      }
  $productos = $productos ."</tbody>                                                   
</table>

<table cellspacing=0 class=shop_table cart>
  <tbody>
	  <tr class=total style=text-align:right>
		  <th>
			  <strong>Subtotal &nbsp;</strong>
		  </th>
		  <td>
			  <strong><span class=amount style=text-align:right>". $subTotal ."&nbsp;Bs</span></strong>
		  </td>
	  </tr>
	  <tr class=total style=text-align:right>
		  <th>
			  Envio
		  </th>
		  <td>
			  <strong><span class=amount style=text-align:right>Gratis</span></strong>
		  </td>
	  </tr>
	  <tr class=total style=text-align:right>
		  <th>
			  <strong>IVA (12%)&nbsp;</strong>
		  </th>
		  <td>
		  
			  <strong><span class=amount style=text-align:right>". $iva ."&nbsp;Bs</span></strong>
		  </td>
	  </tr>
	  <tr class=total style=text-align:right>
		  <th>
			  <strong>Gran Total &nbsp;</strong>
		  </th>
		  <td>		  
			  <strong><span class=amount style=text-align:right>". $granTotal ."&nbsp;Bs</span></strong>
		  </td>
	  </tr>
	  </tbody>
	</table>";


		// ========================================envio de correo notificandome que un cliente pago ===================
		//$destino ="ventas@pamplonasdeli.com";
		
		$destino ="gustabin@yahoo.com";
		$asunto = "Contacto Web www.pamplonasdeli.com";
		$cabeceras = "Content-type: text/html";
		
		$cuerpo ="<h2>Hola, un cliente realizó una compra Online</h2>
		Los datos enviados son los siguientes:<br>
		<b>Email: </b>$email<br>		
		<b>Nombre: </b>$nombre $apellido<br>				
		<b>Teléfono: </b>$telefono<br>				
		<b>Empresa: </b>$empresa<br>		
		<b>Cedula ó Rif: </b>$cedulaRif<br>
		<b>Dirección Fiscal: </b>$direccion<br>	
		<b>Número de pedido: </b>$numPedido<br>	
		";
		
		if (!empty($_SESSION['direccionEnvio'])) {
		$cuerpo = $cuerpo. "<b>Dirección de Envio: </b>$direccionEnvio<br>";
		}
		
		$cuerpo = $cuerpo. "<br>			
		<p></p><p></p>
		$productos<br>
		<p></p>
		 Tus amigos en Pamplonasdeli.com<br>
		<a href=http://www.pamplonasdeli.com><img src=http://www.pamplonasdeli.com/ventasonline/img/logo.png /></a>
<p></p>	<p></p>
<hr>
Designed by tabin<br>
<a href=http://www.tabin.com.ve><img src=http://www.pamplonasdeli.com/ventasonline/img/ellogotabin.png /></a>
<h5>Hospital de clinicas Las Delicias, PB Local PB-10, Urb Las Delicias,<br>
Maracay, Estado Aragua, 2102<br>
RIF J403661448<br>
© tabin 2015 - All rights reserved<br></h5>
</p>";


		$yourWebsite = "pamplonasdeli.com";
		$yourEmail   = "ventas@pamplonasdeli.com";
	    $cabeceras = "From: $yourWebsite <$yourEmail>\n" . "Content-type: text/html" ;
		mail($destino,$asunto,$cuerpo,$cabeceras);	 
		
		
		// ========================================envio de correo al lector ===================
		$destino = $email;
		$asunto = "Pago de pedido online";
		$cabeceras = "Content-type: text/html";
		$cuerpo ="<h2>Gracias por tu orden!</h2><br>
        Hola <b>$nombre $apellido. &nbsp; $empresa</b><br>
		$direccion<br>
		<b>Número de pedido: </b>$numPedido<br>	";
		if (!empty($_SESSION['direccionEnvio'])) {
			$cuerpo = $cuerpo. "<b>Dirección de Envio: </b>$direccionEnvio<br>";
		}
		$cuerpo = $cuerpo. "<br>
        Hemos recibido tu orden de estos productos: <br> 	
		<p></p>
		$productos<br>
		<p></p>
        <br><br>		
		Muy pronto la estaremos despachando.<br>
		Su factura será enviada con el pedido. <br>
		Tus amigos en Pamplonas Deli.<br> <br><br>
		<a href=http://www.pamplonasdeli.com><img src=http://www.pamplonasdeli.com/ventasonline/img/logo.png /></a>
<p></p>	<p></p>
<hr>
Designed by tabin<br>
<a href=http://www.tabin.com.ve><img src=http://www.pamplonasdeli.com/ventasonline/img/ellogotabin.png /></a>
<h5>Hospital de clinicas Las Delicias, PB Local PB-10, Urb Las Delicias,<br>
Maracay, Estado Aragua, 2102<br>
RIF J403661448<br>
© tabin 2015 - All rights reserved<br></h5>
</p>";
	
		$yourWebsite = "pamplonasdeli.com";
		$yourEmail   = "ventas@pamplonasdeli.com";
	    $cabeceras = "From: $yourWebsite <$yourEmail>\n" . "Content-type: text/html" ;
		mail($destino,$asunto,$cuerpo,$cabeceras);
		
	//desconectar();		
	mysql_close();

	//===================================================Redirigir a otra pagina============================================
	header("Location: pagarProcesar_Listo.php");
?>