<?php
	require_once('tools/mypathdb.php');
	$email = $_POST ['Email'];

	// ==========================Buscar el password del cliente=====================================
	$query = mysql_query("SELECT * FROM tbl_usuarios WHERE us_email = '$email'");
	$dataUsuario = mysql_fetch_array($query);	
	
	$clave = $dataUsuario['us_clave']; 
	$nombre = $dataUsuario['us_nombre']; 
	$apellido = $dataUsuario['us_apellido']; 
	
		
	if(empty($dataUsuario))
		{
		$data=array("error" => '1');
		die(json_encode($data));
		}
	else
		{		
		//Consegui el registro		
		// ==================envio de correo con el password ===================
		$destino = $email;
		
		$asunto = "Recuperar Clave de PamplonasDeli";
		$cabeceras = "Content-type: text/html"; 
		$cuerpo ="<h1>En PamplonasDeli te ayudamos!</h1><br><br>
				Hola <b>".$nombre." ".$apellido."</b>,<br><br> 
				Hemos recuperado tu password: <strong> &nbsp;" 	.$clave."</strong><br><br>
				Recuerda ingresar a tu cuenta</a>  con tu cuenta de correo: <b> $email </b><br><br>
				Tus amigos en PamplonasDeli.<br>
				<img src=http://www.pamplonasdeli.com/ventasonline/img/password.jpg /><br>
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
		$data = array("exito" => '1');
		die(json_encode($data));				
		}
			
		//desconectar();
		mysql_close();
?>