<?php
session_start();
require_once('tools/mypathdb.php');
ob_start();
if (!empty($_GET ['id'])) 	
	{
	$id = $_GET ['id'];	//viene en el URL
	} else {
	$id = $_SESSION['id'];
	}
?>
<style type="text/css">
<!--
.style2 {color: #000000}
.style3 {font-size: 18px}
-->
 table.page_footer {width: 100%; border: none; background-color: rgb(159,73,68); border-top: solid 1mm rgb(238,238,238); padding: 2mm}
    table.page_header {width: 100%; border: none; background-color: rgb(159,73,68); border-bottom: solid 1mm rgb(238,238,238); padding: 2mm }
.historia {
	font-size: 9px;
}
.grande {
	font-size: 18px;
}
</style>

<page backtop="28mm" backbottom="14mm" backleft="20mm" backright="10mm">
    <page_header>
<table class="page_header">
            <tr>
                <td style="width: 33%; text-align: left; color:#999">&nbsp;&nbsp;&nbsp; 
						
							<img width="297" height="88"  src="img/logo.png">
						
					 </td>
                     <td style="width: 33%; text-align: center; color:#999">&nbsp;&nbsp;&nbsp; 
						
						
					 Productos online</td>
                
                
                
                
                <td style="width: 34%; text-align: center">&nbsp;
                </td>
                <td style="width: 33%; text-align: right">&nbsp;                    
                </td>
            </tr>
        </table>

    </page_header>
    <page_footer>
    
<?php
		//$id=$_SESSION['id'];
		

//********** Buscar el id del producto en la tabla PRODUCTOS *********************************************	
	
	$query = mysql_query("SELECT * FROM tbl_productos WHERE id = $id"); 
	$dataProducto = mysql_fetch_array($query);	
	
		$foto = $dataProducto['foto'];  // foto del empaque
		$producto = $dataProducto['producto']; 
		$revisiones = $dataProducto['revisiones']; 
		$unidadesPaquete = $dataProducto['unidadesPaquete']; 
		$pesoAprox = $dataProducto['pesoAprox']; 
		$valoracion = $dataProducto['valoracion']; 
		$precio = $dataProducto['precio']; 
		$fotoAdicional1 = $dataProducto['fotoAdicional1']; 
		$fotoAdicional2 = $dataProducto['fotoAdicional2']; 
		$fotoAdicional3 = $dataProducto['fotoAdicional3']; 
		$fotoAdicional4 = $dataProducto['fotoAdicional4']; 
		$fotoAdicional5 = $dataProducto['fotoAdicional5']; 
		$descripcion = $dataProducto['descripcion']; 
		$ingredientes = $dataProducto['ingredientes']; 
		$cantidad = $dataProducto['cantidad']; 
		$categoria = $dataProducto['categoria']; 
		$codigo = $dataProducto['codigo']; 

?>

<table class="page_footer">
            <tr>
                <td style="width: 33%; text-align: left; color:#CCC">
                    &nbsp;&nbsp;&nbsp; <span class="historia">Producto:</span> <?php echo $producto ?>
                </td>
                <td style="width: 34%; text-align: center; color:#CCC">
                    página [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 33%; text-align: right; color:#CCC">
              Pamplonas Deli. &nbsp;&nbsp;&nbsp;</td>
            </tr>
        </table>
    </page_footer>

<table style="border:0px solid gray">
            <thead>
              <tr>
                <th>&nbsp;</th>
              </tr>
              <tr>
                <th>&nbsp;</th>
              </tr>
              <tr>
                <th><span class="grande"><?php echo $producto ?></span></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td align="right"><span><?php echo $codigo ?> </span></td>
              </tr>             
              <tr>
                <td><span><?php echo $descripcion ?> </span></td>
              </tr>
              <tr>    
                <td><span><strong>Ingredientes:</strong> &nbsp;<?php echo $ingredientes ?></span> </td> 
              </tr>
              <tr>    
				<td><span><strong>Cantidad:</strong> &nbsp;<?php echo $cantidad ?></span> </td>           
              </tr>
              <tr>
                 <td><span><strong>Categoria:</strong> &nbsp;<?php echo $categoria ?></span> </td> 
              </tr>
              <tr>     
                <td><span><strong>Unidades x Paquete:</strong> &nbsp;<?php echo $unidadesPaquete ?></span> </td> 
              </tr>
              <tr>     
               <td><span><strong>Peso Aprox: </strong>&nbsp;<?php echo $pesoAprox ?></span> </td>      
              </tr>
               <tr>     
				<td><span><strong>Precio:</strong> &nbsp;<?php echo $precio ?></span> </td>        
              </tr>
              <tr>    
                <td><span><strong>Revisiones:</strong> &nbsp;<?php echo $revisiones ?></span> </td> 
              </tr>
              <tr>    
				<td><span><strong>Valoración:</strong> &nbsp;<?php echo $valoracion ?></span> </td> 
              </tr>
              
              <tr>    
                <td>&nbsp;</td> 
              </tr>
              <tr>    
                <td>&nbsp;</td> 
              </tr>
              <tr>    
                <td><div class="thumbnail">
										<img alt="" class="img-responsive img-rounded" src="img/products/<?php echo $fotoAdicional5 ?>">
									</div> </td> 
              </tr>
              
              
              
              </tbody>
              </table>

</page>


<?php
$content = ob_get_clean();
ob_end_clean();
require_once('lib/html2pdf/html2pdf.class.php');
try {
    $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array(0, 0, 0, 0));
    $html2pdf->pdf->SetDisplayMode('real');
    $html2pdf->writeHTML($content);
    $html2pdf->Output('Comprobante_PDF.pdf');
}
catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>