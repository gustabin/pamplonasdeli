<?php 
session_start();
error_reporting(0);
include "header.php"; 
require_once('tools/mypathdb.php'); 
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
   <script language="JavaScript" type="text/JavaScript">
	                       
    //Metodo para cargar el formulario 
    $("body").on('submit', '#formRecuperar', function(event) {
	event.preventDefault()
	if ($('#formRecuperar').valid()) {
	    $.ajax({
		type: "POST",
		url: "recuperar_Procesar.php",
		dataType: "json",
		data: $(this).serialize(),
		success: function(respuesta) {
		    if (respuesta.error == 1) {
			  $('#error').show();
				setTimeout(function() {
			  $('#error').hide();			  
			}, 3000);
		    }
			  
			  if (respuesta.exito == 1) {
			  $('#mensaje').show();
			  setTimeout(function() {
			  $('#mensaje').hide();
			  window.location.href="login.php";
			}, 3000);			  
		    }		    
		}
	    });
	}
	});
	function Salir() {
		window.location.href="login.php";
	}    
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
        <div class="span4">
          <h5>Nos preocupamos por ti</h5>
          <address>
            Tu informaci&oacute;n siempre esta a salvo con nosotros, tan solo completa el siguiente campo y de inmediato recupera tu password.
          </address>
        </div>
        <div class="span8">
          <h5>Por favor completa el siguiente dato</h5>
          <form class="form-vertical" id="formRecuperar">
            <div class="control-group">
              <input name="Email" type="text" class="span4 required email" id="Email" size="50" placeholder="Email">              
            </div>			
			
            <div class="control-group">         
            <button class="btn btn-danger" type="submit">Enviar</button>

			<button class="btn btn-default" type="button" onclick="Salir()">Cancelar</button>
			</div>
          </form>
		     
			 <div class="alert alert-danger mensaje_form" style="display: none" id="error">
				<button data-dismiss="alert" class="close" type="button">x</button>
				<strong>ALERTA!</strong> <span class="textmensaje">No tenemos ese email registrado</span>
			 </div>
			 <div class="alert alert-success mensaje_form" style="display: none" id="mensaje">
				<button data-dismiss="alert" class="close" type="button">x</button>
				<strong>ALERTA!</strong> <span class="textmensaje">Te enviamos su password a tu cuenta de Email</span>
			 </div>
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