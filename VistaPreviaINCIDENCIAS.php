<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }  


$identioficador = isset($_POST["personal_id"])?$_POST["personal_id"]:'';
if($identioficador != '')
{
 $output = '';
 
	require "controladorIN.php";
	
	$conexion = NEW accesoclase();

$queryVISTAPREV = $conexion->Listado_INCIDENCIAS2($identioficador);
 $output .= '

 <form  id="Listado_INCIDENCIASform"> 
      <div class="table-responsive">  
           <table class="table table-bordered">';
		   ?>
<div>
<?php
    $row = mysqli_fetch_array($queryVISTAPREV);
	
	$ACTIVO = "";$PROCESO = "";$RESUELTO  = "";
    if($row['STATUS']=="ACTIVO"){$ACTIVO = "selected";}
elseif($row['STATUS']=="PROCESO"){$PROCESO = "selected";}
elseif($row['STATUS']=="RESUELTO"){$RESUELTO = "selected";}


$STATUS = '<select required="" name="STATUS"> 
<option selected="">SELECCIONA UNA OPCION</option>
<option style="background:#fac3aa" value="ACTIVO" '.$ACTIVO.'>ACTIVO</option>
<option style="background:#faf7aa" value="PROCESO" '.$PROCESO.'>PROCESO</option>
<option style="background:#c2faaa" value="RESUELTO" '.$RESUELTO.'>RESUELTO</option>

</select>';
    
        if($row["ADJUNTO_INCIDENCIAS"]!=""){
        $urlADJUNTO_INCIDENCIAS= "<a target='_blank'
        href='includes/archivos/".$row["ADJUNTO_INCIDENCIAS"]."'>Visualizar!</a>";
        }else{
        $urlADJUNTO_INCIDENCIAS="";
        }

        if($row["base64_file"]!=""){
        $urlbase64_file= "<a target='_blank'
        href='includes/archivos/".$row["base64_file"]."'>Visualizar!</a>";
        }else{
        $urlbase64_file="";
        }

             $output .= '

<tr>
<td width="30%"><label>FECHA DE ÚLTIMA CARGA</label></td>
<td width="70%">'.$row["FECHA_INCIDENCIAS"].'</td>
</tr> 


<tr>
<td width="30%"><label>NÚMERO</label></td>
<td width="70%">'.$row["id"].'</td>
</tr> 

<tr>
<td width="30%"><label>QUIEN LEVANTA LA INCIDENCIA </label></td>
<td width="70%">'.$row["NOMBRE_INCIDENCIAS"].'</td>
</tr>

<tr>
<td width="30%"><label>INCIDENCIA PARA:</label></td>
<td width="70%">'.$row["DOCUMENTO_INCIDENCIAS"].'</td>
</tr>
<tr>
<td width="30%"><label>DEPARTAMENTO</label></td>
<td width="70%">'.$row["Departamento"].'</td>
</tr>

<td width="30%"><label>INCIDENCIA</label></td>
<td width="70%">'.$row["OBSERVACIONES_INCIDENCIAS"].'</td>
</tr> 


<tr>
<td width="30%"><label>IMAGEN:</label></td>
<td width="70%">'.$urlADJUNTO_INCIDENCIAS.'</td>
</tr> 

<tr>
<td width="30%"><label>CAPTURA PANTALLA:</label></td>
<td width="70%">'.$urlbase64_file.'</td>
</tr>


<tr>
<td width="30%"><label>RESPUESTA</label></td>
<td width="70%"><textarea style="width:400px;" id="RESPUESTA" name="RESPUESTA" >'.$row["RESPUESTA"].'</textarea></td>
</tr> 
  <tr>           
<td width="30%"><label>STATUS</label></td>   
<td width="70%">'.$STATUS .'</td>
</tr> 
<tr>
<td width="30%"><label>FECHA DE ACTUALIZACIÓN</label></td>
<td width="70%">'.$row["fecha_modificacion"].'</td>
</tr>
';
	


	 $output .= '<tr>  
            <td width="30%"><label>GUARDAR</label></td>  
            <td width="70%">
			
			<input type="hidden" value="'.$row["id"].'"  name="IpINCIDENCIAS"  id="IpINCIDENCIAS"/>
			
			<button class="btn btn-sm btn-outline-success px-5" type="button" id="clickINCIDENCIAS">GUARDAR</button>
			
			<input type="hidden" value="enviarINCIDENCIAS"  name="enviarINCIDENCIAS"/>

			</td>  
        </tr>
     ';
    //IPCIERRE
    $output .= '</table></div></form>';
    echo $output;
}
//
?>

<script>


var fileobj;
	function upload_file(e,name) {
	    e.preventDefault();
	    fileobj = e.dataTransfer.files[0];
	    ajax_file_upload1(fileobj,name);
	}
	 
	function file_explorer(name) {
	    document.getElementsByName(name)[0].click();
	    document.getElementsByName(name)[0].onchange = function() {
	        fileobj = document.getElementsByName(name)[0].files[0];
	        ajax_file_upload1(fileobj,name);
	    };
	}

	function ajax_file_upload1(file_obj,nombre) {
	    if(file_obj != undefined) {
	        var form_data = new FormData();                  
	        form_data.append(nombre, file_obj);
	        form_data.append("IpINCIDENCIAS",  $("#IpINCIDENCIAS").val());
	        $.ajax({
	            type: 'POST',
				url: 'INCIDENCIAS/controladorIN.php',
				  dataType: "html",
	            contentType: false,
	            processData: false,
	            data: form_data,
 beforeSend: function() {
$('#2'+nombre).html('<p style="color:green;">Cargando archivo!</p>');
$('#respuestaser').html('<p style="color:green;">Actualizado!</p>');
    },				
	            success:function(response) {

if($.trim(response) == 2 ){

$('#2'+nombre).html('<p style="color:red;">Error, archivo diferente a PDF, JPG o GIF.</p>');
$('#'+nombre).val("");
}else{
$('#'+nombre).val(response);
$('#2'+nombre).html('<a target="_blank" href="includes/archivos/'+$.trim(response)+'">Visualizar!</a>');	
}

	            }
	        });
	    }
	}


    $(document).ready(function(){



$("#clickINCIDENCIAS").click(function(){
	
   $.ajax({  
    url:"INCIDENCIAS/controladorIN.php",
    method:"POST",  
    data:$('#Listado_INCIDENCIASform').serialize(),

    beforeSend:function(){  
    $('#mensajeINCIDENCIAS').html('cargando'); 
    }, 	
	
    success:function(data){
	
		if($.trim(data)=='Ingresado' || $.trim(data)=='Actualizado'){
			$('#dataModal').modal('hide');
			$("#reset_INCIDENCIAS").load(location.href + " #reset_INCIDENCIAS");
			$("#mensajeINCIDctualiza2").html("<span id='ACTUALIZADO' >"+data+"</span>");
			}else{
			$("#mensajeINCIDctualiza2").html(data);
			}
		$.getScript(load(1));
    }  
   });
   
});

/*$("#clickINCIDENCIAS").click(function(){
	
   $.ajax({
	url: 'INCIDENCIAS/controladorIN.php',
    method:"POST",  
    data:$('#Listado_INCIDENCIASform').serialize(),

    beforeSend:function(){
    $('#mensajeINCIDctualiza2').html('cargando'); 
    }, 	
	
    success:function(data){
	$('#mensajeINCIDctualiza2').html("<span id='ACTUALIZADO' >"+data+"</span>"); 

	//$("#reset_INCIDENCIAS").load(location.href + " #reset_INCIDENCIAS");
    //$('#mensajeINCIDctualiza2').html("<span id='ACTUALIZADO' >"+data+"</span>"); 
	//$('#dataModal').modal('hide');

    }  
   });
   
});*/

		});
		
	</script>
	