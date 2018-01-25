<?php 
session_start();
error_reporting(0);
include "headerOtro.php";
require_once('tools/mypathdb.php');
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  <!-- .................................... $breadcrumb .................................... -->
  <section class="section-breadcrumb section-color-graylighter">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="index.php">Compra</a><span class="divider">/</span></li>
        <li class="active">Realizada</li>
      </ul> 
    </div>
  </section>
  <!-- .................................... $Contact .................................... -->
  
    <div class="container" style="margin-top:10px">
      <h2 class="section-title"><strong>Transacción exitosa</strong></h2>
      </div>
  
  <!-- .................................... $Contact .................................... -->
  <section class="section-content section-contact section-color-graylighter">
    <div class="container">
      <div class="row">
        <div class="span8">
        <h3>Estimado cliente, esperamos que nuestro servicio sea de su agrado, pronto estaremos preparando su orden para ser despachada.</h3>
        <h3>Le hemos enviado un correo con la orden de compra.</h3>
        <h5>El equipo de Pamplonas Deli.</h5>
        <p></p>
        <h4>Siguenos</h4>
							<div class="social-icons">
								<ul class="social-icons">                                
									<li class="facebook"><div class="fb-share-button" data-href="https://www.pamplonasdeli.com" data-layout="button_count"></div></li>
									<li class="twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.pamplonasdeli.com">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>									
								</ul>
							</div>
        <p></p>
        <br>
        <a href="index.php">Volver al Inicio</a>
        </div>
      </div>
      
							
						
    </div>
  </section>
  
  
<!-- .................................... $footer .................................... -->
<?php 
	$sql = mysql_query("DELETE FROM tbl_temporal WHERE email='".$_SESSION['email']."'"); // Borramos los productos de la tabla temporal 
	session_destroy(); // Borramos toda la sesion
	include "footer.php"; 
?>