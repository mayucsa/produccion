<?php
date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}

function productofinalizado($dbcon){
	$sql = " 	SELECT cod_producto, nombre_producto, cantidad, cantidad/1000 as tonelada, cantidad/presentacion as saco, unidad_medida 
				FROM seg_producto_morteros spm 
				WHERE estatus_producto = 'VIG'
				ORDER BY nombre_producto DESC ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}
function materiaprima($dbcon){
	$sql = " 	SELECT cod_materiaprima, nombre_materiaprima, cantidad_materiaprima, unidad_medida 
				FROM seg_materiaprima_morteros smm 
				WHERE estatus_materiaprima = 'VIG' ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}
function saqueria($dbcon){
	$sql = " 	SELECT cod_saco, nombre_saco, cantidad, unidad_medida
				FROM seg_sacos_morteros ssm 
				WHERE estatus_saco = 'VIG' ";
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
	case 'productofinalizado':
		productofinalizado($dbcon, $objDatos);
		break;
	case 'materiaprima':
		materiaprima($dbcon, $objDatos);
		break;
	case 'saqueria':
		saqueria($dbcon, $objDatos);
		break;
}
?>
