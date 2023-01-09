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
function ssMovtos($dbcon){
	$sql = "SELECT ad.CFOLIO as folio, ad.CRAZONSOCIAL as cliente, ad.CTEXTOEXTRA2 as chofer, add2.FECHA_ENTRADA as entrada, add2.FECHA_SALIDA as salida
	FROM admDocumentos_detalle add2
    INNER JOIN admDocumentos ad ON ad.CIDDOCUMENTO = add2.CIDDOCUMENTO";
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
	case 'ssMovtos':
		ssMovtos($dbcon);
		break;
}
?>
