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
function validaFolio($dbcon, $folio){
	$sql = "SELECT CFOLIO, ad.CIDDOCUMENTO, CRAZONSOCIAL, CTEXTOEXTRA2, CIDPRODUCTO, CNOMBREPRODUCTO, CVALORCLASIFICACION, CUNIDADESCAPTURADASO, CUNIDADESCAPTURADAS,CUNIDADMEDIDA, SERVOBSERVAMOV, ESTATUS_DOCUMENTO 
			FROM admDocumentos_detalle add2
			INNER JOIN admDocumentos ad ON ad.CIDDOCUMENTO = add2.CIDDOCUMENTO 
			WHERE CFOLIO = ".$folio." AND ESTATUS_DOCUMENTO >= 1 ";
	$detalle = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	// foreach ($detalle as $i => $val) {
	// 	$sql = "SELECT sum(cantidad_entrada) cantidad_entrada FROM movtos_entradas_detalle mvd INNER JOIN movtos_entradas mv ON mv.cve_mov = mvd.cve_mov WHERE mv.cve_odc = ".$folio." AND cve_articulo = ".$val->cve_art;
	// 	$cantidad_entrada = $dbcon->qBuilder($dbcon->conn(), 'first', $sql);
	// 	$val->cantidad_cotizada = floatval($val->cantidad_cotizada) - floatval($cantidad_entrada->cantidad_entrada);
	// }
	dd($detalle);
}
function entradaFolio($dbcon, $folio){
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();

	$cBuilder = "SELECT CIDDOCUMENTO FROM admDocumentos WHERE CFOLIO = ".$folio;
	$cBuilder = $dbcon->qBuilder($conn, 'first', $cBuilder);
	// dd($cBuilder);

	$sql = "UPDATE admDocumentos_detalle SET ESTATUS_DOCUMENTO = 2, FECHA_ENTRADA = '".$fecha."' WHERE CIDDOCUMENTO = ".$cBuilder->CIDDOCUMENTO."";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	dd($sql);
}
function salidaFolio($dbcon, $folio){
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();

	$cBuilder = "SELECT CIDDOCUMENTO FROM admDocumentos WHERE CFOLIO = ".$folio;
	$cBuilder = $dbcon->qBuilder($conn, 'first', $cBuilder);
	// dd($cBuilder);

	$sql = "UPDATE admDocumentos_detalle SET ESTATUS_DOCUMENTO = 5, FECHA_SALIDA = '".$fecha."' WHERE CIDDOCUMENTO = ".$cBuilder->CIDDOCUMENTO." ";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	dd($sql);
}
function ssMovtos($dbcon){
	$sql = "SELECT ad.CFOLIO as folio, ad.CRAZONSOCIAL as cliente, ad.CTEXTOEXTRA2 as chofer, add2.FECHA_ENTRADA as entrada, add2.FECHA_SALIDA as salida
	FROM admDocumentos_detalle add2
    INNER JOIN admDocumentos ad ON ad.CIDDOCUMENTO = add2.CIDDOCUMENTO
    WHERE FECHA_ENTRADA >= 2 
    GROUP BY CFOLIO
    LIMIT 1000 ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}
function verificarFolio($dbcon, $Datos){
	$clasificacion = 'BLOQUERA';
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();
	$sql = "UPDATE admDocumentos_detalle SET ESTATUS_DOCUMENTO = 5, FECHA_SALIDA = '".$fecha."' WHERE CIDDOCUMENTO = ".$Datos->documento." ";
	$detalle = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);
	dd($detalle);
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
	case 'validaFolio':
		validaFolio($dbcon, $objDatos->folio);
		break;
	case 'entradaFolio':
		entradaFolio($dbcon, $objDatos->folio);
		break;
	case 'salidaFolio':
		salidaFolio($dbcon, $objDatos->folio);
		break;
	case 'verificarFolio':
		verificarFolio($dbcon, $objDatos);
		break;
}
?>
