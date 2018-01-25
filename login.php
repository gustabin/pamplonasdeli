<?php 
session_start();
error_reporting(0);
include "header.php"; 
require_once('tools/mypathdb.php'); 
$idCategoria = $_GET['categoria'];
?>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

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
<script Language="JavaScript">
    $("body").on('submit', '#formLogin', function(event) {
	event.preventDefault()
	if ($('#formLogin').valid()) {
		$('#barra').show();
	    $.ajax({
		type: "POST",
		url: "login_Procesar.php",
		dataType: "json",
		data: $(this).serialize(),
		success: function(respuesta) {
			$('#barra').hide();
		    if (respuesta.error == 1) {
			  $('#error1').show();
			setTimeout(function() {
			  $('#error1').hide();
			}, 3000);
		    }
			
			if (respuesta.error == 2) {
			  $('#error2').show();
			setTimeout(function() {
			  $('#error2').hide();
			}, 3000);
		    }
			
			if (respuesta.error == 4) {
			  $('#error4').show();
			setTimeout(function() {
			  $('#error4').hide();
			}, 3000);
		    }
			
			if (respuesta.exito == 1) {
			  $('#mensaje').show();
			  setTimeout(function() {
			  $('#mensaje').hide();
			  window.location.href='pagar.php'; 
			}, 3000);
		    }
			
		}
	    });
	}
	});	    
</script>
<div role="main" class="main shop">
    <div class="container">
        <hr class="tall">
        <div class="row">
            
        <div class="col-md-3">
            
		</div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">									
                    <p><img src="img/lineaSiPiensas.png" class="img-responsive"></p>
                </div>
            </div>

            <div class="row">
                
                <!-------------------DESDE AQUI-------------!-->
                    <div>
                         <h5>Disfruta de nuestro servicio</h5>
                          <address>
                            Estamos orgullosos de poder ayudarte con tu parrilla.
                            
                          </address>
                         
                          <p>Encuentra los mejores productos y compralos  en l&iacute;nea.</p>
                          <p>
                            <a class="btn btn-danger" href="registrar.php">Registrar</a>
                          </p>  <hr />            
                    </div>
                    <div>
                        <h5>Por favor completa los siguientes datos</h5>
                          <form class="form-vertical" id="formLogin">
                            <div class="control-group"> 
                              <input name="email" type="text" class="span4 required email" id="email" placeholder="Email" size="30">
                              
                              <input name="password" type="password" class="span4 required" id="password" placeholder="Password" size="30">              	
                            </div>			
                            <div class="control-group">
                                <p><a href="recuperar.php">Olvidates tu password?  </a> &nbsp; &nbsp; &nbsp;  &nbsp;   <a href="registrar.php">  Nuevo cliente</a></p>
                                
                            </div>			
                            <div class="control-group">         
                            <button class="btn btn-danger" type="submit">Enviar</button>
                            <button class="btn btn-default" type="reset">Cancelar</button>
                            </div>
                          </form>
                             <div class="alert alert-success mensaje_form" style="display: none" id="mensaje">
                                <button data-dismiss="alert" class="close" type="button">x</button>
                                <strong></strong> <span class="textmensaje">Bienvenido!...</span>
                             </div>             
                             <div class="alert alert-danger mensaje_form" style="display: none" id="error1">
                                <button data-dismiss="alert" class="close" type="button">x</button>
                                <strong></strong> <span class="textmensaje">Email o password incorrecto</span>
                             </div>
                             <div class="alert alert-danger mensaje_form" style="display: none" id="error2">
                                <button data-dismiss="alert" class="close" type="button">x</button>
                                <strong></strong> <span class="textmensaje">Esta cuenta esta desactivada</span>
                             </div>
                             <div class="alert alert-danger mensaje_form" style="display: none" id="error4">	
                                <button data-dismiss="alert" class="close" type="button">x</button>
                                <strong>MENSAJE: </strong> <span class="textmensaje">Aun no ha activado su cuenta</span>
                            </div>             
                             <div style="float:left; display:none" id="barra"><img src="img/barra3.gif" alt="Cargando..."/><br>Ingresando....</div>	
                        </div>
                    <!-------------------HASTA AQUI-------------!-->             
            
        </div>
        <br>
         <img src="img/lineaRoja.png" class="img-responsive">
    </div>
                        
        <!-- .................................... $footer .................................... -->
			<?php 
			include "footer.php"; 
			?>        