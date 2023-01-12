<?php 
date_default_timezone_set('America/Mexico_City');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}
function validaFolio($dbcon, $folio){
	$sql = "SELECT CFOLIO, ad.CIDDOCUMENTO, CRAZONSOCIAL, CTEXTOEXTRA2, CIDPRODUCTO, CNOMBREPRODUCTO, CVALORCLASIFICACION, CUNIDADESCAPTURADAS, ESTATUS_DOCUMENTO 
			FROM admDocumentos_detalle add2
			INNER JOIN admDocumentos ad ON ad.CIDDOCUMENTO = add2.CIDDOCUMENTO 
			WHERE CVALORCLASIFICACION = 'BLOQUERA' AND CFOLIO = ".$folio;
	$detalle = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	// foreach ($detalle as $i => $val) {
	// 	$sql = "SELECT sum(cantidad_entrada) cantidad_entrada FROM movtos_entradas_detalle mvd INNER JOIN movtos_entradas mv ON mv.cve_mov = mvd.cve_mov WHERE mv.cve_odc = ".$folio." AND cve_articulo = ".$val->cve_art;
	// 	$cantidad_entrada = $dbcon->qBuilder($dbcon->conn(), 'first', $sql);
	// 	$val->cantidad_cotizada = floatval($val->cantidad_cotizada) - floatval($cantidad_entrada->cantidad_entrada);
	// }
	dd($detalle);
}
function verificarFolio($dbcon, $Datos){
	$clasificacion = 'BLOQUERA';
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();
	$sql = "UPDATE admDocumentos_detalle SET ESTATUS_DOCUMENTO = 3, FECHA_VERIFICACION = '".$fecha."' WHERE CIDDOCUMENTO = ".$Datos->documento." AND CVALORCLASIFICACION = '".$clasificacion."'";
	$detalle = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);
	dd($detalle);
}
function validaExistencia($dbcon, $estiba, $idproducto, $cantidad){
	// $cve_mp = 0;
	// switch ($tipo) {
	// 	case 'aditivo':
	// 		$cve_mp = 2;
	// 		break;
	// 	case 'cemento':
	// 		$cve_mp = 1;
	// 		break;
	// }
	$sql = "SELECT sie.nombre_producto, spb.nombre_producto, spb.presentacion, spb.num_celdas, numero_estiba, cantidad_estiba
			 FROM seg_inventario_estibas sie
			 INNER JOIN seg_producto_bloquera spb ON spb.cve_bloquera = sie.nombre_producto
			 WHERE numero_estiba = ".$estiba." AND spb.cod_producto = '".$idproducto."' ";
	$seg_cantestiba = $dbcon->qBuilder($dbcon->conn(), 'first', $sql);
	if (floatval($cantidad) > floatval($seg_cantestiba->cantidad_estiba)) {
		dd([
			'cantidad' => $seg_cantestiba->cantidad_estiba,
			'msj' => 'Cantidad mayor a la existencia'
		]);
	}else{
		dd([
			'cantidad' => $cantidad,
			'msj' => 'ok'
		]);
	}
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
	case 'validaExistencia':
		validaExistencia($dbcon, $objDatos->estiba, $objDatos->idproducto, $objDatos->cantidad);
		break;
}

 ?>