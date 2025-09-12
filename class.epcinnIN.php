<?php
/*
clase EPC INNOVA
CREADO : 10/mayo/2023
TESTER: FATIMA ARELLANO
PROGRAMER: SANDOR ACTUALIZACION: 1 MAY 2023

*/
	define('__ROOT3__', dirname(dirname(__FILE__)));
	require __ROOT3__."/includes/class.epcinn.php";	
	

	
	class accesoclase extends colaboradores{



	
	/*public function colaborador_generico_bueno_inicidencias(){
	$conn = $this->db();                                           
	$variablequery = "select *,01informacionpersonal.idRelacion as aliasid from 01informacionpersonal inner join 01adjuntoscolaboradores on 01informacionpersonal.idRelacion = 01adjuntoscolaboradores.idRelacion where ESTATUS_CRM_ACTIVOBAJA = 'ACTIVO' order by 01informacionpersonal.`NOMBRE_1` asc; ";
	
	return $arrayquery = mysqli_query($conn,$variablequery);	
		
	}*/



	public function variable_incidencias(){
		$conn = $this->db();
		$variablequery = "select * from 12INCIDENCIAS where idRelacion = '".$_SESSION['id']."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		return $row = mysqli_fetch_array($arrayquery, MYSQLI_ASSOC);		
	}

public function INCIDENCIAS($DOCUMENTO_INCIDENCIAS ,$ADJUNTO_INCIDENCIAS, $OBSERVACIONES_INCIDENCIAS , $FECHA_INCIDENCIAS , $hINCIDENCIAS,$IpINCIDENCIAS,$enviarINCIDENCIAS,$NUMEROI,$RESPUESTA,$STATUS,$fecha_modificacion,$Departamento,$NOMBRE_INCIDENCIAS,$base64_file){

$conn = $this->db();
$session = isset($_SESSION['id'])?$_SESSION['id']:'';  
if($session != ''){                            
    //DOCUMENTO_INCIDENCIAS split |
	$explotado = explode('&&&',$DOCUMENTO_INCIDENCIAS);
 $var1nononoooop = "update 12INCIDENCIAS  set
 DOCUMENTO_INCIDENCIAS= '".$DOCUMENTO_INCIDENCIAS."' , 
 ADJUNTO_INCIDENCIAS= '".$ADJUNTO_INCIDENCIAS."' , 
 NUMEROI= '".$NUMEROI."' , 
 RESPUESTA= '".$RESPUESTA."' , 
 STATUS= '".$STATUS."' , 
 fecha_modificacion= '".$fecha_modificacion."' ,
  Departamento= '".$Departamento."' ,
  NOMBRE_INCIDENCIAS= '".$NOMBRE_INCIDENCIAS."' ,
 OBSERVACIONES_INCIDENCIAS = '".$OBSERVACIONES_INCIDENCIAS."' ,  
 hINCIDENCIAS = '".$hINCIDENCIAS."'
 where id = '".$IpINCIDENCIAS."' ;  ";
 
 $nueva_fecha = date('Y-m-d');
  $var1 = "update 12INCIDENCIAS  set
 RESPUESTA= '".$RESPUESTA."' , 
 STATUS= '".$STATUS."' , 
 fecha_modificacion= '".$nueva_fecha."'
 where id = '".$IpINCIDENCIAS."' ;  ";

 $var2 = "insert into 12INCIDENCIAS ( 
 DOCUMENTO_INCIDENCIAS, ADJUNTO_INCIDENCIAS,  NUMEROI, 
 RESPUESTA,STATUS,fecha_modificacion,
 
 Departamento,NOMBRE_INCIDENCIAS,OBSERVACIONES_INCIDENCIAS, FECHA_INCIDENCIAS, 
 hINCIDENCIAS, idRelacion, base64_file) values ( 
 '".$explotado[0]."' , '".$ADJUNTO_INCIDENCIAS."' , '".$NUMEROI."' , 
 '".$RESPUESTA."' , '".$STATUS."' , '".$fecha_modificacion."' , 
 '".$Departamento."' , 
 '".$NOMBRE_INCIDENCIAS."' , '".$OBSERVACIONES_INCIDENCIAS."', '".$FECHA_INCIDENCIAS."' , 
 '".$hINCIDENCIAS."' , '".$explotado[1]."',  '".$base64_file."' ); ";		
    
    if($enviarINCIDENCIAS=='enviarINCIDENCIAS'){
mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
return "Actualizado";
            
}else{
mysqli_query($conn,$var2) or die('P161'.mysqli_error($conn));
return "Ingresado";
}
    
}else{
echo "TU SESIÓN HA TERMINADO";	
}

}


public function Listado_INCIDENCIAS(){
$session = isset($_SESSION['id'])?$_SESSION['id']:'';

$conn = $this->db();
$variablequery = "select * from 12INCIDENCIAS WHERE idRelacion = '".$session."' order by id desc ";
return $arrayquery = mysqli_query($conn,$variablequery);
}	


public function Listado_INCIDENCIAS2($id){
$conn = $this->db();
$variablequery = "select * from 12INCIDENCIAS  where id = '".$id."' ";
return $arrayquery = mysqli_query($conn,$variablequery);
}






public function borra_INCIDENCIAS($id){
$conn = $this->db();
$variablequery = "delete from 12INCIDENCIAS where id = '".$id."' ";
$arrayquery = mysqli_query($conn,$variablequery);
RETURN 

"<P style='color:green; font-size:18px;'>ELEMENTO BORRADO</P>";
}



///////////////////////////////////////////////////
	public function obtenerdepartamento($idRelacion){
		$idRelacion2 = explode('^^',$idRelacion);
	$conn = $this->db();
	$variablequery = "select * from 01empresa  where id = '".$idRelacion2[0]."' ";
	$arrayquery = mysqli_query($conn,$variablequery);
	$arrayquery_ARRAY = mysqli_fetch_array($arrayquery, MYSQLI_ASSOC);
	return $arrayquery_ARRAY['DEPARTAMENTO'];
}

		

   /*nuevodocucierr*//*nuevodocucierr*//*nuevodocucierr*//*nuevodocucierr*//*nuevodocucierr*/


	public function NUEVODOCU($NUEVODEPA , $hNUEVODEPA,$enviarNUEVO,$IPNUEVO){
		
		$conn = $this->db();
		//$existe = $this->revisar_guardar_cierrenuevo();
		$session = isset($_SESSION['id'])?$_SESSION['id']:'';  
		if($session != ''){
			
		 $var1 = "update 12NUEVOD set 
		 NUEVODEPA = '".$NUEVODEPA."' , hNUEVODEPA = '".$hNUEVODEPA."'  where id = '".$IPNUEVO."' ; ";
	
		 $var2 = " insert into 12NUEVOD (NUEVODEPA, hNUEVODEPA, idRelacion) values ( '".$NUEVODEPA."' , '".$hNUEVODEPA."' , '".$session."' ); ";		
			
	    if($enviarNUEVO=='enviarNUEVO'){
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";
					
		}else{
		mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
		return "Ingresado";
		}
			
        }else{
		echo "TU SESIÓN HA TERMINADO";	
		}
		
	}


	public function Listado_NUEVODEPA2($id){
		$conn = $this->db();
		$variablequery = "select * from 12NUEVOD  where id = '".$id."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}

	public function Listado_NUEVODEPA(){
		$conn = $this->db();
		$variablequery = "select * from 12NUEVOD ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}	

	public function revisar_guardar_nuevo($id){
		$conn = $this->db();
		$var1 = 'select id from 12NUEVOD where id = "'.$id.'" ';
		
		$query = mysqli_query($conn,$var1) or die('P44'.mysqli_error($conn));
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		return $row['id'];
	}
	public function BORRAREGISTRO_NUEVO($id){
		$conn = $this->db();
		$var1 = 'DELETE from 12NUEVOD where id = "'.$id.'" ';
	
		$query = mysqli_query($conn,$var1) or die('P44'.mysqli_error($conn));
		mysqli_fetch_array($query, MYSQLI_ASSOC);
				RETURN 
		
		"<P style='color:green;font-size:25px;'>ELEMENTO BORRADO</P>";
	}



	
	
	public function variable_comborelacion1a(){
		$session = isset($_SESSION['id'])?$_SESSION['id']:'';		
		
		$conn = $this->db();				
		$variablequery = "select * from 02empresarelacion where idRelacionP = '".$session."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		$row = mysqli_fetch_array($arrayquery);
		if($row['idRelacionC']>=1){
		return $row['idRelacionC'];
		}else{
		return "no";			
		}
		
		}

		public function variables_informacionfiscal_logo(){
		$conn = $this->db();
		$variablequery = "select ADJUNTAR_LOGO_INFORMACION from 03docs_info_fiscal where idRelacion = '".$_SESSION['idlc']."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		$row = mysqli_fetch_array($arrayquery, MYSQLI_ASSOC);
		return $row['ADJUNTAR_LOGO_INFORMACION'];
		
	}
	}
	
	
		
	

?>