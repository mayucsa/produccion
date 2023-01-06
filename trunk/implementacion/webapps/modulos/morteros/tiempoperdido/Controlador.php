<?php 
date_default_timezone_set('America/Mexico_City');
include_once 'modelo_tiempoperdido.php';
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}
function getMaquinas(){
	$Maquinas = new ModeloTiempoPerdido;
	dd($Maquinas->showMaquina());
}
function getFallos(){
	$Fallos = new ModeloTiempoPerdido;
	dd($Fallos->showFallo());
}
function getDifHoras($inicio, $fin){
	$inicio = explode(':', $inicio);
	$fin = explode(':', $fin);
	$horas = intval($fin[0]) - intval($inicio[0]);
	$minutos = intval($fin[1]) - intval($inicio[1]);
	$segundos = intval($fin[2]) - intval($inicio[2]);
	if ($minutos < 0) {
		$minutos--;
		$segundos = abs($segundos);
	}
	if ($minutos < 0) {
		$horas--;
		$minutos = abs($minutos);
	}
	$horas = str_pad($horas, 2, '0', STR_PAD_LEFT);
	$minutos = str_pad($minutos, 2, '0', STR_PAD_LEFT);
	$segundos = str_pad($segundos, 2, '0', STR_PAD_LEFT);
	return $horas.':'.$minutos.':'.$segundos;
}
function getTurno($hora){
	$hora = explode(' ', $hora);
	if (isset($hora[1])) {
		$hora = $hora[1];
	}else{
		$hora = '00:00:00';
	}
	if ($hora >=  '01:00:00' && $hora <= '09:00:00'){
        return '3er Turno';
    } 
    if ($hora >=  '09:00:01' && $hora <= '18:00:00'){
        return '1er Turno';
    } 
    if ($hora >=  '18:00:01' && $hora <= '23:59:59'){
         return '2do Turno';
    }
    return 'Sin Turno';
}
function serverSideTPMorteros($dbcon){
	$sql = "SELECT cve_tp, nombre_maq, nombre_fallo, hora_inicio, hora_fin, '' Diferencia, tp.fecha_registro, '' Turno 
	FROM seg_tiempoperdido AS tp 
    INNER JOIN cat_maquinas m ON (tp.cve_maq = m.cve_maq)
    INNER JOIN cat_fallos f ON (tp.cve_fallo = f.cve_fallo)
    WHERE estatus_tp = 'VIG' AND area = 'Morteros'";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    foreach ($datos as $i => $row) {
    	$row->Diferencia = getDifHoras($row->hora_inicio, $row->hora_fin);
    	$row->Turno = getTurno($row->fecha_registro);
    }
    dd($datos);
}
include_once "../../../dbconexion/conn.php";
$dbcon	= 	new MysqlConn;
$conn 	= 	$dbcon->conn();
// inicio
$tarea = isset($_REQUEST['task']) ? $_REQUEST['task'] : '';
if ($tarea == '') {
	// en caso de que el llamado al controlador haya sido por http post y no por formulario
	$objDatos = json_decode(file_get_contents("php://input"));
	$tarea = $objDatos->task;
}
switch ($tarea){
	case 'getMaquinas':
		getMaquinas();
		break;
	case 'getFallos':
		getFallos();
		break;
	case 'serverSideTPMorteros':
		serverSideTPMorteros($dbcon);
		break;
}

?>
