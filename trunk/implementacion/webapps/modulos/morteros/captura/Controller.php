<?php
date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}

function getProduccion($dbcon){
	$sql = "SELECT cp.cve_captura, cp.cve_mortero,spm.nombre_producto, cantidad_barcadas, kg_real, sacos_total, cp.fecha_registro 
			FROM captura_produccionmorteros cp
		    INNER JOIN seg_producto_morteros spm ON cp.cve_mortero = spm.cve_mortero
		    WHERE cp.estatus_registro = 'VIG'
		    ORDER BY fecha_registro DESC";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    dd($datos);
}
function getProducto($dbcon){
	$sql = "	SELECT *
				FROM seg_producto_morteros spm
				WHERE estatus_producto = 'vig' " ;
	$mp = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	dd($mp);
}
function getTonelada($dbcon, $Datos){
	$sql = "	SELECT *
				FROM seg_producto_morteros spm
				WHERE cve_mortero = ".$Datos->producto."  " ;
	$tonelada = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	dd($tonelada);
}
function getTarimas($dbcon, $cantidad){
	$sql = "	SELECT cantidad_materiaprima
				FROM seg_materiaprima_morteros spm
				WHERE cve_mpmorteros = 27  " ;
	$tarimas = $dbcon->qBuilder($dbcon->conn(), 'first', $sql);
	if (floatval($cantidad) > floatval($tarimas->cantidad_materiaprima)) {
		dd([
			'cantidad' => $tarimas->cantidad_materiaprima,
			'msj' => 'Cantidad mayor a la existencia'
		]);
	}else{
		dd([
			'cantidad' => $cantidad,
			'msj' => 'ok'
		]);
	}
}
// function guardarProduccion($dbcon, $Datos){
// 	$fecha = date('Y-m-d H:i:s');
// 	$status = 'VIG';
// 	$conn = $dbcon->conn();
	
// 	// $producto = $Datos->producto;
// 	// foreach ($producto as $i => $val) {
// 		$materiaprima =  "SELECT cve_mpmorteros, cantidad FROM materiaprima_usadapor_productomorteros WHERE estatus_registro = 'VIG' AND cve_mortero = $Datos->producto ";

// 		foreach ($materiaprima as $key => $value) {
// 			// code...
		
// 		$materiaprima = $dbcon->qBuilder($conn, 'first', $materiaprima);
// 		dd(['code'=>200,'msj'=>'Carga ok', 'MateriaPrima'=>$materiaprima->cve_mpmorteros ,'Cantidad'=>$materiaprima->cantidad]);
// 	}

// }
function guardarProduccion($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = 'vig';
	$conn = $dbcon->conn();
	$sql = "INSERT INTO captura_produccionmorteros (cve_mortero, cantidad_barcadas, kg_porformula, kg_real, kg_diferencia, sacos_enproduccion, sacos_rotos, sacos_total, tarimas_enproduccion, usuario, estatus_registro, fecha_registro)
			VALUES (".$Datos->producto.", ".$Datos->cantidad.", ".$Datos->kgformula.", ".$Datos->kgreal.", ".$Datos->diferencia.", ".$Datos->sacosproduccion.", ".$Datos->sacosrotos.", ".$Datos->sacostotales.", ".$Datos->tarimas.", ".$Datos->id.", '".$status."', '".$fecha."' )";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);

	if ($qBuilder) {
		$getId = "SELECT max(cve_captura) cve_captura FROM captura_produccionmorteros WHERE 
		fecha_registro = '".$fecha."'
		AND usuario = ".$Datos->id."
		AND estatus_registro =  '".$status."'
		AND cantidad_barcadas = ".$Datos->cantidad."
		AND kg_real = ".$Datos->kgreal."
		AND sacos_enproduccion = ".$Datos->sacosproduccion."
		AND sacos_rotos = ".$Datos->sacosrotos."
		AND tarimas_enproduccion = ".$Datos->tarimas." ";
		$getId = $dbcon->qBuilder($conn, 'first', $getId);

		$sqlu = "UPDATE seg_producto_morteros SET cantidad = cantidad + ".$Datos->kgreal." WHERE cve_mortero = ".$Datos->producto." ";
		$sqlu = $dbcon->qBuilder($conn, 'do', $sqlu);
		// dd($sqlu);
		$sqltarima = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima - ".$Datos->tarimas." WHERE cve_mpmorteros = 27 ";
		$sqltarima = $dbcon->qBuilder($conn, 'do', $sqltarima);
		// dd($sqltarima);

		/* 
			Descontar la materia prima que se ocupa.
			Obtenemos los materiales que ocupa cada mortero e itermaos para obtener la cantidad ocupada multiplicada por la cantidad pedida
		*/
		$mPrimaQry = "SELECT cve_mpmorteros, cantidad FROM materiaprima_usadapor_productomorteros WHERE cve_mortero = ".$Datos->producto;
		$mPrimaQry = $dbcon->qBuilder($conn, 'ALL', $mPrimaQry);
		foreach ($mPrimaQry as $i => $row) {
			//cantidad de matería prima total
			$cantidadMPT = floatval($Datos->cantidad) * floatval($row->cantidad);
			$update = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima - ".$cantidadMPT." WHERE cve_mpmorteros = ".$row->cve_mpmorteros;
			if (!$dbcon->qBuilder($conn, 'do', $update)) {
				dd(['code'=>400,'msj'=>'Error al actualizar cantidad de materia prima', 'query'=>$update]);
			}
		}

		$codsaco = "SELECT cve_sacos_morteros, presentacion FROM seg_producto_morteros WHERE cve_mortero = ".$Datos->producto." ";
		$codsaco = $dbcon->qBuilder($conn, 'first', $codsaco);
		$existenciasaco = "SELECT cantidad_materiaprima FROM seg_materiaprima_morteros WHERE cve_mpmorteros = ".$codsaco->cve_sacos_morteros." ";
		$existenciasaco = $dbcon->qBuilder($conn, 'first', $existenciasaco);

		// $existsaco = floatval($existenciasaco->cantidad_materiaprima);
		// $sacostotales = floatval($Datos->sacostotales);

		if ($existenciasaco->cantidad_materiaprima >= $Datos->sacostotales) {
			$updatesaco = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima - ".$Datos->sacostotales." WHERE cve_mpmorteros = ".$codsaco->cve_sacos_morteros." ";
			$updatesaco = $dbcon->qBuilder($conn, 'do', $updatesaco);
			$insertctrlsacos = " 	INSERT ctrl_mov_sacosmorteros (cve_captura, cve_segmatprima, cantidad, estatus_consumo, fecha_registro) 
									VALUES ($getId->cve_captura, ".$codsaco->cve_sacos_morteros.", ".$Datos->sacostotales.", '".$status."', '".$fecha."' ) ";
			$insertctrlsacos = $dbcon->qBuilder($conn, 'do', $insertctrlsacos);
		}
		if ($existenciasaco->cantidad_materiaprima <= 0) {
			switch($codsaco->presentacion){
				case 20:
					$updatesaco = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima - ".$Datos->sacostotales." WHERE cve_mpmorteros = 25 ";
					$updatesaco = $dbcon->qBuilder($conn, 'do', $updatesaco);
					$insertctrlsacos = " 	INSERT ctrl_mov_sacosmorteros (cve_captura, cve_segmatprima, cantidad, estatus_consumo, fecha_registro) 
											VALUES ($getId->cve_captura, 25, ".$Datos->sacostotales.", '".$status."', '".$fecha."' ) ";
					$insertctrlsacos = $dbcon->qBuilder($conn, 'do', $insertctrlsacos);
				break;
				case 40:
					$updatesaco = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima - ".$Datos->sacostotales." WHERE cve_mpmorteros = 24 ";
					$updatesaco = $dbcon->qBuilder($conn, 'do', $updatesaco);
					$insertctrlsacos = " 	INSERT ctrl_mov_sacosmorteros (cve_captura, cve_segmatprima, cantidad, estatus_consumo, fecha_registro) 
											VALUES ($getId->cve_captura, 24, ".$Datos->sacostotales.", '".$status."', '".$fecha."' ) ";
					$insertctrlsacos = $dbcon->qBuilder($conn, 'do', $insertctrlsacos);
				break;
			}
		}
		if ($existenciasaco->cantidad_materiaprima < $Datos->sacostotales AND $existenciasaco->cantidad_materiaprima > 0 ) {
			$diferencia = $Datos->sacostotales - $existenciasaco->cantidad_materiaprima;
			switch($codsaco->presentacion){
				case 20:
					$updatesaco = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = 0 WHERE cve_mpmorteros = ".$codsaco->cve_sacos_morteros." ";
					$updatesaco = $dbcon->qBuilder($conn, 'do', $updatesaco);
					$updatesaco20 = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima - $diferencia  WHERE cve_mpmorteros = 25 ";
					$updatesaco20 = $dbcon->qBuilder($conn, 'do', $updatesaco20);

					$insertctrlsacos = " 	INSERT ctrl_mov_sacosmorteros (cve_captura, cve_segmatprima, cantidad, estatus_consumo, fecha_registro) 
											VALUES ($getId->cve_captura, ".$codsaco->cve_sacos_morteros.", $existenciasaco->cantidad_materiaprima, '".$status."', '".$fecha."' ) ";
					$insertctrlsacos = $dbcon->qBuilder($conn, 'do', $insertctrlsacos);
					$insertctrlsacos20 = " 	INSERT ctrl_mov_sacosmorteros (cve_captura, cve_segmatprima, cantidad, estatus_consumo, fecha_registro) 
											VALUES ($getId->cve_captura, 25, $diferencia, '".$status."', '".$fecha."' ) ";
					$insertctrlsacos20 = $dbcon->qBuilder($conn, 'do', $insertctrlsacos20);
				break;
				case 40:
					$updatesaco = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = 0 WHERE cve_mpmorteros = ".$codsaco->cve_sacos_morteros." ";
					$updatesaco = $dbcon->qBuilder($conn, 'do', $updatesaco);
					$updatesaco40 = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima - $diferencia WHERE cve_mpmorteros = 24 ";
					$updatesaco40 = $dbcon->qBuilder($conn, 'do', $updatesaco40);

					$insertctrlsacos = " 	INSERT ctrl_mov_sacosmorteros (cve_captura, cve_segmatprima, cantidad, estatus_consumo, fecha_registro) 
											VALUES ($getId->cve_captura, ".$codsaco->cve_sacos_morteros.", $existenciasaco->cantidad_materiaprima, '".$status."', '".$fecha."' ) ";
					$insertctrlsacos = $dbcon->qBuilder($conn, 'do', $insertctrlsacos);
					$insertctrlsacos40 = " 	INSERT ctrl_mov_sacosmorteros (cve_captura, cve_segmatprima, cantidad, estatus_consumo, fecha_registro) 
											VALUES ($getId->cve_captura, 24, $diferencia, '".$status."', '".$fecha."' ) ";
					$insertctrlsacos40 = $dbcon->qBuilder($conn, 'do', $insertctrlsacos40);
				break;
			}
		}

		// $getId = $dbcon->qBuilder($conn, 'first', $getId);
		dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getId->cve_captura]);
	}else{
		dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
	}
}

function eliminarProduccion($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = 'delete';
	$conn = $dbcon->conn();
	$sql = " UPDATE captura_produccionmorteros SET estatus_registro = '".$status."', fecha_eliminado = '".$fecha."' WHERE cve_captura = ".$Datos->cve_captura." ";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);

	$sqlu = "UPDATE seg_producto_morteros SET cantidad = cantidad - ".$Datos->kgreal." WHERE cve_mortero = ".$Datos->producto." ";
		$sqlu = $dbcon->qBuilder($conn, 'do', $sqlu);

	$sqlsaco = "UPDATE seg_producto_morteros SET cantidad = cantidad - ".$Datos->kgreal." WHERE cve_mortero = ".$Datos->producto." ";
	$sqlsaco = $dbcon->qBuilder($conn, 'do', $sqlsaco);
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
	case 'getProducto':
		getProducto($dbcon);
		break;
	case 'getTonelada':
		getTonelada($dbcon, $objDatos);
		break;
	case 'getTarimas':
		getTarimas($dbcon, $objDatos->cantidad);
		break;
	case 'guardarProduccion':
		guardarProduccion($dbcon, $objDatos);
		break;
	case 'eliminarProduccion':
		eliminarProduccion($dbcon, $objDatos);
		break;
	case 'getProduccion':
		getProduccion($dbcon);
		break;

}
?>
