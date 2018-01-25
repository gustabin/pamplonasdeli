<?php
	session_start();  
	error_reporting(0);
		// conector de BD 
		require_once('tools/mypathdb.php');

		$email = $_POST ['Email'];
		$clave = $_POST ['Password'];
		$direccion= $_POST['Direccion'];
		
		
	
		//======================validar que el password tenga mas de 6 caracteres=======================================
		if (strlen($clave)<6) {
			$data=array("error" => '1');
			die(json_encode($data));
			} 
			
		if (strlen($direccion)<20) {
			$data=array("error" => '5');
			die(json_encode($data));
			} 
			
			// si todo va bien
		$nombre = $_POST ['Nombre'];
		$apellido = $_POST ['Apellido'];
		$empresa= $_POST['Empresa'];
		$telefono= $_POST['celular'];
		$cedulaRif = $_POST ['cedulaRif'];
		$codigoPromocional = $_POST ['codigoPromocional']; 
		$status = 1;//"1 Activo, 2 Inactivo";
	
			// ===============================================Grabar los datos ==========================
			// =========================Buscar los datos en la tabla=====================================	
	if(empty($_SESSION['us_id']))
		{
			// ====================== Insertar los datos en la tabla ===============================
			
			$query_insertarUsuario = mysql_query("INSERT INTO tbl_usuarios (us_email, us_clave, us_status, us_fecha, us_tipo, us_promocion, us_nombre, us_apellido, us_empresa, us_cedulaRif, us_direccion, us_telefono) VALUES ('$email', '$clave', '$status', NOW(), '1', '$codigoPromocional', '$nombre', '$apellido', '$empresa', '$cedulaRif', '$direccion', '$telefono')");
			
			if (!empty($_SESSION['email'])) 
			{	// ========================= actualizar la tabla temporal =========================================	
				$query = mysql_query("UPDATE tbl_temporal SET email='$email' WHERE email='".$_SESSION['email']."'");	
				$_SESSION['email'] = $email;
			}
		}	
		
			if($query_insertarUsuario == false) 
			{
				$data=array("error" => '2');
				die(json_encode($data));
			}
			
			$user_id = mysql_insert_id();
			$_SESSION['us_id']=$user_id ;
			
			// =====================grabar ID en variable de session =====================
			
			$_SESSION['clave'] = $clave;
			
			$_SESSION['nombre'] = $nombre;
			$_SESSION['apellido'] = $apellido;
			$_SESSION['telefono']= $telefono;
			$_SESSION['direccion']= $direccion;
			$_SESSION['cedulaRif']=  $cedulaRif;
			$_SESSION['empresa']=  $empresa;
		
		
		//=========== Buscar el codigo promocional en la tbl_promociones ===============================
	if (!empty($codigoPromocional)) 
	{
		$queryPro = mysql_query("SELECT *FROM tbl_promocion WHERE pro_codigo='$codigoPromocional'");		
		$dataPromocion = mysql_fetch_array($queryPro);	

		if(empty($dataPromocion))
			{
				$data=array("error" => '4');
				die(json_encode($data));
			}	
		else
			{
				$pro_contador = $dataPromocion['pro_contador'];
				if ($pro_contador==100) 
					{
						$data=array("error" => '3');
						die(json_encode($data));
					}			  
			$pro_contador = $pro_contador + 1;
			// ===============================================Actualizar los datos en la tabla=====================================	
			$query = mysql_query("UPDATE tbl_promocion SET pro_contador='$pro_contador' WHERE pro_codigo='$codigoPromocional'");	
			
			}
	}
		

		// =======================envio de correo notificandome que un cliente se suscribio ===================
		$destino ="gustabin@yahoo.com";
		$asunto = "Contacto Web PamplonasDeli";
		$cabeceras = "Content-type: text/html";
		$cuerpo ="<h2>Hola, un cliente se ha registrado en la pamplonasdeli.com</h2>
		Los datos enviados son los siguientes:<br>
		<b>Email: </b>$email<br>
		<b>Nombre: </b>$nombre $apellido<br>
		<b>Empresa: </b>$empresa<br>
		<b>Telefono:  </b>$telefono<br>
		<b>Direccion: </b>$direccion<br>		
		<p>	</p>	
		<br><br>
		 Tus amigos en PamplonasDeli.<br>
		<a href=http://www.pamplonasdeli.com><img src=img/logo.png /></a>
<p></p>	<p></p>
<hr>
Designed by tabin<br>
<a href=http://www.tabin.com.ve><img src=img/ellogotabin.png /></a>
<h5>Hospital de clinicas Las Delicias, PB Local PB-10, Urb Las Delicias,<br>
Maracay, Estado Aragua, 2102<br>
RIF J403661448<br>
© tabin 2015 - All rights reserved<br></h5>
</p>";
		$yourWebsite = "plamplonasdeli.com";
		$yourEmail   = "ventas@pamplonasdeli.com";
	    $cabeceras = "From: $yourWebsite <$yourEmail>\n" . "Content-type: text/html" ;
		mail($destino,$asunto,$cuerpo,$cabeceras);	
		// ========================================envio de correo al doctor ===================
		
		$destino = $email;
		$asunto = "Bienvenido a Pamplonas Deli";
		$cabeceras = "Content-type: text/html";
		$cuerpo ="<h2>Te damos la Bienvenida!</h2><br>
        Hola <b>$nombre $apellido</b>,<br>
        En nuestro sitio usted podrá encontrar la más amplia variedad de productos para preparar su parrilla y de forma práctica realizar sus pedidos de manera online. <br>
		<br><br>
		<a href=http://www.pamplonasdeli.com/login.php>Ingresa a tu cuenta</a>  con tu nombre de usuario: <b> $email </b><br><br>
         Tus amigos en pamplonas Deli.<br>
		<a href=http://www.pamplonasdeli.com><img src=img/logo.png /></a>
<p></p>	<p></p>
<hr>
Designed by tabin<br>
<a href=http://www.tabin.com.ve><img src=img/ellogotabin.png /></a>
<h5>Hospital de clinicas Las Delicias, PB Local PB-10, Urb Las Delicias,<br>
Maracay, Estado Aragua, 2102<br>
RIF J403661448<br>
© tabin 2015 - All rights reserved<br></h5>
</p>";
		$yourWebsite = "pamplonasdeli.com";
		$yourEmail   = "ventas@pamplonasdeli.com";
	    $cabeceras = "From: $yourWebsite <$yourEmail>\n" . "Content-type: text/html" ;
		mail($destino,$asunto,$cuerpo,$cabeceras);

			//Los datos se han insertado correctamente.';		
			$data = array("exito" => '1');
			die(json_encode($data));									
			//desconectar();
			mysql_close();	//cerrar la conexion a la bd
?>