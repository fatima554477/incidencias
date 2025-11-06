<?php

/**
 	--------------------------
	Autor: Sandor Matamoros
	Programer: Fatima Arellano
	Propietario: EPC
	----------------------------
 
*/


	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	define("__ROOT6__", dirname(__FILE__));
$action = (isset($_POST["action"])&& $_POST["action"] !=NULL)?$_POST["action"]:"";
if($action == "ajax"){

	require(__ROOT6__."/class.filtro.php");
	$database=new orders();	

	$query=isset($_POST["query"])?$_POST["query"]:"";

	$DEPARTAMENTO = !EMPTY($_POST["DEPARTAMENTO2"])?$_POST["DEPARTAMENTO2"]:"DEFAULT";	
	$nombreTabla = "SELECT * FROM `08altaeventosfiltroDes`, 08altaeventosfiltroPLA WHERE 08altaeventosfiltroDes.id = 08altaeventosfiltroPLA.idRelacion";
	$altaeventos = "altaeventos";
	$tables="12INCIDENCIAS";
	

$FECHA_INCIDENCIAS = isset($_POST["FECHA_INCIDENCIAS"])?$_POST["FECHA_INCIDENCIAS"]:""; 
$id = isset($_POST["id22"])?$_POST["id22"]:""; 
$DOCUMENTO_INCIDENCIAS = isset($_POST["DOCUMENTO_INCIDENCIAS"])?$_POST["DOCUMENTO_INCIDENCIAS"]:""; 
$Departamento = isset($_POST["Departamento"])?$_POST["Departamento"]:""; 
$OBSERVACIONES_INCIDENCIAS = isset($_POST["OBSERVACIONES_INCIDENCIAS"])?$_POST["OBSERVACIONES_INCIDENCIAS"]:""; 
$STATUS = isset($_POST["STATUS"])?$_POST["STATUS"]:"";
$RESPUESTA = isset($_POST["RESPUESTA"])?$_POST["RESPUESTA"]:"";
$NOMBRE_INCIDENCIAS = isset($_POST["NOMBRE_INCIDENCIAS"])?$_POST["NOMBRE_INCIDENCIAS"]:"";


$hINCIDENCIAS = isset($_POST["hINCIDENCIAS"])?$_POST["hINCIDENCIAS"]:""; 
//print_r($_POST);
$per_page=intval($_POST["per_page"]);
	$campos="*";
	//Variables de paginación
	$page = (isset($_POST["page"]) && !empty($_POST["page"]))?$_POST["page"]:1;
	$adjacents  = 4; //espacio entre páginas después del número de adyacentes
	$offset = ($page - 1) * $per_page;
	
	$search=array(

"FECHA_INCIDENCIAS"=>$FECHA_INCIDENCIAS,
"id"=>$id,
"DOCUMENTO_INCIDENCIAS"=>$DOCUMENTO_INCIDENCIAS,
"Departamento"=>$Departamento,
"OBSERVACIONES_INCIDENCIAS"=>$OBSERVACIONES_INCIDENCIAS,
"STATUS"=>$STATUS,
"RESPUESTA"=>$RESPUESTA,
"hINCIDENCIAS"=>$hINCIDENCIAS,
"NOMBRE_INCIDENCIAS"=>$NOMBRE_INCIDENCIAS,

 "per_page"=>$per_page,
	"query"=>$query,
	"offset"=>$offset);
	//consulta principal para recuperar los datos
	$datos=$database->getData($tables,$campos,$search);
	$countAll=$database->getCounter();
	$row = $countAll;
	
	if ($row>0){
		$numrows = $countAll;;
	} else {
		$numrows=0;
	}	
	$total_pages = ceil($numrows/$per_page);
	
	
	//Recorrer los datos recuperados
		?>	

		<div class="clearfix">
			<?php 
				echo "<div class='hint-text'> ".$numrows." registros</div>";
				require __ROOT6__."/pagination.php"; //include pagination class
				$pagination=new Pagination($page, $total_pages, $adjacents);
				echo $pagination->paginate();
			?>
        </div>
		
		
		
		
	<div class="table-responsive">
	<style>
    thead tr:first-child th {
        position: sticky;
        top: 0;
        background: #c9e8e8;
        z-index: 10;
    }

    thead tr:nth-child(2) td {
        position: sticky;
        top: 60px; /* Altura del primer encabezado */
        background: #e2f2f2;
        z-index: 9;
    }
</style>
<div style="max-height: 600px; overflow-y: auto;">
			  
				  
	 <table class="table table-striped table-bordered" >	
		<thead>
            <tr>
<th style="background:#c9e8e8"></th>			
<th style="background:#c9e8e8">ENVIAR EMAIL</th>		
			

<th style="background:#c9e8e8">#</th>

<?php 
if($database->plantilla_filtro($nombreTabla,"FECHA_INCIDENCIAS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">FECHA INCIDENCIAS</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"id",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center"># INCIDENCIA</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"NOMBRE_INCIDENCIAS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">QUIÉN LEVANTA</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"DOCUMENTO_INCIDENCIAS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">INCIDENCIA PARA</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"Departamento",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">Departamento</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"OBSERVACIONES_INCIDENCIAS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">OBSERVACIONES INCIDENCIAS</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"base64_file",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">CAPTURA PANTALLA</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"ADJUNTO_INCIDENCIAS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">IMAGEN</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"STATUS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">STATUS AVANCE</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"RESPUESTA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">RESPUESTA</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"fecha_modificacion",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">FECHA<BR>ACTUALIZACIÓN</th>
<?php } ?>

<th style="background:#c9e8e8;text-align:center"></th>
<th style="background:#c9e8e8;text-align:center"></th>
<?php /*termina copiar y terminaA3*/ ?>
            </tr>
            <tr>
			
			
			
<td style="background:#c9e8e8" ></td>


<td style="background:#c9e8e8"></td>
<td style="background:#c9e8e8"></td>
<?php /*inicia copiar y pegar iniciaA4*/ ?>

<!--<hr/><H1>HTML FILTRO E INPUT .PHP A4</H1><BR/>-->
<?php  
if($database->plantilla_filtro($nombreTabla,"FECHA_INCIDENCIAS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="date" class="form-control" id="FECHA_INCIDENCIAS_1" value="<?php 
echo $FECHA_INCIDENCIAS; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"id",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#c9e8e8"><input type="text" class="form-control" id="idAA_1" value="<?php echo $id; ?>">
</td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"NOMBRE_INCIDENCIAS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="NOMBRE_INCIDENCIAS_1" value="<?php 
echo $NOMBRE_INCIDENCIAS; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"DOCUMENTO_INCIDENCIAS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="DOCUMENTO_INCIDENCIAS_1" value="<?php 
echo $DOCUMENTO_INCIDENCIAS; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"Departamento",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="Departamento_1" value="<?php 
echo $Departamento; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"OBSERVACIONES_INCIDENCIAS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="OBSERVACIONES_INCIDENCIAS_1" value="<?php 
echo $OBSERVACIONES_INCIDENCIAS; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"base64_file",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"ADJUNTO_INCIDENCIAS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"STATUS",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#c9e8e8">
<select class="form-select mb-3" aria-label="Default select example" id="STATUS_1"  onchange="load(1);">
<option value="">TODOS</option>
<option value="ACTIVO" <?php if($_POST['STATUS']=='ACTIVO'){echo 'selected';} ?>>ACTIVO</option>
<option value="PROCESO" <?php if($_POST['STATUS']=='EN PROCESO'){echo 'selected';} ?>>EN PROCESO</option>
<option value="RESUELTO" <?php if($_POST['STATUS']=='RESUELTO'){echo 'selected';} ?>>RESUELTO</option>
<option value="SELECCIONA UNA OPCIÓN" <?php if($_POST['STATUS']=='SELECCIONA UNA OPCIÓN'){echo 'selected';} ?>>SELECCIONA UNA OPCIÓN</option>
</select>
</td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"RESPUESTA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="RESPUESTA_1" value="<?php 
echo $RESPUESTA; ?>"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"fecha_modificacion",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"></td>
<?php } ?>


<?php /*termina copiar y terminaA4*/ ?>
	
		<td style="background:#c9e8e8"></td>
		<td style="background:#c9e8e8"></td>
            </tr>			
        </thead>
		<?php 	if ($numrows<0){ ?>
		</table>
		<?php }else{ ?>		
        <tbody>
		<?php
		$finales=0;
		
		foreach ($datos as $key=>$row){
			
			
	$urlADJUNTO_INCIDENCIAS = $database->descargararchivo($row["ADJUNTO_INCIDENCIAS"]);
	$base64_file = $database->descargararchivo($row["base64_file"]);
	
	    $fondo = '';
    if ($row['STATUS'] == 'RESUELTO') {
        $fondo = 'style="background-color:#DAF7A6;"'; // Verde claro para resuelto
    } elseif ($row['STATUS'] == 'PROCESO') {
        $fondo = 'style="background-color:#FFFFED;"'; // Amarillo claro para en proceso
    } else {
        $fondo = 'style="background-color: #f79d91 ;"'; // Rojo claro para activo
    }
	
			
			?>
		 <tr <?php echo $fondo; ?>>
		 						<td>
    <input type="checkbox" 
           class="checkbox"
           data-id="<?php echo $row['id'];?>" 
           style="transform: scale(1.1); cursor: pointer;" 
           onchange="
               const fila = this.closest('tr');
               const id = this.getAttribute('data-id');
               if (this.checked) {
                      fila.style.filter = 'brightness(65%) sepia(100%) saturate(200%) hue-rotate(0deg)';
                   localStorage.setItem('checkbox_' + id, 'checked');
               } else {
                   fila.style.filter = 'none';
                   localStorage.removeItem('checkbox_' + id);
               }">
</td>
		
<td style="text-align:center" >
<input type="checkbox" style="width:15%" class="form-check-input" name="INCIDENCIAS[]" id="INCIDENCIAS" value="<?php echo $row["id"]; ?>"/> </td>
		
<td><?php echo $row["id"];?></td>
<?php /*inicia copiar y pegar iniciaA5*/ ?>
<!--<hr/><H1>FOREACH FILTRO .PHP A5</H1><BR/>--><?php  if($database->plantilla_filtro($nombreTabla,"FECHA_INCIDENCIAS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['FECHA_INCIDENCIAS'];?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"id",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['id'];?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"NOMBRE_INCIDENCIAS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['NOMBRE_INCIDENCIAS'];?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"DOCUMENTO_INCIDENCIAS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php 


		$DOCUMENTO_INCIDENCIAS = explode('^^',$row['DOCUMENTO_INCIDENCIAS']);

echo $DOCUMENTO_INCIDENCIAS[1];?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"Departamento",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['Departamento'];?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"OBSERVACIONES_INCIDENCIAS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['OBSERVACIONES_INCIDENCIAS'];?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"base64_file",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $base64_file;?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"ADJUNTO_INCIDENCIAS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $urlADJUNTO_INCIDENCIAS;?></td>
<?php } ?>



<?php  if($database->plantilla_filtro($nombreTabla,"STATUS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['STATUS'];?></td >
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"RESPUESTA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['RESPUESTA'];?></td>
<?php } ?>


<?php  if($database->plantilla_filtro($nombreTabla,"fecha_modificacion",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['fecha_modificacion'];?></td>
<?php } ?>


<?php /*termina copiar y terminaA5*/ ?>
			<td>
<?php if($database->variablespermisos('','incidencias','modificar')=='si'){ ?>
<input type="button" name="view" value="MODIFICAR" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_INCIDENCIAS" />			
<?php } ?>
			</td>
			<td>
<?php if($database->variablespermisos('','incidencias','borrar')=='si'){ ?>
<input type="button" name="view2" value="BORRAR" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_dataINCIDENCIASborrar" />
<?php } ?>
			</td>			
		</tr>
			<?php
			$finales++;
		}	
	?>
		</tbody>
		</table>

		</div>
		<div class="clearfix">
			<?php 
				$inicios=$offset+1;
				$finales+=$inicios -1;
				echo '<div class="hint-text">Mostrando '.$inicios.' al '.$finales.' de '.$numrows.' registros</div>';
				echo $pagination->paginate();
			?>
        </div>
	<?php
	}
}
?>
