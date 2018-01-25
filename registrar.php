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
	$(document).ready(function() {
		$('#titulo').html("Paso 1/ Datos Personales");
         $(".tlf").mask("(0999) 999-99-99");			 
	});
	
	
	function ocultarCiudades(){   //funcion para desaparecer cbo_ciudades
		$('#cbo_ciudades').hide();
	} 
		 
	
    //Metodo para cargar los datos personales
    $("body").on('submit', '#registrarCliente', function(event) {
		event.preventDefault()
		if ($('#registrarCliente').valid()) {
			$.ajax({
				type: "POST",
				url: "registrarProcesar.php",
				dataType: "json",
				data: $(this).serialize(),
				success: function(respuesta) {
					if (respuesta.error == 1) {
						$('#error1').show();
						setTimeout(function() {
						$('#error1').hide();
						}, 2000);
					}
					if (respuesta.error == 2) {
						$('#error2').show();
						setTimeout(function() {
						$('#error2').hide();
						}, 2000);
					}
					if (respuesta.error == 3) {
						$('#error3').show();
						setTimeout(function() {
						$('#error3').hide();
						}, 2000);
					}
					if (respuesta.error == 4) {
						$('#error4').show();
						setTimeout(function() {
						$('#error4').hide();
						}, 2000);
					}
					if (respuesta.error == 5) {
						$('#error5').show();
						setTimeout(function() {
						$('#error5').hide();
						}, 2000);
					}
					if (respuesta.exito == 1) {
			  			$('#mensaje').show();
			  			setTimeout(function() {
			  			$('#mensaje').hide();
			  			window.location.href='pagar.php'; 
						}, 1000);
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
  <section class="section-content section-contact section-color-graylighter">
    <div class="container">
      <div class="row">
        <div class="span4">
          <h5>Disfruta de nuestro servicio</h5>
          <address>
            Estamos orgullosos de poder ayudarte en tu parrilla.
            
          </address>
          
          <p>
            <a class="btn btn-small btn-danger" href="login.php">Login</a>
          </p>
        </div>
        <div class="span8">
          <h5>Por favor completa los siguientes datos</h5>
   
    <form class="form-vertical" id="registrarCliente">
		<div class="control-group">
	  		<p>
	  		  <input name="Email" type="text" class="span4 required email" id="Email" placeholder="Email">
	  		  <input name="Password" type="password" class="span4 required" id="Password"  placeholder="Password"> 
	  		</p>
	  		<p>
	  		  </p>
        </div>
	
		<div class="control-group">
			<p>
			  <input name="Nombre" type="text" class="span4 required" id="Nombre" placeholder="Nombre">
			  <input name="Apellido" type="text" class="span4 required" id="Apellido" placeholder="Apellido">
			</p>
			<p>
			  <input name="Empresa" type="text" class="span4" id="Empresa" placeholder="Empresa">
			  </p>
			<p>
			  </p>
        </div>	

		<div class="control-group">
            <p>
              <textarea name="Direccion" cols="65" rows="2" class="required" id="Direccion"  placeholder="Direcci&oacute;n" ></textarea>  
            </p>           
		</div>	
        
            <p>
              <select name="Ciudad">
                <option value="Maracay">Maracay</option>
              </select> &nbsp; <span style="color:#B11116">	Actualmente solo realizamos envios en Maracay </span>
            </p>           
		

		<div class="control-group">
            <p>
              <input name="cedulaRif" type="text" class="required" id="cedulaRif" placeholder="C&eacute;dula &oacute; Rif"> 
              <input name="celular" type="text" class="span4 required tlf" id="celular"  placeholder="Tel&eacute;fono">     
            </p>
            <p>
            </p>
        </div>			
	
	
        <!--div class="control-group">              	
			¿Cuentas con un código promocional? 
            <input name="codigoPromocional" type="text" class="span4" id="codigoPromocional"  placeholder="Código promocional">
		</div!-->
	
		<div class="control-group">         
			<button class="btn btn-danger" type="submit" id="enviar">Guardar</button>
			<button class="btn btn-default" type="reset" id="cancelar">Cancelar</button>
		</div>
        
  </form> <!--cierre del formulario !-->

	 
     
     <!-- ================= mensajes de EXITO o de ERROR===========================================================  !-->
     <div class="alert alert-success mensaje_form" style="display: none" id="mensaje">
		<button data-dismiss="alert" class="close" type="button">x</button>
		<strong>MENSAJE!</strong> <span class="textmensaje">Registro exitoso</span>          
	 </div>    
   	 
      
	 <div class="alert alert-danger mensaje_form" style="display: none" id="error1">
		<button data-dismiss="alert" class="close" type="button">x</button>
		<strong>MENSAJE!</strong> <span class="textmensaje">El password debe ser mayor de 6 caracteres</span>
	 </div>
     
	 <div class="alert alert-danger mensaje_form" style="display: none" id="error2">
		<button data-dismiss="alert" class="close" type="button">x</button>
		<strong>MENSAJE!</strong> <span class="textmensaje">El cliente ya está registrado</span>
	 </div>
     
     <div class="alert alert-danger mensaje_form" style="display: none" id="error3">
		<button data-dismiss="alert" class="close" type="button">x</button>
		<strong>MENSAJE!</strong> <span class="textmensaje">Ese código promocional ya fue utilizado 10 veces</span>
	 </div>
     
     <div class="alert alert-danger mensaje_form" style="display: none" id="error4">
		<button data-dismiss="alert" class="close" type="button">x</button>
		<strong>MENSAJE!</strong> <span class="textmensaje">Código promocional no encontrado</span>
	 </div>
     
     <div class="alert alert-danger mensaje_form" style="display: none" id="error5">
		<button data-dismiss="alert" class="close" type="button">x</button>
		<strong>MENSAJE!</strong> <span class="textmensaje">Debe colocar su direccion completa</span>
	 </div>
        </div>
        
      </div>
    </div>
  </section>
                    <!-------------------HASTA AQUI-------------!-->             
            
        </div>
        <br>
         <img src="img/lineaRoja.png" class="img-responsive">
    </div>
                        
        <!-- .................................... $footer .................................... -->
			<?php 
			include "footer.php"; 
			?>        