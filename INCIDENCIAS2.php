
  <style>
    h1 {
     color: green;
     text-align: center;
    }
    #picture {
      background-size: contain;
      background-repeat: no-repeat;
      width: 600px;
      height: 400px;

    }
    .label {
      width: 200px;
      height: 200px;
      border: solid 1px black;
    }
    #dropzone {
      margin-left: auto;
      margin-right: auto;

    }

  </style>
<div id="content">     
			<hr/>
		<strong>	  <p class="mb-0 text-uppercase" ><img src="includes/contraer31.png" id="mostrar2" style="cursor:pointer;"/>
<img src="includes/contraer41.png" id="ocultar2" style="cursor:pointer;"/>&nbsp;&nbsp;&nbsp; INCIDENCIAS</p></strong>


<div  id="mensajeINCIDENCIAS2">
<div class="progress" style="width: 25%;">
									<div class="progress-bar" role="progressbar" style="width: <?php echo $eventoscrono ; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $Aeventosporcentaje ; ?>%</div></div>
									</div>
									</div>
							
	        <div id="target2" style="display:block;" class="content2">
        <div class="card">
          <div class="card-body">
  <?php if($conexion->variablespermisos('','incidencias','guardar')=='si'){ ?>
                      <form class="row g-3 needs-validation was-validated" id="INCIDENCIASform"  novalidate="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 

          <table class="table mb-0 table-striped">

                <tr>
            
                <th style="text-align:center" scope="col"> INCIDENCIAS DE LA EMPRESA</th>
                 </tr>

      

    
            


      <table class="table mb-0 table-striped">
      <tr>
               
               <th style="text-align:center" scope="col"></th>
               <th style="text-align:center" scope="col"></th>

               </tr>
    
               <tr  style="background:#f7edf8"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">FECHA DE ALTA:</label></th>
         <td>

 <input type="date" class="form-control" id="validationCustom03" required=""    value="<?php echo date('Y-m-d'); ?>" name="FECHA_INCIDENCIAS" readonly="readonly">
 </div>
 </td>  </tr>


<tr style="background:#ebf8fa">
    <th style="text-align:left" scope="col">QUIEN LEVANTA LA INCIDENCIA:</th>
    <td>
    <?php
    $selectedText = 'SELECIONA UNA OPCIÓN'; // Valor por defecto
    
    if (isset($_SESSION['idem'])) {
        $queryper = $conexion->colaborador_generico_bueno();
        while($row = mysqli_fetch_array($queryper)) {
            if($_SESSION['idem'] == $row['idRelacion']) {
                // Construye el texto seleccionado
                $selectedText = $row['NOMBRE_1'] . ' ' . 
                                $row['NOMBRE_2'] . ' ' . 
                                $row['APELLIDO_PATERNO'] . ' ' . 
                                $row['APELLIDO_MATERNO'];
                break; // Termina el bucle al encontrar coincidencia
            }
        }
    }
    
    // Muestra un input de texto de solo lectura
    echo '<input type="text" class="form-control mb-3" readonly ';
    echo 'id="NOMBRE_INCIDENCIAS" name="NOMBRE_INCIDENCIAS" ';
    echo 'value="' . htmlspecialchars($selectedText) . '">';
    ?>
    </td>
</tr>


    <tr>
    <th style="background:#ebf8fa; text-align:left" scope="col"> INCIDENCIA PARA:</th>
       <td  style="background:#ebf8fa"><?php
$encabezadoA = '';
$queryper = $conexion->colaborador_generico_bueno();
$encabezadoA = '<select class="form-select mb-3" aria-label="Default select example" id="DOCUMENTO_INCIDENCIAS" required="" name="DOCUMENTO_INCIDENCIAS" onchange="OBTENER_depa();" placeholder="SELECIONA UNA OPCIÓN"><option value="">SELECCIONA UNA OPCIÓN</option>';
/*01informacionpersonal.idRelacion as aliasid*/

$fondos = array("fff0df","f4ffdf","dfffed","dffeff","dfe8ff","efdfff","ffdffd","efdfff","ffdfe9");
$num = 0;

while($row = mysqli_fetch_array($queryper))
{
//DOCUMENTO_INCIDENCIAS 
if($num==8){$num=0;}else{$num++;}

$select='';
//aliasid
$option22 .= '<option style="background: #'.$fondos[$num].'" '.$select.' 
value="'.$row['aliasid'].'^^'.$row['NOMBRE_1'].' '.$row['NOMBRE_2'].' '.$row['APELLIDO_PATERNO'].' '.$row['APELLIDO_MATERNO'].'">'.$row['NOMBRE_1'].' '.$row['NOMBRE_2'].' '.$row['APELLIDO_PATERNO'].' '.$row['APELLIDO_MATERNO'].
'</option>';
}
echo $encabezadoA.$option22.'</select>';		
?>

</td>

    </tr>

	


         <tr style="background:#ebf8fa"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">DEPARTAMENTO:</label></th>
        <td id="OBTENER_depa"><input type="text" class="form-control"  required=""    value="<?php echo $Departamento; ?>" name="Departamento" readonly="readonly">
         </td>  </tr> 
	
	
	
	  

           <tr style="background:#ebf8fa;">
          <th scope="col">INCIDENCIA:</th>
           <td ><textarea style="width:400px;" name="OBSERVACIONES_INCIDENCIAS" class="form-control" aria-label="With textarea"><?php echo $OBSERVACIONES_INCIDENCIAS; ?></textarea></td><br></br>
           
           </tr>
              <tr>


         <tr style="background:#ebf8fa"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">IMAGEN:</label></th>
         <td><input type="file" class="form-control" id="validationCustom03" required=""    value="<?php echo $ADJUNTO_INCIDENCIAS; ?>" name="ADJUNTO_INCIDENCIAS" >
         </td>  </tr>   



						
           <tr style="background:#ebf8fa"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">STATUS:</label></th>
         <td><input style="background:#fac3aa" type="text" class="form-control" id="validationCustom03" required=""    value="ACTIVO" name="STATUS" readonly="readonly">
         </td>  </tr>


    <tr style="width:300px;background:#ebf8fa">
   
    <th scope="row"> <label  style="width:300px;text-align:left"  for="validationCustom03" class="form-label"><div style="background-color: #f0f8ff; border-left: 4px solid #4b9cdb; padding: 15px; border-radius: 4px; margin: 20px 0;">
    <h5 style="margin-top: 0; color: #2c3e50;">📸 Capturar pantalla:</h5>
    <ol style="margin-bottom: 0;">
        <li>Presiona la tecla <strong>Impr Pant</strong> (PrtScn) en tu teclado</li>
        <li>Regresa a esta página y pega la captura aquí usando <kbd>Ctrl</kbd> + <kbd>V</kbd></li>
    </ol>
</div></th>
                
      
             
                <td>
				<input type="hidden" id="base64_file_form" />
        <div id="dropzone">
        </div>
        <div id="picture" >
		</div>
        <a id="LINK" target="_blank"></a>		
			</td>

	</tr>



						
</table>



                                    
    <input type="hidden" value="hINCIDENCIAS" name="hINCIDENCIAS"/>     
 
  <table>
  <tr>    
 <th>
           

 <button  style="float:right"  class="btn btn-sm btn-outline-success px-5"   type="button" id="GUARDAR_INCIDENCIAS">GUARDAR</button><div style="
    color: #f5f5f5;
    text-shadow: 1px 1px 1px #919191,
        1px 2px 1px #919191,
        1px 3px 1px #919191,
        1px 4px 1px #919191,
        1px 5px 1px #919191,
        1px 6px 1px #919191,
        1px 7px 1px #919191,
        1px 8px 1px #919191,
        1px 9px 1px #919191,
        1px 10px 1px #919191,
    1px 18px 6px rgba(16,16,16,0.4),
    1px 22px 10px rgba(16,16,16,0.2),
    1px 25px 35px rgba(16,16,16,0.2),
    1px 30px 60px rgba(16,16,16,0.4);
	@keyframes fadeIn {
  0% { opacity: 0; }
  100% { opacity: 100; }
}"


 id="mensajeINCIDENCIAS"/></th><?php } ?></tr></table>
           
            
                
 </form>


                 <!-- <form name="form_emil_INCIDENCIAS" id="form_emil_INCIDENCIAS">
				  <tr>
             <td ><textarea  placeholder="ESCRIBE AQUÍ TUS CORREOS SEPARADOS POR PUNTO Y COMA EJEMPLO: NOMBRE@CORREO.ES;NOMBRE@CORREO.ES" style="width: 500px;" name="EMAIL_INCIDENCIAS" id="EMAIL_INCIDENCIAS" class="form-control" aria-label="With textarea"><?php echo $EMAIL_INCIDENCIAS; ?></textarea>
            <button class="btn btn-sm btn-outline-success px-5"  type="button" id="BUTTON_INCIDENCIAS">ENVIAR POR EMAIL</button></td>  
                
           </tr>

           <?php
$querycontras = $incidencias->Listado_INCIDENCIAS();
?>

<br />
<div class='table-responsive'>
<div align='right'>
</div>
<br />
<div id='employee_table'>
<tbody= 'font-style:italic;'>
<table class="table table-striped table-bordered" style="width:100%" id='reset_INCIDENCIAS' name='reset_INCIDENCIAS'>
<tr style='background:#f5f9fc;text-align:center'>
<th width="10%"style="background:#c9e8e8">ENVIAR POR EMAIL</th>  
<th width="10%"style="background:#c9e8e8">FECHA DE CARGA</th>
<th width="10%"style="background:#c9e8e8">No.</th>

<th width="20%"style="background:#c9e8e8">NOMBRE</th>
<th width="20%"style="background:#c9e8e8">DEPARTAMENTO</th>
<th width="30%"style="background:#c9e8e8">INCIDENCIA</th>
<th width="15%"style="background:#c9e8e8">IMAGEN</th>
<th width="15%"style="background:#c9e8e8">CAPTURA PANTALLA</th>
<th width="35%"style="background:#c9e8e8">RESPUESTA</th>
<th width="10%"style="background:#c9e8e8">STATUS</th>
<th width="10%"style="background:#c9e8e8">FECHA DE ACTUALIZACIÓN</th>


</tr>

<?php
$urlADJUNTO_INCIDENCIAS ='';
while($row = mysqli_fetch_array($querycontras))
{	
	$urlADJUNTO_INCIDENCIAS = $conexion->descargararchivo($row["ADJUNTO_INCIDENCIAS"]);
	$base64_file = $conexion->descargararchivo($row["base64_file"]);
?>

<tr style='background:#f5f9fc;text-align:center'>
<td style="text-align:center" >
<input type="checkbox" style="width:15%" class="form-check-input" name="INCIDENCIAS[]" id="INCIDENCIAS" value="<?php echo $row["id"]; ?>"/> </td>
<td ><?php echo $row["FECHA_INCIDENCIAS"]; ?></td>
<td ><?php echo $row["id"]; ?></td>
<td ><?php echo $row["DOCUMENTO_INCIDENCIAS"]; ?></td>
<td ><?php echo $row["Departamento"]; ?></td>
<td ><?php echo $row["OBSERVACIONES_INCIDENCIAS"]; ?></td>
<td ><?php echo $urlADJUNTO_INCIDENCIAS; ?></td>
<td ><?php echo $base64_file; ?></td>
<td ><?php echo $row["RESPUESTA"]; ?></td>
<td ><?php echo $row["STATUS"]; ?></td>
<td ><?php echo $row["fecha_modificacion"]; ?></td>
<td>
<input type="button" name="view" value="MODIFICAR" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_INCIDENCIAS" />
</td>
<td><input type="button" name="view2" value="BORRAR" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_dataINCIDENCIASborrar" />
</td>
</tr>
<?php
}
?>

</table>


</tbody>

</form>
</div>
</div>-->

	</div>
		</div>
			</div>
