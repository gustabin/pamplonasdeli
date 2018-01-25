<?php 
session_start();
error_reporting(0);
include "headerOtro.php";
require_once('tools/mypathdb.php');
?>
<style type="text/css">
.ciudad {
	color: #B11116;
}
</style>

<div id="fb-root"></div>
  <!-- .................................... $breadcrumb .................................... -->
  <section class="section-breadcrumb section-color-graylighter">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="index.php">Servicios</a><span class="divider">/</span></li>
        <li class="active">Entrega a domicilio</li>
      </ul> 
    </div>
  </section>
  <!-- .................................... $Contact .................................... -->
  
    <div class="container" style="margin-top:10px">
      <h2 class="section-title"><strong>Entregamos a domicilio</strong></h2>
      </div>
  
  <!-- .................................... $Contact .................................... -->
  <section class="section-content section-contact section-color-graylighter">
    <div class="container">
      <div class="row">
        <div class="span8">
        <h3>Estimado cliente, entregamos su orden en su casa u oficina en el transcurso de 3 a 5 días, siempre y cuando se encuentre en <span class="ciudad">la ciudad de Maracay</span>.</h3>
        <h3>Nos comunicaremos con usted para verificar su dirección y cualquier detalle de su orden.</h3>
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
	include "footer.php"; 
?>