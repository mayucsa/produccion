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
	$ini = explode(':', $inicio);
	$fin = explode(':', $fin);
	$horas_fin = intval($fin[0]) * 3600;
    $minutos_fin = intval($fin[1]) * 60;
    $segundos_fin = intval(isset($fin[2])?$fin[2]:0);
    $horas_ini = intval($ini[0]) * 3600;
	$minutos_ini = intval($ini[1]) * 60;
	$segundos_ini = intval(isset($ini[2])?$ini[2]:0);
	$inicial = $horas_ini+$minutos_ini+$segundos_ini;
	$final = $horas_fin+$minutos_fin+$segundos_fin;
    if ($inicial > $final) {
    	$dif = (86400 + $final) - $inicial;
    }else{
    	$dif = $final - $inicial;
    }
    $horas = intval($dif / 3600);
    $minutos = intval(($dif % 3600)/60);
    $segundos = $dif - (($horas * 3600 ) + ($minutos * 60)); 
    $dif = str_pad($horas, 2, '0', STR_PAD_LEFT).':'.str_pad($minutos, 2, '0', STR_PAD_LEFT).':'.str_pad($segundos, 2, '0', STR_PAD_LEFT);
	return $dif;
}
function getTurno($hora){
	$hora = explode(' ', $hora);
	if (isset($hora[1])) {
		$hora = $hora[1];
	}else{
		$hora = '00:00:00';
	}
	if ($hora >=  '00:00:01' && $hora <= '08:00:00'){
        return '3er Turno';
    } 
    if ($hora >=  '08:00:01' && $hora <= '16:00:00'){
        return '1er Turno';
    } 
    if ($hora >=  '16:00:01' && $hora <= '23:59:59'){
         return '2do Turno';
    }
    return 'Sin Turno';
}
function serverSideTPMorteros($dbcon){
	$sql = "SELECT cve_tp, nombre_maq, nombre_fallo, hora_inicio, hora_fin, '' Diferencia, tp.fecha_registro, '' Turno 
	FROM seg_tiempoperdido AS tp 
    INNER JOIN cat_maquinas m ON (tp.cve_maq = m.cve_maq)
    INNER JOIN cat_fallos f ON (tp.cve_fallo = f.cve_fallo)
    WHERE estatus_tp = 'VIG' AND area = 'Morteros'
    ORDER BY cve_tp DESC ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    foreach ($datos as $i => $row) {
    	$row->Diferencia = getDifHoras($row->hora_inicio, $row->hora_fin);
    	$row->Turno = getTurno($row->fecha_registro);
    }
    dd($datos);
}
function guardarTiempoPerdido($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = 'VIG';
	$area = 'Morteros';
	$conn = $dbcon->conn();
	if ($Datos->orden == '') {
		$Datos->orden = 0;
	}
	$sql = "INSERT INTO seg_tiempoperdido (cve_maq, cve_fallo, motivo_fallo, orden_servicio, hora_inicio, hora_fin, area, capturado_por, estatus_tp, fecha_registro) VALUES (".$Datos->maquina.", ".$Datos->fallo.", '".$Datos->motivo."',".$Datos->orden.", '".$Datos->hinicio."', '".$Datos->hfin."', '".$area."', ".$Datos->id.", '".$status."', '".$fecha."' ) ";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	// dd($sql);
	if ($qBuilder) {
		$getId = "SELECT max(cve_tp) cve_tp FROM seg_tiempoperdido WHERE
		fecha_registro = '".$fecha."'
		AND area = '".$area."'
		AND capturado_por = ".$Datos->id."
		AND estatus_tp = '".$status."'
		AND cve_maq = ".$Datos->maquina."
		AND cve_fallo = ".$Datos->fallo."
		AND motivo_fallo =  '".$Datos->motivo."'
		AND hora_inicio = '".$Datos->hinicio."'
		AND hora_fin = '".$Datos->hfin."' ";

		$getId = $dbcon->qBuilder($conn, 'first', $getId);
		dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getId->cve_tp]);
	}else{
		dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
	}
}
function EliminarTPerdido($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = 'DELETE';
	$conn = $dbcon->conn();
	$sql = "UPDATE seg_tiempoperdido SET estatus_tp = '".$status."', eliminado_por = ".$Datos->id.", fecha_eliminado = '".$fecha."' WHERE cve_tp = ".$Datos->cve." ";

	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	dd($sql);
}
function EditarTPerdido($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = 'VIG';
	$conn = $dbcon->conn();
	$cBuilder = "SELECT cve_maq, cve_fallo, motivo_fallo, hora_inicio, hora_fin FROM seg_tiempoperdido WHERE cve_tp = ".$Datos->cve." ";
	$cBuilder = $dbcon->qBuilder($conn, 'first', $cBuilder);
	// dd($cBuilder);

	$sql = "INSERT INTO ctrl_editar_tp(cve_tp, cve_maq, cve_maq_nuevo, cve_fallo, cve_fallo_nuevo, motivo_fallo, motivo_fallo_nuevo, hora_inicio,hora_inicio_nuevo, hora_fin, hora_fin_nuevo, editado_por, estatus_editado, fecha_edicion) VALUES(".$Datos->cve.", ".$cBuilder->cve_maq.", ".$Datos->maquinae.", ".$cBuilder->cve_fallo.", ".$Datos->falloe.", '".$cBuilder->motivo_fallo."', '".$Datos->motivoe."', '".$cBuilder->hora_inicio."', '".$Datos->inicioe."', '".$cBuilder->hora_fin."', '".$Datos->fine."', ".$Datos->id.", '".$status."', '".$fecha."' ) ";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	// dd($qBuilder);

	$u1 = "UPDATE seg_tiempoperdido SET cve_maq = ".$Datos->maquinae." WHERE cve_tp = ".$Datos->cve." ";
	$qu1 = $dbcon->qBuilder($conn, 'do', $u1);
	// dd($u1);

	$u2 = "UPDATE seg_tiempoperdido SET cve_fallo = ".$Datos->falloe." WHERE cve_tp = ".$Datos->cve." ";
	$qu2 = $dbcon->qBuilder($conn, 'do', $u2);
	// dd($u2);

	$u3 = "UPDATE seg_tiempoperdido SET motivo_fallo = '".$Datos->motivoe."' WHERE cve_tp = ".$Datos->cve." ";
	$qu3 = $dbcon->qBuilder($conn, 'do', $u3);
	// dd($u3);

	$u4 = "UPDATE seg_tiempoperdido SET hora_inicio = '".$Datos->inicioe."' WHERE cve_tp = ".$Datos->cve." ";
	$qu4 = $dbcon->qBuilder($conn, 'do', $u4);
	// dd($u4);

	$u5 = "UPDATE seg_tiempoperdido SET hora_fin = '".$Datos->fine."' WHERE cve_tp = ".$Datos->cve." ";
	$qu5 = $dbcon->qBuilder($conn, 'do', $u5);
	// dd($u5);
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
	case 'guardarTiempoPerdido':
		guardarTiempoPerdido($dbcon, $objDatos);
		break;
	case 'EliminarTPerdido':
		EliminarTPerdido($dbcon, $objDatos);
		break;
	case 'EditarTPerdido':
		EditarTPerdido($dbcon, $objDatos);
		break;
}

?>
