<?php
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}
function setmPrima($dbcon, $cve_producto, $cve_materia_prima){
	$sql = "INSERT INTO seg_mprimapor_producto (cve_producto, cve_materia_prima, cantidad, estatus, fecha_registro) VALUES (
		".$cve_producto.",
		".$cve_materia_prima.",
		1,
		'VIG',
		'".date('Y-m-d')."'
	)";
	if ($dbcon->qBuilder($dbcon->conn(), 'do', $sql)) {
		dd(true);
	}else{
		dd($sql);
	}
}
function getLengthMPrima($dbcon, $cve_producto){
	$sql = "SELECT count(*) as longitud FROM seg_mprimapor_producto WHERE cve_producto = ".$cve_producto;
	dd($dbcon->qBuilder($dbcon->conn(), 'first', $sql));
}
function getmPrimaCat($dbcon, $mprima, $cve_producto){
	$sql = "SELECT * FROM cat_materia_prima cmp WHERE cmp.estatus_materia_prima = 'VIG' 
	AND cmp.nombre_materia_prima LIKE '%".$mprima."%'
	AND cmp.cve_materia_prima NOT IN (
		SELECT cve_materia_prima FROM seg_mprimapor_producto WHERE cve_producto = ".$cve_producto."
	)
	ORDER BY cmp.nombre_materia_prima";
	dd($dbcon->qBuilder($dbcon->conn(), 'all', $sql));
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
	case 'getmPrimaCat':
		getmPrimaCat($dbcon, $objDatos->mprima, $objDatos->cve_producto);
		break;
	case 'getLengthMPrima':
		getLengthMPrima($dbcon, $objDatos->cve_producto);
		break;
	case 'setmPrima':
		setmPrima($dbcon, $objDatos->cve_producto, $objDatos->cve_materia_prima);
		break;
}
?>
