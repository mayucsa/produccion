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
	$sql = "SELECT cp.cve_captura, cp.cve_mortero,spm.nombre_producto, cantidad_barcadas, kg_real, sacos_total, tarimas_enproduccion, cp.fecha_registro 
			FROM captura_produccionmorteros cp
		    INNER JOIN seg_producto_morteros spm ON cp.cve_mortero = spm.cve_mortero
		    WHERE cp.estatus_registro = 'vig'
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
				WHERE cve_mpmorteros = 28  " ;
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
function getMateriaPrima($dbcon, $Datos){
	$conn = $dbcon->conn();
	$sql = "SELECT cve_mpmorteros, cantidad FROM materiaprima_usadapor_productomorteros WHERE cve_mortero = ".$Datos->producto;
	$sql = $dbcon->qBuilder($conn, 'ALL', $sql);
	$mpSinExistencia = '';
	// dd(['cantidad' => $sql,'msj' => 'Cantidad mayor a la existencia']);
	foreach ($sql as $i => $row) {
		$cantidadMP = floatval($Datos->cantidad) * floatval($row->cantidad);// Valor de Cantidad de barcadas por cantidad segun la materia prima que usa

		$cantidadInven = "SELECT nombre_materiaprima, cantidad_materiaprima FROM seg_materiaprima_morteros smm WHERE cve_mpmorteros = ".$row->cve_mpmorteros;
		$cantidadInventario = $dbcon->qBuilder($conn, 'first', $cantidadInven);
		// dd(['mp' => $cantinven]);
		$cantidadInvTotal = floatval($cantidadInventario->cantidad_materiaprima);
		// dd(['BarcadasPorKg' => $cantidadMP, 'CantidadDeInventario' => $cantidadInvTotal]);
		if (floatval($cantidadInvTotal) < floatval($cantidadMP)) {
			// dd([
			// 	'BarcadasPorKg' => $cantidadMP,
			// 	'CantidadDeInventario' => $cantidadInvTotal,
			// 	'msj' => 'Revisar existencia de materia prima para producir'
			// ]);
			$mpSinExistencia .= 'MP: '.$cantidadInventario->nombre_materiaprima.' | Excedido: '.(floatval($cantidadMP) - floatval($cantidadInvTotal)).'<br>';
		}
		// else{
		// 	dd([
		// 		'BarcadasPorKg' => $cantidadMP,
		// 		'CantidadDeInventario' => $cantidadInvTotal,
		// 		'msj' => 'ok'
		// 	]);
		// }
		dd($mpSinExistencia);
	}
}
function envioCorreo($dbcon, $materiasPrimas = ''){
	include_once "../../../correo/EnvioSMTP.php";
	$envioSMTP = new EnvioSMTP;
	// if ($aprobacion == '') {
		// $sql = "SELECT u.nombre_usuario, u.nombre, u.apellido FROM requisicion r INNER JOIN cat_usuarios u ON u.cve_usuario = r.cve_usuario WHERE cve_req = ".$folio;
		// $requisicion = $dbcon->qBuilder($dbcon->conn(), 'first', $sql);
		$title = 'Envasado/Morteros';
		$Subject = 'Inventario materia prima';
		$cuerpo = '<h1>Revisión de inventario de materia prima.</h1>';
		$cuerpo .= '<br><hr style="width:30%;">'; 
		$cuerpo .= '<br><p>MORTEROS</p>';
		// $cuerpo .= '<br>GENERAR UN FOR DONDE ENLISTE TODOS LAS MATERIA PRIMAS QUE SEAN MENOR O IGUAL A SU MINIMO';
		$cuerpo .= $materiasPrimas;
	// }
	$Body = '<!doctype html>';
	$Body .= '<html lang="es" >';
	$Body .= '<head>';
	$Body .= '<meta charset="utf-8">';
	$Body .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
	$Body .= '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">';
	$Body .= '<meta name="title" content="Mayucsa">';
	$Body .= '<title>Email Mayucsa</title>';
	$Body .= '</head>';
	$Body .= '<body style="background-color: white;">';
	$Body .= '<br><br>';
	$Body .= '<div class="container" style="border-radius: 15px; background-color: white; margin-top:2vH;margin-bottom:2vH; width:70%; margin-left:15%; text-align:center;">';
	$Body .= '<center>';
	$Body .= $cuerpo;
	$Body .= '<br><p>Acceda al sistema de produccion(SYSPROM).</p>';
	$Body .= '</center>';
	$Body .= '</div>';
	$Body .= '<br><br>';
	$Body .= '</body>';
	$Body .= '</html>';
	$claveRol2 = "SELECT correo FROM cat_usuarios WHERE cve_usuario = 2";
	$correos = $dbcon->qBuilder($dbcon->conn(), 'all', $claveRol2);
	// $correos = ['ilopez@lcdevelopers.com.mx'];
	$email = $envioSMTP->correo($title, $Subject, $Body, $correos);
	if ($email) {
		dd(['code'=>200]);
	}else{
		dd(['code'=>400, 'body'=>$Body]);
	}
}
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
		$sqltarima = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima - ".$Datos->tarimas." WHERE cve_mpmorteros = 28 ";
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
			$insert = "	INSERT INTO materiaprima_segun_produccion (cve_mortero, cve_mpmorteros, cantidad, estatus_registro) 
						VALUES(".$getId->cve_captura.", ".$row->cve_mpmorteros.", ".$row->cantidad.", '".$status."' ) ";
			if (!$dbcon->qBuilder($conn, 'do', $insert)) {
				dd(['code'=>400,'msj'=>'Error al insertar cantidad de materia prima', 'query'=>$insert]);
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
					$updatesaco = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima - ".$Datos->sacostotales." WHERE cve_mpmorteros = 26 ";
					$updatesaco = $dbcon->qBuilder($conn, 'do', $updatesaco);
					$insertctrlsacos = " 	INSERT ctrl_mov_sacosmorteros (cve_captura, cve_segmatprima, cantidad, estatus_consumo, fecha_registro) 
											VALUES ($getId->cve_captura, 26, ".$Datos->sacostotales.", '".$status."', '".$fecha."' ) ";
					$insertctrlsacos = $dbcon->qBuilder($conn, 'do', $insertctrlsacos);
				break;
				case 40:
					$updatesaco = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima - ".$Datos->sacostotales." WHERE cve_mpmorteros = 25 ";
					$updatesaco = $dbcon->qBuilder($conn, 'do', $updatesaco);
					$insertctrlsacos = " 	INSERT ctrl_mov_sacosmorteros (cve_captura, cve_segmatprima, cantidad, estatus_consumo, fecha_registro) 
											VALUES ($getId->cve_captura, 25, ".$Datos->sacostotales.", '".$status."', '".$fecha."' ) ";
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
					$updatesaco20 = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima - $diferencia  WHERE cve_mpmorteros = 26 ";
					$updatesaco20 = $dbcon->qBuilder($conn, 'do', $updatesaco20);

					$insertctrlsacos = " 	INSERT ctrl_mov_sacosmorteros (cve_captura, cve_segmatprima, cantidad, estatus_consumo, fecha_registro) 
											VALUES ($getId->cve_captura, ".$codsaco->cve_sacos_morteros.", $existenciasaco->cantidad_materiaprima, '".$status."', '".$fecha."' ) ";
					$insertctrlsacos = $dbcon->qBuilder($conn, 'do', $insertctrlsacos);
					$insertctrlsacos20 = " 	INSERT ctrl_mov_sacosmorteros (cve_captura, cve_segmatprima, cantidad, estatus_consumo, fecha_registro) 
											VALUES ($getId->cve_captura, 26, $diferencia, '".$status."', '".$fecha."' ) ";
					$insertctrlsacos20 = $dbcon->qBuilder($conn, 'do', $insertctrlsacos20);
				break;
				case 40:
					$updatesaco = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = 0 WHERE cve_mpmorteros = ".$codsaco->cve_sacos_morteros." ";
					$updatesaco = $dbcon->qBuilder($conn, 'do', $updatesaco);
					$updatesaco40 = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima - $diferencia WHERE cve_mpmorteros = 25 ";
					$updatesaco40 = $dbcon->qBuilder($conn, 'do', $updatesaco40);

					$insertctrlsacos = " 	INSERT ctrl_mov_sacosmorteros (cve_captura, cve_segmatprima, cantidad, estatus_consumo, fecha_registro) 
											VALUES ($getId->cve_captura, ".$codsaco->cve_sacos_morteros.", $existenciasaco->cantidad_materiaprima, '".$status."', '".$fecha."' ) ";
					$insertctrlsacos = $dbcon->qBuilder($conn, 'do', $insertctrlsacos);
					$insertctrlsacos40 = " 	INSERT ctrl_mov_sacosmorteros (cve_captura, cve_segmatprima, cantidad, estatus_consumo, fecha_registro) 
											VALUES ($getId->cve_captura, 25, $diferencia, '".$status."', '".$fecha."' ) ";
					$insertctrlsacos40 = $dbcon->qBuilder($conn, 'do', $insertctrlsacos40);
				break;
			}
		}

		// $getId = $dbcon->qBuilder($conn, 'first', $getId);
		getMinimo($dbcon);
		dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getId->cve_captura]);
	}else{
		dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
	}
}
function getMinimo($dbcon, $Datos){
	$conn = $dbcon->conn();
	$sql = "SELECT nombre_materiaprima, cantidad_materiaprima, minimo_materiaprima FROM seg_materiaprima_morteros";
	$sql = $dbcon->qBuilder($conn, 'ALL', $sql);
	// $cantidad = floatval($sql->cantidad_materiaprima);
	// dd(['sql' => $cantidad,'msj' => 'Cantidad mayor a la existencia']);
	$materiasPrimas = '';
	foreach ($sql as $i => $row) {
		$inventario = floatval($row->cantidad_materiaprima);
		$minimo = floatval($row->minimo_materiaprima);
		if ($inventario <= $minimo) {
			// dd(['nombre' => $row->nombre_materiaprima,'inventario' => $inventario, 'minimo' => $minimo, 'msj' => 'Cantidad mayor a la existencia']);
			$materiasPrimas .= 'MP: '.$row->nombre_materiaprima.' | Inventario: '.$inventario.' | Mínimo: '.$minimo.'<br>';
		}
	}
	if ($materiasPrimas != '') {
		envioCorreo($dbcon, $materiasPrimas);
	}
}
function eliminarProduccion($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = 'delete';
	$conn = $dbcon->conn();
	$sql = " UPDATE captura_produccionmorteros SET estatus_registro = '".$status."', fecha_eliminado = '".$fecha."', eliminado_por = ".$Datos->id." WHERE cve_captura = ".$Datos->cve_captura." ";
	// $qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	if (!$dbcon->qBuilder($conn, 'do', $sql)) {
		dd(['code'=>400,'msj'=>'Error al actualizar captura de produccion morteros', 'query'=>$sql]);
	}

	$sqlu = "UPDATE seg_producto_morteros SET cantidad = cantidad - ".$Datos->kgreal." WHERE cve_mortero = ".$Datos->producto." ";
	// $sqlu = $dbcon->qBuilder($conn, 'do', $sqlu);
	if (!$dbcon->qBuilder($conn, 'do', $sqlu)) {
		dd(['code'=>400,'msj'=>'Error al descontar cantidad de inventario de productos finalizado', 'query'=>$sqlu]);
	}

	$sqltarima = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima + ".$Datos->tarimas." WHERE cve_mpmorteros = 28 ";
	// $sqltarima = $dbcon->qBuilder($conn, 'do', $sqltarima);
	if (!$dbcon->qBuilder($conn, 'do', $sqltarima)) {
		dd(['code'=>400,'msj'=>'Error al descontar cantidad de tarimas', 'query'=>$sqltarima]);
	}
	/*
	Aumentar la materia prima que se ocupo.
	Obtenemos los materiales que ocupa cada mortero e itermaos para obtener la cantidad ocupada multiplicada por la cantidad pedida
	*/
	$mPrimaQry = "SELECT cve_mpmorteros, cantidad FROM materiaprima_usadapor_productomorteros WHERE cve_mortero = ".$Datos->producto;
	$mPrimaQry = $dbcon->qBuilder($conn, 'ALL', $mPrimaQry);
	foreach ($mPrimaQry as $i => $row) {
		//cantidad de matería prima total
		$cantidadMPT = floatval($Datos->barcadas) * floatval($row->cantidad);
		$update = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima + ".$cantidadMPT." WHERE cve_mpmorteros = ".$row->cve_mpmorteros;
		if (!$dbcon->qBuilder($conn, 'do', $update)) {
			dd(['code'=>400,'msj'=>'Error al actualizar cantidad de materia prima', 'query'=>$update]);
		}
	}
	/*
	Regresar saqueria a inventario de sacos
	*/
	$sacosQry = "SELECT cve_captura, cve_segmatprima, cantidad FROM ctrl_mov_sacosmorteros WHERE cve_captura = ".$Datos->cve_captura." ";
	$sacosQry = $dbcon->qBuilder($conn, 'ALL', $sacosQry);
	foreach ($sacosQry as $i => $value) {
		$cantsacos =  floatval($value->cantidad);
		$updatesaco = "UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima + ".$cantsacos." WHERE cve_mpmorteros = ".$value->cve_segmatprima."  ";
		if (!$dbcon->qBuilder($conn, 'do', $updatesaco)) {
			dd(['code'=>400,'msj'=>'Error al actualizar cantidad de sacos', 'query'=>$updatesaco]);
		}
	}
}
function tmpproducto($dbcon, $cve_captura){
	$sql = "SELECT msp.cve_mortero, spm.nombre_producto, msp.cve_mpmorteros, smm.nombre_materiaprima, msp.cantidad, DATE_FORMAT(cp.fecha_registro, '%Y-%m-%d') as fecha_registro
			FROM materiaprima_segun_produccion msp
			INNER JOIN seg_materiaprima_morteros smm ON msp.cve_mpmorteros = smm.cve_mpmorteros
			INNER JOIN captura_produccionmorteros cp ON msp.cve_mortero = cp.cve_captura
			INNER JOIN seg_producto_morteros spm ON cp.cve_mortero = spm.cve_mortero 
			WHERE msp.cve_mortero = ".$cve_captura;
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
	case 'envioCorreo':
		envioCorreo($dbcon);
		break;
	case 'getProducto':
		getProducto($dbcon);
		break;
	case 'getTonelada':
		getTonelada($dbcon, $objDatos);
		break;
	case 'getTarimas':
		getTarimas($dbcon, $objDatos->cantidad);
		break;
	case 'getMateriaPrima':
		getMateriaPrima($dbcon, $objDatos);
		break;
	case 'getMinimo':
		getMinimo($dbcon, $objDatos);
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
	case 'tmpproducto':
		tmpproducto($dbcon,  $objDatos->cve_captura);
		break;

}
?>
