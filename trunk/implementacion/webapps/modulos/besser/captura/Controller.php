<?php
session_start();
date_default_timezone_set('America/Mexico_City');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}
function guardarProduccion($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$vacio = 'vacio';
	$status = 'VIG';
	$celda = '1';
	$conn = $dbcon->conn();
	$sql = "INSERT INTO captura_produccionbloquera (cve_bloquera, cantidad_barcadas, bandejas_producidas, cementopor_barcada, consumo_aditivo, cant_pesadas, tiempo_llenado, humedad, peso_promedio, horometro_inicial, horometro_final, horometro_diferencia, cantidad_polvo, segundos_polvo, porcent_polvo, cantidad_gravilla, segundos_gravilla, porcent_gravilla, cantidad_gravillados, segundos_gravillados, porcent_gravillados, piezas_totales, consumototal_cemento, cementopor_pieza, usuario, estatus_registro, fecha_registro)	VALUES (".$Datos->producto.", ".$Datos->barcadas.", ".$Datos->bandejas.", ".$Datos->cemento.", ".$Datos->aditivo.", ".$Datos->pesadas.", ".$Datos->llenado.", ".$Datos->humedad.", ".$Datos->pesopromedio.", ".$Datos->hinicial.", ".$Datos->hfinal.", ".$Datos->hdiferencia.", ".$Datos->polvo.", ".$Datos->segundospolvo.", '".$Datos->porcentajepolvo."', ".$Datos->gravilla.", ".$Datos->segundosgravilla.", '".$Datos->porcentajegravilla."', ".$Datos->gravillados.", ".$Datos->segundosgravillados.", '".$Datos->porcentajegravillados."', ".$Datos->piezastotal.", ".$Datos->cementototal.", ".$Datos->cementopieza.", ".$Datos->id.", '".$status."', '".$fecha."' )";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
		// dd($sql);
	if ($qBuilder) {
		$getId = "SELECT max(cve_produccion_bloquera) cve_produccion_bloquera FROM captura_produccionbloquera WHERE
		fecha_registro = '".$fecha."'
		AND usuario = ".$Datos->id."
		AND estatus_registro =  '".$status."'
		AND cantidad_barcadas = ".$Datos->barcadas."
		AND bandejas_producidas = ".$Datos->bandejas."
		AND cant_pesadas = ".$Datos->pesadas."
		AND horometro_inicial = ".$Datos->hinicial."
		AND horometro_final = ".$Datos->hfinal." ";

		$sqlu = "UPDATE seg_producto_bloquera SET cantidad = cantidad + ".$Datos->piezastotal." WHERE cve_bloquera = ".$Datos->producto." ";
		$q2Builder = $dbcon->qBuilder($conn, 'do', $sqlu);
		// dd($sqlu);
		$sqlcemento = "UPDATE seg_mp_bloquera SET cantidad_materia_prima = cantidad_materia_prima - ".$Datos->cementototal." WHERE cve_mp = 1 ";
		$q3Builder = $dbcon->qBuilder($conn, 'do', $sqlcemento);
		// dd($sqlcemento);
		$sqladitivo = "UPDATE seg_mp_bloquera SET cantidad_materia_prima = cantidad_materia_prima - ".$Datos->aditivo." WHERE cve_mp = 2 ";
		$q4Builder = $dbcon->qBuilder($conn, 'do', $sqladitivo);
		// dd($sqladitivo);

		$getId = $dbcon->qBuilder($conn, 'first', $getId);
		dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getId->cve_produccion_bloquera]);

	}else{
		dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
	}
}
function eliminar($dbcon){
	$cve_produccion_bloquera = $_REQUEST['id'];
	$fecha = date('Y-m-d H:i:s');
	$sql = "UPDATE captura_produccionbloquera SET 
		estatus_registro = 'DELET',
		eliminado_por = ".$_SESSION['id'].",
		fecha_eliminado = '".$fecha."'
	WHERE cve_produccion_bloquera = ".$cve_produccion_bloquera;
	if (!$dbcon->qBuilder($dbcon->conn(), 'do', $sql)) {
		dd(['code'=>400, 'msj'=>'Error al actualizar tabla', 'sql'=>$sql]);
	}
	$sql = "SELECT cve_bloquera, piezas_totales, consumototal_cemento, consumo_aditivo FROM captura_produccionbloquera WHERE cve_produccion_bloquera = ".$cve_produccion_bloquera;
	$Datos = $dbcon->qBuilder($dbcon->conn(), 'first', $sql);

	$sqlu = "UPDATE seg_producto_bloquera SET cantidad = cantidad - ".floatval($Datos->piezas_totales)." WHERE cve_bloquera = ".$Datos->cve_bloquera." ";
	if (!$dbcon->qBuilder($dbcon->conn(), 'do', $sqlu)) {
		dd(['code'=>400, 'msj'=>'Error al actualizar cantidad de piezas.', 'sql'=>$sqlu]);
	}
	$sqlcemento = "UPDATE seg_mp_bloquera SET cantidad_materia_prima = cantidad_materia_prima + ".floatval($Datos->consumototal_cemento)." WHERE cve_mp = 1 ";
	if(!$dbcon->qBuilder($dbcon->conn(), 'do', $sqlcemento)){
		dd(['code'=>400, 'msj'=>'Error al actualizar cantidad de cemento.', 'sql'=>$sqlcemento]);
	}
	$sqladitivo = "UPDATE seg_mp_bloquera SET cantidad_materia_prima = cantidad_materia_prima + ".floatval($Datos->consumo_aditivo)." WHERE cve_mp = 2 ";
	if(!$dbcon->qBuilder($dbcon->conn(), 'do', $sqladitivo)){
		dd(['code'=>400, 'msj'=>'Error al actualizar cantidad de aditivo.', 'sql'=>$sqladitivo]);
	}
	dd(['code'=>200]);
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
switch ($tarea) {
	case 'guardarProduccion':
		guardarProduccion($dbcon, $objDatos);
		break;
	case 'eliminar':
		eliminar($dbcon);
		break;
}
?>
