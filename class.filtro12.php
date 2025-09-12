<?php
/**
 	--------------------------
	Autor: Sandor Matamoros
	Programer: Fatima Arellano
	Propietario: EPC
	----------------------------
 
*/

define("__ROOT1__", dirname(dirname(__FILE__)));
	include_once (__ROOT1__."/../includes/error_reporting.php");
	include_once (__ROOT1__."/../INCIDENCIAS/class.epcinnIN.php");

	
	class orders extends accesoclase {
	public $mysqli;
	public $counter;//Propiedad para almacenar el numero de registro devueltos por la consulta

	function __construct(){
		$this->mysqli = $this->db();
    }
	
	public function countAll($sql){
		$query=$this->mysqli->query($sql);
		$count=$query->num_rows;
		return $count;
	}
	//STATUS_EVENTO,NOMBRE_CORTO_EVENTO,NOMBRE_EVENTO
	public function getData($tables,$campos,$search){
		$offset=$search['offset'];
		$per_page=$search['per_page'];
		
		$sWhere=" ";
		$sWhere2="";
$sWhere3="";if($search['FECHA_INCIDENCIAS']!=""){
$sWhere2.="  $tables.FECHA_INCIDENCIAS LIKE '%".$search['FECHA_INCIDENCIAS']."%' OR ";}

if($search['id']!=""){
$sWhere2.="  $tables.id = '".$search['id']."' OR ";}

if($search['DOCUMENTO_INCIDENCIAS']!=""){
$sWhere2.="  $tables.DOCUMENTO_INCIDENCIAS LIKE '%".$search['DOCUMENTO_INCIDENCIAS']."%' OR ";}

if($search['Departamento']!=""){
$sWhere2.="  $tables.Departamento LIKE '%".$search['Departamento']."%' OR ";}

if($search['OBSERVACIONES_INCIDENCIAS']!=""){
$sWhere2.="  $tables.OBSERVACIONES_INCIDENCIAS LIKE '%".$search['OBSERVACIONES_INCIDENCIAS']."%' OR ";}

if($search['STATUS']!=""){
$sWhere2.="  $tables.STATUS LIKE '%".$search['STATUS']."%' OR ";}

if($search['hINCIDENCIAS']!=""){
$sWhere2.="  $tables.hINCIDENCIAS LIKE '%".$search['hINCIDENCIAS']."%' OR ";}

if($search['RESPUESTA']!=""){
$sWhere2.="  $tables.RESPUESTA LIKE '%".$search['RESPUESTA']."%' OR ";}
if($search['NOMBRE_INCIDENCIAS']!=""){
$sWhere2.="  $tables.NOMBRE_INCIDENCIAS LIKE '%".$search['NOMBRE_INCIDENCIAS']."%' OR ";}
$idem = isset($_SESSION['idem']) ? $_SESSION['idem'] : '';

if ($sWhere2 != "") {
    // Quita el último 'AND' sobrante
    $sWhere22 = rtrim($sWhere2);
    $sWhere22 = preg_replace('/\s+AND\s*$/i', '', $sWhere22);

    $sWhere3 = ' WHERE ( 
        idRelacion = "'.$idem.'" 
        AND SUBSTRING_INDEX(DOCUMENTO_INCIDENCIAS, "&&&", -1) = "'.$idem.'"
        AND ('.$sWhere22.') 
    ) ';
} else {
    $sWhere3 = ' WHERE ( 
        idRelacion = "'.$idem.'" 
        AND SUBSTRING_INDEX(DOCUMENTO_INCIDENCIAS, "&&&", -1) = "'.$idem.'"
    ) ';
}

		
		$sWhere3.="  order by $tables.id desc ";
		$sql="SELECT $campos FROM  $tables $sWhere $sWhere3 LIMIT $offset,$per_page";
		
		$query=$this->mysqli->query($sql);
		$sql1="SELECT $campos FROM  $tables $sWhere $sWhere3 ";
		$nums_row=$this->countAll($sql1);
		//Set counter
		$this->setCounter($nums_row);
		return $query;
	}
	function setCounter($counter) {
		$this->counter = $counter;
	}
	function getCounter() {
		return $this->counter;
	}
}
?>
