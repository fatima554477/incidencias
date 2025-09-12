<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

define('__ROOT1__', dirname(dirname(__FILE__)));
include_once (__ROOT1__."/includes/error_reporting.php");
include_once (__ROOT1__."/INCIDENCIAS/class.epcinnIN.php");

$incidencias = NEW accesoclase();
$conexion = NEW colaboradores();

$hINCIDENCIAS = isset($_POST["hINCIDENCIAS"])?$_POST["hINCIDENCIAS"]:"";
$enviarINCIDENCIAS = isset($_POST["enviarINCIDENCIAS"])?$_POST["enviarINCIDENCIAS"]:"";
$IpINCIDENCIAS = isset($_POST["IpINCIDENCIAS"])?$_POST["IpINCIDENCIAS"]:"";
$borra_INCIDENCIAS = isset($_POST["borra_INCIDENCIAS"])?$_POST["borra_INCIDENCIAS"]:"";
$EMAIL_INCIDENCIAS = isset($_POST["EMAIL_INCIDENCIAS"])?$_POST["EMAIL_INCIDENCIAS"]:"";
$hNUEVODEPA = isset($_POST["hNUEVODEPA"])?$_POST["hNUEVODEPA"]:"";	
$enviarNUEVO = isset($_POST["enviarNUEVO"])?$_POST["enviarNUEVO"]:"";	
$BORRAREGISTRO_NUEVO = isset($_POST["BORRAREGISTRO_NUEVO"])?$_POST["BORRAREGISTRO_NUEVO"]:"";



$OBTENER_depa1= isset($_POST["OBTENER_depa1"])?$_POST["OBTENER_depa1"]:"";
if($OBTENER_depa1=='OBTENER_depa1'){
	//
	$DOCUMENTO_INCIDENCIAS= isset($_POST["DOCUMENTO_INCIDENCIAS"])?$_POST["DOCUMENTO_INCIDENCIAS"]:"";
     echo $incidencias->obtenerdepartamento($DOCUMENTO_INCIDENCIAS);
}

if($hNUEVODEPA == 'hNUEVODEPA' ){

	
$NUEVODEPA = isset($_POST["NUEVODEPA"])?$_POST["NUEVODEPA"]:"";
$hNUEVODEPA = isset($_POST["hNUEVODEPA"])?$_POST["hNUEVODEPA"]:""; 	
$IPNUEVO = isset($_POST["IPNUEVO"])?$_POST["IPNUEVO"]:""; 	
   echo $incidencias->NUEVODOCU ($NUEVODEPA , $hNUEVODEPA,$enviarNUEVO,$IPNUEVO);
   


 }	 
   elseif($BORRAREGISTRO_NUEVO == 'BORRAREGISTRO_NUEVO'){
	$borra_NUEVOD = isset($_POST["borra_NUEVOD"])?$_POST["borra_NUEVOD"]:"";
		
	echo $incidencias->BORRAREGISTRO_NUEVO($borra_NUEVOD);
	 
	
  //include_once (__ROOT1__."/includes/crea_funciones.php");  
} 


	
///////////////////////////////////////////////////////
  if($hINCIDENCIAS == 'hINCIDENCIAS' or $enviarINCIDENCIAS=='enviarINCIDENCIAS'){
	  
	
	  	   	   if( $_FILES["ADJUNTO_INCIDENCIAS"] == true){
$ADJUNTO_INCIDENCIAS = $conexion->solocargar("ADJUNTO_INCIDENCIAS");
}if($ADJUNTO_INCIDENCIAS=='2' or $ADJUNTO_INCIDENCIAS=='' or $ADJUNTO_INCIDENCIAS=='1'){
 $ADJUNTO_INCIDENCIAS1 = "";	
}else{
 $ADJUNTO_INCIDENCIAS1 = $ADJUNTO_INCIDENCIAS;
}
	  
$DOCUMENTO_INCIDENCIAS = isset($_POST["DOCUMENTO_INCIDENCIAS"])?$_POST["DOCUMENTO_INCIDENCIAS"]:"";
$OBSERVACIONES_INCIDENCIAS = isset($_POST["OBSERVACIONES_INCIDENCIAS"])?$_POST["OBSERVACIONES_INCIDENCIAS"]:"";
$FECHA_INCIDENCIAS = isset($_POST["FECHA_INCIDENCIAS"])?$_POST["FECHA_INCIDENCIAS"]:"";
$hINCIDENCIAS = isset($_POST["hINCIDENCIAS"])?$_POST["hINCIDENCIAS"]:""; 
$NUMEROI = isset($_POST["NUMEROI"])?$_POST["NUMEROI"]:"";
$RESPUESTA = isset($_POST["RESPUESTA"])?$_POST["RESPUESTA"]:"";
$STATUS = isset($_POST["STATUS"])?$_POST["STATUS"]:"";
$base64_file =  isset($_POST["base64_file"])?$_POST["base64_file"]:'';
$fecha_modificacion = isset($_POST["fecha_modificacion"])?$_POST["fecha_modificacion"]:"";
$Departamento = isset($_POST["Departamento"])?$_POST["Departamento"]:"";
$NOMBRE_INCIDENCIAS = isset($_POST["NOMBRE_INCIDENCIAS"])?$_POST["NOMBRE_INCIDENCIAS"]:"";


		/*$RUTAFILTRO = 'INCIDENCIAS'; 
		$claseactual = 'class.epcinnIN.php';
		$tablesdb = '12INCIDENCIAS';
		include_once (__ROOT1__."/includes/crea_funciones_filtro_completo.php");*/
		
		
		
$base64_file = $_POST["base64_file"]; // Asumo que recibes el base64 desde un POST
$dropy = $_POST["dropy"];

// Verificar estructura base64 válida
$parts = explode(";base64,", $base64_file);


// Extraer metadata y datos
$mime_type = str_replace('data:', '', $parts[0]);
$strbase64 = base64_decode($parts[1]);

// Solo procesar si es imagen
if (strpos($mime_type, 'image/') === 0) {
    // Obtener extensión del tipo MIME
    $extension = str_replace('image/', '', $mime_type);
    
    // Mapear extensiones comunes (ej: image/jpeg -> jpg)
    $extensiones_validas = [
        'jpeg' => 'jpg',
        'png'  => 'png',
        'gif'  => 'gif',
        'bmp'  => 'bmp'
    ];
    
    // Verificar extensión válida y asignar
    $ext = isset($extensiones_validas[$extension]) 
           ? $extensiones_validas[$extension] 
           : 'png'; // default
    
    // Generar nombre único con extensión correcta
    $nombre_strbase64 = 'INCIDENCIAS_'.date("Y_m_d_H_i_s").".$ext";
    $pathfile = __ROOT1__."/includes/archivos/".$nombre_strbase64;
    
    // Guardar archivo
    if (file_put_contents($pathfile, $strbase64)) {
        echo " ";
    } 
} 
	
	
	echo $incidencias->INCIDENCIAS( $DOCUMENTO_INCIDENCIAS ,$ADJUNTO_INCIDENCIAS1, $OBSERVACIONES_INCIDENCIAS , $FECHA_INCIDENCIAS , $hINCIDENCIAS,$IpINCIDENCIAS,$enviarINCIDENCIAS,$NUMEROI,$RESPUESTA,$STATUS ,$fecha_modificacion,$Departamento,$NOMBRE_INCIDENCIAS,$nombre_strbase64);

   
  
 }
elseif($EMAIL_INCIDENCIAS ==true){
$conexion2 = new herramientas();
$NOMBRE_1 = 'Peticion';
$EMAILnombre = array($EMAIL_INCIDENCIAS=>$NOMBRE_1);
$adjuntos = array(''=>'');
$Subject = 'DATOS SOLICITADOS';
/*nuevo*/
$array = isset($_POST['INCIDENCIAS'])?$_POST['INCIDENCIAS']:'';
if($array != ''){
$loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
$or1='';
for($rrr=0;$rrr<=$loopcuenta;$rrr++){
	if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
	$query1 .= ' id= '.$array[$rrr].$or1;
}
$query2 = str_replace('[object Object]','',$query1);
$query2 = "and (".$query2.") ";
}else{
	echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
} 
                                                                  
$MANDA_INFORMACION = $incidencias->MANDA_INFORMACION('DOCUMENTO_INCIDENCIAS, OBSERVACIONES_INCIDENCIAS, FECHA_INCIDENCIAS,NUMEROI,RESPUESTA,STATUS ',

'NOMBRE ,INCIDENCIA,FECHA,NUMERO,RESPUESTA,STATUS', '12INCIDENCIAS',  " where idRelacion = '".$_SESSION['id'] ."' ".$query2/*nuevo*/ );

$variables = 'ADJUNTO_INCIDENCIAS, ';
//DOCUMENTO_INCIDENCIAS trim($variables, ',');

 $cadenacompleta =substr($variables, 0, -2);
 
$adjuntos = $incidencias->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'12INCIDENCIAS', " where idRelacion = '".$_SESSION['id'] ."' ".$query2 );

$html = $incidencias->html2('FOTOS VEHICULOS',$MANDA_INFORMACION );
$logo = 'ADJUNTAR_LOGO_INFORMACION_2023_05_31_07_45_49.jpg';
//$idlogo = $incidencias->variable_comborelacion1a();
//$logo = $incidencias->variables_informacionfiscal_logo($idlogo);


$embebida = array('../includes/archivos/'.$logo => 'ver');
echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
}  
	  
 if($borra_INCIDENCIAS == 'borra_INCIDENCIAS' ){

$borra_incidencias = isset($_POST["borra_incidencias"])?$_POST["borra_incidencias"]:"";
	echo $incidencias->borra_INCIDENCIAS($borra_incidencias);
}	  
	//include_once (__ROOT1__."/includes/crea_funciones.php"); 	  
		



if($IpINCIDENCIAS == true and ( $_FILES["ADJUNTO_INCIDENCIAS"] == true ) ){
foreach($_FILES AS $ETQIETA => $VALOR){
	echo $conexion->cargar($ETQIETA,'12INCIDENCIAS','3',$IpINCIDENCIAS);
}	

}

?>