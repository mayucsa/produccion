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
function validaFolio($dbcon, $folio){
	$sql = "SELECT CFOLIO, ad.CIDDOCUMENTO, CRAZONSOCIAL, CTEXTOEXTRA2, CIDPRODUCTO, CNOMBREPRODUCTO, CVALORCLASIFICACION, CUNIDADESCAPTURADASO, CUNIDADESCAPTURADAS, CUNIDADMEDIDA, SERVOBSERVAMOV, ESTATUS_DOCUMENTO 
			FROM admDocumentos_detalle add2
			INNER JOIN admDocumentos ad ON ad.CIDDOCUMENTO = add2.CIDDOCUMENTO 
			WHERE CVALORCLASIFICACION IN ('MORTERO','IMPERMAT') AND CFOLIO = ".$folio." ORDER BY ESTATUS_DOCUMENTO ASC";
	$detalle = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	// foreach ($detalle as $i => $val) {
	// 	$sql = "SELECT sum(cantidad_entrada) cantidad_entrada FROM movtos_entradas_detalle mvd INNER JOIN movtos_entradas mv ON mv.cve_mov = mvd.cve_mov WHERE mv.cve_odc = ".$folio." AND cve_articulo = ".$val->cve_art;
	// 	$cantidad_entrada = $dbcon->qBuilder($dbcon->conn(), 'first', $sql);
	// 	$val->cantidad_cotizada = floatval($val->cantidad_cotizada) - floatval($cantidad_entrada->cantidad_entrada);
	// }
	// foreach ($detalle as $key => $value) {
	// 	$value->cantidad_salida = $value->CUNIDADESCAPTURADAS;
	// }
	dd($detalle);
}
function verificarFolio($dbcon, $Datos){
	$clasificacion = 'MORTERO';
	$clasificacioni = 'IMPERMAT';
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();
	$sql = "UPDATE admDocumentos_detalle SET ESTATUS_DOCUMENTO = 3, FECHA_VERIFICACION = '".$fecha."', FECHA_ENTRADA = '".$fecha."' WHERE CIDDOCUMENTO = ".$Datos->documento." AND CVALORCLASIFICACION IN ( '".$clasificacion."', '".$clasificacioni."') ";
	$detalle = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);
	dd($sql);
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
function despacharProducto($dbcon, $datos, $folio, $firma){
	$firma = str_replace('data:image/png;base64,', '', $firma);
	$clasificacion = 'MORTERO';
	$clasificacioni = 'IMPERMAT';
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();

	$select = "SELECT CIDDOCUMENTO FROM admDocumentos WHERE CFOLIO = ".$folio." ";
	$select = $dbcon->qBuilder($conn, 'first', $select);
	
	$sql = "UPDATE admDocumentos_detalle SET ESTATUS_DOCUMENTO = 4, FECHA_SURTIDO = '".$fecha."' WHERE CIDDOCUMENTO = ".$select->CIDDOCUMENTO." AND CVALORCLASIFICACION IN ('".$clasificacion."', '".$clasificacioni."') ";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	// dd($sql);

	foreach ($datos as $i => $val) {
		if ($val->CIDPRODUCTO == 'M511' || $val->CIDPRODUCTO == 'M512' || $val->CIDPRODUCTO == 'M513' || $val->CIDPRODUCTO == 'M514' || $val->CIDPRODUCTO == 'M515' || $val->CIDPRODUCTO == 'M517' || $val->CIDPRODUCTO == 'M518' || $val->CIDPRODUCTO == 'M600' || $val->CIDPRODUCTO == 'M601' || $val->CIDPRODUCTO == 'M602' || $val->CIDPRODUCTO == 'M603' || $val->CIDPRODUCTO == 'M604' || $val->CIDPRODUCTO == 'M605') {
			$val->CIDPRODUCTO = 'M510';
		}
		if ($val->CIDPRODUCTO == 'M606' || $val->CIDPRODUCTO == 'M598') {
			$val->CIDPRODUCTO = 'M516';
		}
		if ($val->CIDPRODUCTO == 'M521' || $val->CIDPRODUCTO == 'M522' || $val->CIDPRODUCTO == 'M523' || $val->CIDPRODUCTO == 'M524' || $val->CIDPRODUCTO == 'M525' || $val->CIDPRODUCTO == 'M526' || $val->CIDPRODUCTO == 'M620' || $val->CIDPRODUCTO == 'M621' || $val->CIDPRODUCTO == 'M622' || $val->CIDPRODUCTO == 'M623') {
			$val->CIDPRODUCTO = 'M520';
		}
		if ($val->CIDPRODUCTO == 'M626') {
			$val->CIDPRODUCTO = 'M599';
		}
		if ($val->CIDPRODUCTO == 'M531' || $val->CIDPRODUCTO == 'M532' || $val->CIDPRODUCTO == 'M533' || $val->CIDPRODUCTO == 'M534' || $val->CIDPRODUCTO == 'M535' || $val->CIDPRODUCTO == 'M630' || $val->CIDPRODUCTO == 'M631' || $val->CIDPRODUCTO == 'M632' || $val->CIDPRODUCTO == 'M633' || $val->CIDPRODUCTO == 'M634' || $val->CIDPRODUCTO == 'M635') {
			$val->CIDPRODUCTO = 'M530';
		}
		if ($val->CIDPRODUCTO == 'M584' || $val->CIDPRODUCTO == 'M591') {
			$val->CIDPRODUCTO = 'M586';
		}
		if ($val->CIDPRODUCTO == 'M638') {
			$val->CIDPRODUCTO = 'M596';
		}
		if ($val->CIDPRODUCTO == 'M541' || $val->CIDPRODUCTO == 'M542' || $val->CIDPRODUCTO == 'M543' || $val->CIDPRODUCTO == 'M544' || $val->CIDPRODUCTO == 'M545' || $val->CIDPRODUCTO == 'M640' || $val->CIDPRODUCTO == 'M641' || $val->CIDPRODUCTO == 'M642' || $val->CIDPRODUCTO == 'M643' || $val->CIDPRODUCTO == 'M644' || $val->CIDPRODUCTO == 'M645') {
			$val->CIDPRODUCTO = 'M540';
		}
		if ($val->CIDPRODUCTO == 'M546' || $val->CIDPRODUCTO == 'M647' || $val->CIDPRODUCTO == 'M646') {
			$val->CIDPRODUCTO = 'M581';
		}
		if ($val->CIDPRODUCTO == 'M551' || $val->CIDPRODUCTO == 'M650' ||$val->CIDPRODUCTO == 'M651') {
			$val->CIDPRODUCTO = 'M550';
		}
		if ($val->CIDPRODUCTO == 'M577' || $val->CIDPRODUCTO == 'M593' ||$val->CIDPRODUCTO == 'M671') {
			$val->CIDPRODUCTO = 'M562';
		}
		if ($val->CIDPRODUCTO == 'M639') {
			$val->CIDPRODUCTO = 'M563';
		}
		if ($val->CIDPRODUCTO == 'M564' || $val->CIDPRODUCTO == 'M565' || $val->CIDPRODUCTO == 'M566' ||$val->CIDPRODUCTO == 'M685') {
			$val->CIDPRODUCTO = 'M587';
		}
		if ($val->CIDPRODUCTO == 'M687') {
			$val->CIDPRODUCTO = 'M597';
		}
		if ($val->CIDPRODUCTO == 'M575' || $val->CIDPRODUCTO == 'M576' || $val->CIDPRODUCTO == 'M578' ||$val->CIDPRODUCTO == 'M670') {
			$val->CIDPRODUCTO = 'M574';
		}
		if ($val->CIDPRODUCTO == 'M580' || $val->CIDPRODUCTO == 'M680') {
			$val->CIDPRODUCTO = 'M579';
		}
		if ($val->CIDPRODUCTO == 'M682') {
			$val->CIDPRODUCTO = 'M588';
		}
		if ($val->CIDPRODUCTO == 'M590' || $val->CIDPRODUCTO == 'M681') {
			$val->CIDPRODUCTO = 'M582';
		}
		if ($val->CIDPRODUCTO == 'M683') {
			$val->CIDPRODUCTO = 'M583';
		}
		if ($val->CIDPRODUCTO == 'M686') {
			$val->CIDPRODUCTO = 'M589';
		}

		$sql = "UPDATE seg_producto SET cantidad = cantidad - ".$val->CUNIDADESCAPTURADAS." WHERE cod_producto = '".$val->CIDPRODUCTO."' ";
		if (!$dbcon->qBuilder($dbcon->conn(), 'do', $sql)) {
				dd([
					'code' => 400,
					'msj' => 'Error al actualizar cantidad de inventario',
					'sql' => $sql
				]);
			}

		$sql = "INSERT INTO seg_salidas
		(CFOLIO, cod_producto, CUNIDADESCAPTURADAS, cantidad_salida, usuario, estatus_salida, fecha_registro, firma)
		VALUES(".$folio.", '".$val->CIDPRODUCTO."', ".$val->CUNIDADESCAPTURADAS.", ".$val->CUNIDADESCAPTURADAS.", ".$_SESSION['id'].", 1, '".$fecha."', '".$firma."' )";
		if (!$dbcon->qBuilder($dbcon->conn(), 'do', $sql)) {
			dd([
				'code' => 400,
				'msj' => 'Error al insertar datos salidas',
				'sql' => $sql
			]);
		}
	}
	// ok
	dd([
		'code' => 200,
		'msj' => 'Se ha generado el surtido de producto con éxito.'
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
		despacharProducto($dbcon, $objDatos->datos, $objDatos->folio, $objDatos->firma);
		break;
}

 ?>