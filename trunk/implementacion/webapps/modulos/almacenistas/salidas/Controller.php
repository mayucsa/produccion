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
	foreach ($detalle as $key => $value) {
		$value->cantidad_salida = $value->CUNIDADESCAPTURADAS;
	}
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
	if (!$seg_cantestiba) {
		dd([
			'cantidad' => false,
			'msj' => 'Estiba inexistente.'
		]);
	}
	if (floatval($cantidad) > floatval($seg_cantestiba->cantidad_estiba)) {
		dd([
			'cantidad' => $seg_cantestiba->cantidad_estiba,
			'msj' => 'Cantidad mayor a la existencia. Esta estiba sólo cuenta con '.$seg_cantestiba->cantidad_estiba.' unidades.'
		]);
	}else{
		dd([
			'cantidad' => $cantidad,
			'msj' => 'ok'
		]);
	}
}
function despacharProducto($dbcon, $datos, $folio){
	$fecha = date('Y-m-d H:i:s');
	$completo = count($datos);
	// Actualizar cantidad_estiba
	foreach ($datos as $i => $val) {
		$sql = "UPDATE seg_inventario_estibas 
		SET cantidad_estiba = cantidad_estiba - ".$val->cantidad_salida."
		WHERE numero_estiba = ".$val->estiba." AND nombre_producto = (SELECT cve_bloquera FROM seg_producto_bloquera WHERE cod_producto = '".$val->CIDPRODUCTO."')";
		if (!$dbcon->qBuilder($dbcon->conn(), 'do', $sql)) {
			dd([
				'code' => 400,
				'msj' => 'Error al actualizar cantidad_estiba',
				'sql' => $sql
			]);
		}
		$sql = "UPDATE seg_inventario_patios 
		SET cantidad_inventario = cantidad_inventario - ".$val->cantidad_salida."
		WHERE cve_bloquera = (SELECT cve_bloquera FROM seg_producto_bloquera WHERE cod_producto = '".$val->CIDPRODUCTO."') ";
		if (!$dbcon->qBuilder($dbcon->conn(), 'do', $sql)) {
			dd([
				'code' => 400,
				'msj' => 'Error al actualizar cantidad_inventario',
				'sql' => $sql
			]);
		}
		// Insertar salidas
		$sql = "INSERT INTO seg_salidas_bloquera
		(CFOLIO, cod_producto, numero_estiba, CUNIDADESCAPTURADAS, cantidad_salida, usuario, estatus_salida, fecha_registro)
		VALUES(
			".$folio.", '".$val->CIDPRODUCTO."', ".$val->estiba.", ".$val->CUNIDADESCAPTURADAS.",
			".$val->cantidad_salida.", ".$_SESSION['id'].", 1, '".$fecha."'
		)";
		if (!$dbcon->qBuilder($dbcon->conn(), 'do', $sql)) {
			dd([
				'code' => 400,
				'msj' => 'Error al insertar datos salidas',
				'sql' => $sql
			]);
		}
		if ($val->cantidad_salida < $val->CUNIDADESCAPTURADAS) {
			// revisar para actualizar o no el status documento
		}
	}
	$sql = "UPDATE admDocumentos_detalle 
	SET ESTATUS_DOCUMENTO = 4, FECHA_SURTIDO = '".$fecha."'
	WHERE CIDDOCUMENTO = (SELECT CIDDOCUMENTO FROM admDocumentos WHERE CFOLIO = ".$folio.")
	AND CVALORCLASIFICACION = 'BLOQUERA' ";
	if (!$dbcon->qBuilder($dbcon->conn(), 'do', $sql)) {
		dd([
			'code' => 400,
			'msj' => 'Error al actualizar estatus_documento y fecha_surtido',
			'sql' => $sql
		]);
	}
	// ok
	dd([
		'code' => 200,
		'msj' => 'Se ha generado el despacho de producto con éxito.'
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
	case 'validaExistencia':
		validaExistencia($dbcon, $objDatos->estiba, $objDatos->idproducto, $objDatos->cantidad);
		break;
	case 'despacharProducto':
		despacharProducto($dbcon, $objDatos->datos, $objDatos->folio);
		break;
}

 ?>