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
function ssConfirmacionsDesalojo($dbcon){
	$sql = "SELECT cve_desalojo, area, nombre_producto, presentacion, num_celdas, cantidad_total, cantidad_despuntados, cantidad_rotura, nombre, apellido, sd.fecha_registro, '' Turno 
	FROM seg_desalojo sd 
    INNER JOIN seg_producto_bloquera spb ON spb.cve_bloquera = sd.cve_bloquera
	INNER JOIN cat_usuarios cu ON cu.cve_usuario = sd.usuario
    WHERE estatus_desalojo = 'VIG' AND confirmado = 1
    ORDER BY area DESC";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    foreach ($datos as $i => $row) {
    	// $row->Diferencia = getDifHoras($row->hora_inicio, $row->hora_fin);
    	$row->Turno = getTurno($row->fecha_registro);
    }
    dd($datos);
}
function getTurno($hora){
	$hora = explode(' ', $hora);
	if (isset($hora[1])) {
		$hora = $hora[1];
	}else{
		$hora = '00:00:00';
	}
	if ($hora >=  '23:00:01' && $hora <= '23:59:59'){
        return '3er Turno';
    }
	if ($hora >=  '00:00:01' && $hora <= '06:59:59'){
        return '3er Turno';
    } 
    if ($hora >=  '07:00:00' && $hora <= '15:00:00'){
        return '1er Turno';
    } 
    if ($hora >=  '15:00:01' && $hora <= '23:00:00'){
         return '2do Turno';
    }
    return 'Sin Turno';
}
function generarEstiba($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$vacio = 'vacio';
	$status = 'VIG';
	$celda = '1';
	$conn = $dbcon->conn();

	$cBuilder = "SELECT cve_bloquera, cantidad_total, cantidad_despuntados, cantidad_rotura FROM seg_desalojo WHERE cve_desalojo = ".$Datos->folio;
	$cBuilder = $dbcon->qBuilder($conn, 'first', $cBuilder);
	// dd($cBuilder);

	$sql = "UPDATE seg_desalojo SET confirmado = 2, confirmado_por = ".$Datos->id." WHERE cve_desalojo = ".$Datos->folio." ";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	// dd($sql);

	$sqlu = "UPDATE seg_inventario_patios SET cantidad_inventario = cantidad_inventario + ".$cBuilder->cantidad_total." WHERE cve_bloquera = ".$cBuilder->cve_bloquera." ";
	// $sqlu = "UPDATE seg_inventario_patios SET cantidad_inventario = cantidad_inventario + ".$cBuilder->cantidad_total." + ".$cBuilder->cantidad_despuntados." + ".$cBuilder->cantidad_rotura." WHERE cve_bloquera = ".$cBuilder->cve_bloquera." ";
	$uBuilder = $dbcon->qBuilder($conn, 'do', $sqlu);
	// dd($sqlu);

	$sqlestiba = "UPDATE seg_inventario_estibas SET cantidad_estiba = cantidad_estiba + ".$cBuilder->cantidad_total." WHERE numero_estiba = ".$Datos->estiba." ";
	$estibaBuilder = $dbcon->qBuilder($conn, 'do', $sqlestiba);
	// dd($sqlestiba);

	$sqldes = "UPDATE seg_despuntados SET cantidad_despuntados = cantidad_despuntados  + ".$cBuilder->cantidad_despuntados." WHERE cve_despuntados = ".$cBuilder->cve_bloquera." ";
	$uBuilder = $dbcon->qBuilder($conn, 'do', $sqldes);
	// dd($sqldes);
}
function editar($dbcon, $Datos){
	$status = 'VIG';
	$modulodesalojo = 'Almacenistas-desalojo';
	$modulodespuntado = 'Almacenistas-despuntado';
	$modulorotura = 'Almacenistas-rotura';
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();
	$cBuilder = "SELECT cve_bloquera, cantidad_total, cantidad_despuntados, cantidad_rotura FROM seg_desalojo WHERE cve_desalojo = ".$Datos->folio;
	$cBuilder = $dbcon->qBuilder($conn, 'first', $cBuilder);
	// dd($cBuilder);

	$ctrl ="INSERT INTO ctrl_edit_bloqueras(cve_, modulo, cant_anterior, cant_nuevo, usuario, estatus_edit, fecha_registro)
			VALUES(".$Datos->folio.", '".$modulodesalojo."', ".$cBuilder->cantidad_total.", ".$Datos->desalojoe.", ".$Datos->id.",  '".$status."', '".$fecha."' ); ";
	$ctrlBuilder = $dbcon->qBuilder($dbcon->conn(), 'do', $ctrl);
	// dd($ctrl);

	$ctrl2 ="INSERT INTO ctrl_edit_bloqueras(cve_, modulo, cant_anterior, cant_nuevo, usuario, estatus_edit, fecha_registro)
			VALUES(".$Datos->folio.", '".$modulodespuntado."', ".$cBuilder->cantidad_despuntados.", ".$Datos->despuntadoe.", ".$Datos->id.",  '".$status."', '".$fecha."' ); ";
	$ctrlBuilder2 = $dbcon->qBuilder($dbcon->conn(), 'do', $ctrl2);
	// dd($ctrl2);

	$ctrl3 ="INSERT INTO ctrl_edit_bloqueras(cve_, modulo, cant_anterior, cant_nuevo, usuario, estatus_edit, fecha_registro)
			VALUES(".$Datos->folio.", '".$modulorotura."', ".$cBuilder->cantidad_rotura.", ".$Datos->roturae.", ".$Datos->id.",  '".$status."', '".$fecha."' ); ";
	$ctrlBuilder3 = $dbcon->qBuilder($dbcon->conn(), 'do', $ctrl3);
	// dd($ctrl3);

	$sqlu = "UPDATE seg_desalojo SET cantidad_total =  ".$Datos->desalojoe.", cantidad_despuntados = ".$Datos->despuntadoe.", cantidad_rotura = ".$Datos->roturae." WHERE cve_desalojo = ".$Datos->folio." ";
	$uBuilder = $dbcon->qBuilder($dbcon->conn(), 'do', $sqlu);
	// dd($sqlu);

	$sqlctrl = "UPDATE seg_producto_bloquera SET cantidad = cantidad + ".$cBuilder->cantidad_total." + ".$cBuilder->cantidad_despuntados." + ".$cBuilder->cantidad_rotura." - ".$Datos->desalojoe." - ".$Datos->despuntadoe." - ".$Datos->roturae."	WHERE cve_bloquera = ".$cBuilder->cve_bloquera." ";
	$uBuilder = $dbcon->qBuilder($dbcon->conn(), 'do', $sqlctrl);
	// dd($sqlctrl);
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
	case 'generarEstiba':
		generarEstiba($dbcon, $objDatos);
		break;
	case 'ssConfirmacionsDesalojo':
		ssConfirmacionsDesalojo($dbcon);
		break;
	case 'validaExistencia':
		validaExistencia($dbcon, $objDatos->producto, $objDatos->cantidad);
		break;
	case 'editar':
		editar($dbcon, $objDatos);
		break;
}
?>
