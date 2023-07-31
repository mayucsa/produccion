<?php
session_start();
date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}
function produccionBloquerasFecha($dbcon, $objDatos){
	$fechaIni = $objDatos->fechaIni;
	$fechaFin = $objDatos->fechaFin;
	$sql = "SELECT cp.cve_bloquera, spb.area, CONCAT(spb.nombre_producto, ' - ', spb.presentacion, ' - ', spb.num_celdas, ' Celdas') AS producto, SUM(cp.piezas_totales) AS total
			FROM captura_produccionbloquera cp
			INNER JOIN seg_producto_bloquera spb ON spb.cve_bloquera = cp.cve_bloquera 
			WHERE estatus_registro = 'vig' 
			AND cp.fecha_registro between '".$fechaIni."' AND '".$fechaFin."' 
			GROUP BY cp.cve_bloquera";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}
function produccionBloqueras($dbcon){
	$sql = "SELECT cp.cve_bloquera, spb.area, CONCAT(spb.nombre_producto, ' - ', spb.presentacion, ' - ', spb.num_celdas, ' Celdas') AS producto, SUM(cp.piezas_totales) AS total
			FROM captura_produccionbloquera cp
			INNER JOIN seg_producto_bloquera spb ON spb.cve_bloquera = cp.cve_bloquera 
			WHERE estatus_registro = 'vig'
			GROUP BY cp.cve_bloquera";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
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
switch ($tarea) {
	case 'produccionBloqueras':
		produccionBloqueras($dbcon);
		break;
	case 'produccionBloquerasFecha':
		produccionBloquerasFecha($dbcon, $objDatos);
		break;
}
?>
