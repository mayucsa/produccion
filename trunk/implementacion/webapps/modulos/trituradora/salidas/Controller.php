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
	$sql = "SELECT CFOLIO, ad.CIDDOCUMENTO, CRAZONSOCIAL, CTEXTOEXTRA2, CIDPRODUCTO, CNOMBREPRODUCTO, CVALORCLASIFICACION, CUNIDADESCAPTURADASO, CUNIDADESCAPTURADAS, CUNIDADMEDIDA, SERVOBSERVAMOV, ESTATUS_DOCUMENTO 
			FROM admDocumentos_detalle add2
			INNER JOIN admDocumentos ad ON ad.CIDDOCUMENTO = add2.CIDDOCUMENTO 
			WHERE CVALORCLASIFICACION = 'AGREGADOS' AND CFOLIO = ".$folio;
	$detalle = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	// foreach ($detalle as $i => $val) {
	// 	$sql = "SELECT sum(cantidad_entrada) cantidad_entrada FROM movtos_entradas_detalle mvd INNER JOIN movtos_entradas mv ON mv.cve_mov = mvd.cve_mov WHERE mv.cve_odc = ".$folio." AND cve_articulo = ".$val->cve_art;
	// 	$cantidad_entrada = $dbcon->qBuilder($dbcon->conn(), 'first', $sql);
	// 	$val->cantidad_cotizada = floatval($val->cantidad_cotizada) - floatval($cantidad_entrada->cantidad_entrada);
	// }
	dd($detalle);
}
function verificarFolio($dbcon, $Datos){
	$clasificacion = 'AGREGADOS';
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();
	$sql = "UPDATE admDocumentos_detalle SET ESTATUS_DOCUMENTO = 3, FECHA_VERIFICACION = '".$fecha."', FECHA_ENTRADA = '".$fecha."' WHERE CIDDOCUMENTO = ".$Datos->documento." AND CVALORCLASIFICACION = '".$clasificacion."'";
	$detalle = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);
	dd($detalle);

	$ssql = "UPDATE admDocumentos_detalle SET FECHA_ENTRADA = '".$fecha."' WHERE CIDDOCUMENTO = ".$Datos->documento." AND CVALORCLASIFICACION = '".$clasificacion."' ";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $ssql);
	dd($ssql);

}
function despacharProducto($dbcon, $Datos){
	$firma = str_replace('data:image/png;base64,', '', $Datos->firma);
	$clasificacion = 'AGREGADOS';
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();
	$sql = "UPDATE admDocumentos_detalle SET ESTATUS_DOCUMENTO = 4, FECHA_SURTIDO = '".$fecha."' WHERE CIDDOCUMENTO = '".$Datos->documento."' AND CVALORCLASIFICACION = '".$clasificacion."' ";
	if(!$dbcon->qBuilder($conn, 'do', $sql)){
		dd([
			'code' => 400,
			'msj' => 'Error al actualizar datos detalle',
			'sql' => $sql
		]);
	}
	$datos = $Datos->datos;
	foreach ($datos as $i => $val) {
		$sql = "INSERT INTO seg_salidas_trituradora(CFOLIO, cod_producto, CUNIDADESCAPTURADAS, cantidad_salida, usuario, estatus_salida, fecha_registro, firma) VALUES(
			'".$val->CFOLIO."',
			'".$val->CIDPRODUCTO."',
			'".$val->CUNIDADESCAPTURADAS."',
			'".$val->CUNIDADESCAPTURADAS."',
			'".$_SESSION['id']."',
			1,
			'".$fecha."',
			'".$firma."'
		)";
		if(!$dbcon->qBuilder($conn, 'do', $sql)){
			dd([
				'code' => 400,
				'msj' => 'Error al insertar datos salidas',
				'sql' => $sql
			]);
		}
	}
	dd([
		'code' => 200,
		'msj' => 'ok'
	]);

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
	case 'validaFolio':
		validaFolio($dbcon, $objDatos->folio);
		break;
	case 'verificarFolio':
		verificarFolio($dbcon, $objDatos);
		break;
	case 'despacharProducto':
		despacharProducto($dbcon, $objDatos);
		break;
}

 ?>