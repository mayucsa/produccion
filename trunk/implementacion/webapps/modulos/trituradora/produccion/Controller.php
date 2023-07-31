<?php 
date_default_timezone_set('America/Mexico_City');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}
function getReporte($dbcon, $Datos){
	$repo = $Datos->repo;
	$tipo = $Datos->tipo;	
	$fecha = $Datos->datos->fecha;
	$turno = $Datos->datos->turno;
	$fechaSig = explode(' ', $fecha);
	$fechaSig = new DateTime($fechaSig[0]);
	$fechaSig->add(new DateInterval('P1D'));
	$fechaSig = $fechaSig->format('Y-m-d');
	$total = 0;
	if ($repo == 1) {
		$whereBetween = '';
		if ( $turno == 3 ){
			$whereBetween = "cp.fecha_registro >= '".$fecha." 23:00:00' AND cp.fecha_registro <= '".$fechaSig." 06:59:59'";
	    }
	    if ( $turno == 2 ){
			$whereBetween = "cp.fecha_registro >= '".$fecha." 15:00:00' AND cp.fecha_registro < '".$fecha." 23:00:00'";
	    }

	    if ( $turno == 1 ){
			$whereBetween = "cp.fecha_registro >= '".$fecha." 07:00:00' AND cp.fecha_registro < '".$fecha." 15:00:00'";
	    }
		$sql = "SELECT cm.nombre_maq, ";
		if ($tipo == 'global') {
			$sql .= "SUM(cm.capacidad_m3) as cant, cmt.nombre_material
			FROM captura_producciontrituradora cp
			INNER JOIN cat_maquinas cm ON cm.cve_maq = cp.cve_maq 
			INNER JOIN cat_material_trituradora cmt ON cmt.cve_mt = cp.cve_mt
		    WHERE 
		    /*cp.estatus = 'VIG' AND */
		    linea = 1 AND ".$whereBetween." GROUP BY cp.cve_maq";
		}else{
			$sql .= "cm.capacidad_m3 as cant, cmt.nombre_material
			FROM captura_producciontrituradora cp
			INNER JOIN cat_maquinas cm ON cm.cve_maq = cp.cve_maq 
			INNER JOIN cat_material_trituradora cmt ON cmt.cve_mt = cp.cve_mt
		    WHERE 
		    /*cp.estatus = 'VIG' AND */
		    linea = 1 AND ".$whereBetween;
		}
		$sql .= " ORDER BY cm.nombre_maq";
		$turno = $Datos->datos->turnoDesc;
		$getDatos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	    $datos = [];
	    $aux = 0;
	    $w = 0;
	    foreach ($getDatos as $i => $row) {
	    	// $row->Turno = getTurno($row->fecha_registro);
	    	if($i == 55){
				$aux++; $w = 0;
			}
			if(($i - 55 ) % 65 == 0){
				$aux++; $w = 0;
			}
			$datos[$aux][$w] = $row;
			$w++;
			$total += floatval($row->cant);
	    }
	}
	if ($repo == 2) {
		$whereBetween = '';
		if ( $turno == 3 ){
			$whereBetween = "cp.fecha_registro >= '".$fecha." 23:00:00' AND cp.fecha_registro <= '".$fechaSig." 06:59:59'";
	    }
	    if ( $turno == 2 ){
			$whereBetween = "cp.fecha_registro >= '".$fecha." 15:00:00' AND cp.fecha_registro < '".$fecha." 23:00:00'";
	    }

	    if ( $turno == 1 ){
			$whereBetween = "cp.fecha_registro >= '".$fecha." 07:00:00' AND cp.fecha_registro < '".$fecha." 15:00:00'";
	    } 
		$sql = "SELECT cm.nombre_maq, ";
		if ($tipo == 'global') {
			$sql .= "SUM(cm.capacidad_m3) as cant, cmt.nombre_material
		FROM captura_producciontrituradora cp
		INNER JOIN cat_maquinas cm ON cm.cve_maq = cp.cve_maq 
		INNER JOIN cat_material_trituradora cmt ON cmt.cve_mt = cp.cve_mt
	    WHERE 
	    /*cp.estatus = 'VIG' AND */
	    linea = 2 AND ".$whereBetween." GROUP BY cp.cve_maq";
		}else{
			$sql .= "cm.capacidad_m3 as cant, cmt.nombre_material
		FROM captura_producciontrituradora cp
		INNER JOIN cat_maquinas cm ON cm.cve_maq = cp.cve_maq 
		INNER JOIN cat_material_trituradora cmt ON cmt.cve_mt = cp.cve_mt
	    WHERE 
	    /*cp.estatus = 'VIG' AND */
	    linea = 2 AND ".$whereBetween;
		}
		$sql .= " ORDER BY cm.nombre_maq";
		$turno = $Datos->datos->turnoDesc;
	    $getDatos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	    $datos = [];
	    $aux = 0;
	    $w = 0;
	    foreach ($getDatos as $i => $row) {
	    	// $row->Turno = getTurno($row->fecha_registro);
	    	if($i == 55){
				$aux++; $w = 0;
			}
			if(($i - 55 ) % 65 == 0){
				$aux++; $w = 0;
			}
			$datos[$aux][$w] = $row;
			$w++;
			$total += floatval($row->cant);
	    }
	}
	dd([
		'repo' => $repo,
		'tipo' => ucfirst($tipo),
		'fecha' => $fecha,
		'turno' => $turno,
		'datos' => $datos,
		'total' => $total,
		'sql' => $sql
	]);
}
function getMaquinas($dbcon){
	$sql = "SELECT cve_maq, cve_alterna, nombre_maq FROM cat_maquinas WHERE estatus_maq = 'VIG' AND produccion_trituradora = 1 ";
	$Maquinas = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	dd($Maquinas);
}
function TraerMaquinas($dbcon, $maquina){
	$sql = "SELECT cve_maq, cve_alterna, nombre_maq FROM cat_maquinas WHERE cve_alterna = '".$maquina."' AND estatus_maq = 'VIG' AND produccion_trituradora = 1 ";
	$Maquinas = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	dd($Maquinas);
}
function getTipoMaterial($dbcon){
	$sql = "SELECT cve_mt, cve_alterna, nombre_material FROM cat_material_trituradora WHERE estatus = 'VIG' ";
	$Material = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	dd($Material);
}
function getTurno($hora){
	$hora = explode(' ', $hora);
	if (isset($hora[1])) {
		$hora = $hora[1];
	}else{
		$hora = '00:00:00';
	}
	if ($hora >=  '23:00:01' && $hora <= '23:59:59'){
        return '3er Turno';
    }
    if ($hora >=  '00:00:01' && $hora <= '06:59:59'){
        return '3er Turno';
    } 
    if ($hora >=  '07:00:00' && $hora <= '15:00:00'){
        return '1er Turno';
    } 
    if ($hora >=  '15:00:01' && $hora <= '23:00:00'){
         return '2do Turno';
    }
    return 'Sin Turno';
}
function ssProduccionLinea1($dbcon){
	$sql = "SELECT cve_pt, cu.nombre, cu.apellido, cm.capacidad_m3, nombre_maq, cmt.cve_alterna, nombre_material, capturado_por, cp.fecha_registro , '' Turno 
	FROM captura_producciontrituradora cp
	INNER JOIN cat_maquinas cm ON cm.cve_maq = cp.cve_maq
	INNER JOIN cat_material_trituradora cmt ON cmt.cve_mt = cp.cve_mt
	INNER JOIN cat_usuarios cu ON cu.cve_usuario = cp.capturado_por
    WHERE cp.estatus = 'VIG' AND linea = 1
    ORDER BY cve_pt DESC ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    foreach ($datos as $i => $row) {
    	$row->Turno = getTurno($row->fecha_registro);
    }
    dd($datos);
}
function ssProduccionLinea2($dbcon){
	$sql = "SELECT cve_pt, cu.nombre, cu.apellido, cm.capacidad_m3, nombre_maq, cmt.cve_alterna, nombre_material, capturado_por, cp.fecha_registro , '' Turno 
	FROM captura_producciontrituradora cp
	INNER JOIN cat_maquinas cm ON cm.cve_maq = cp.cve_maq
	INNER JOIN cat_material_trituradora cmt ON cmt.cve_mt = cp.cve_mt
	INNER JOIN cat_usuarios cu ON cu.cve_usuario = cp.capturado_por
    WHERE cp.estatus = 'VIG' AND linea = 2
    ORDER BY cve_pt DESC ";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    foreach ($datos as $i => $row) {
    	$row->Turno = getTurno($row->fecha_registro);
    }
    dd($datos);
}
function guardarProduccionL1($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = 'VIG';
	$linea = '1';
	$conn = $dbcon->conn();
	$sql = "INSERT INTO captura_producciontrituradora (cve_maq, cve_mt, linea, capturado_por, estatus, fecha_registro) VALUES ( ".$Datos->maquina.", ".$Datos->tmaterial.", ".$linea.", ".$Datos->id.", '".$status."', '".$fecha."' ) ";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	// dd($sql);
	if ($qBuilder) {
		$getId = "SELECT max(cve_pt) cve_pt FROM captura_producciontrituradora WHERE
		fecha_registro = '".$fecha."'
		AND linea = ".$linea."
		AND capturado_por = ".$Datos->id."
		AND cve_maq = ".$Datos->maquina."
		AND cve_mt = ".$Datos->tmaterial."
		AND estatus = '".$status."' ";

		$getId = $dbcon->qBuilder($conn, 'first', $getId);
		dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getId->cve_pt]);
	}else{
		dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
	}
}
function guardarProduccionL2($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = 'VIG';
	$linea = '2';
	$conn = $dbcon->conn();
	$sql = "INSERT INTO captura_producciontrituradora (cve_maq, cve_mt, linea, capturado_por, estatus, fecha_registro) VALUES ( ".$Datos->maquina.", ".$Datos->tmaterial.", ".$linea.", ".$Datos->id.", '".$status."', '".$fecha."' ) ";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	// dd($sql);
	if ($qBuilder) {
		$getId = "SELECT max(cve_pt) cve_pt FROM captura_producciontrituradora WHERE
		fecha_registro = '".$fecha."'
		AND linea = ".$linea."
		AND capturado_por = ".$Datos->id."
		AND cve_maq = ".$Datos->maquina."
		AND cve_mt = ".$Datos->tmaterial."
		AND estatus = '".$status."' ";

		$getId = $dbcon->qBuilder($conn, 'first', $getId);
		dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getId->cve_pt]);
	}else{
		dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
	}
}
function EliminarProduccion($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = 'DELETE';
	$conn = $dbcon->conn();
	$sql = "UPDATE captura_producciontrituradora SET estatus = '".$status."', eliminado_por = ".$Datos->id.", fecha_eliminado = '".$fecha."' WHERE cve_pt = ".$Datos->cve." ";

	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	dd($sql);
}
function EditarProduccion($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$status = 'VIG';
	$conn = $dbcon->conn();
	$cBuilder = "SELECT cve_pt, cve_maq, cve_mt FROM captura_producciontrituradora WHERE cve_pt = ".$Datos->cve." ";
	$cBuilder = $dbcon->qBuilder($conn, 'first', $cBuilder);
	// dd($cBuilder);

	$sql = " INSERT INTO ctrl_editar_producciontrituradora (cve_pt, cve_maq, cve_maq_nuevo, cve_mt, cve_mt_nuevo, editado_por, estatus_editado, fecha_edicion)VALUES(".$Datos->cve.", ".$cBuilder->cve_maq.", ".$Datos->maquinae.", ".$cBuilder->cve_mt.", ".$Datos->tmateriale.", ".$Datos->id.", '".$status."', '".$fecha."'  ); ";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	// dd($sql);

	$u1 = "UPDATE captura_producciontrituradora SET cve_maq = ".$Datos->maquinae." WHERE cve_pt = ".$Datos->cve." ";
	$qu1 = $dbcon->qBuilder($conn, 'do', $u1);
	// dd($u1);

	$u2 = "UPDATE captura_producciontrituradora SET cve_mt = ".$Datos->tmateriale." WHERE cve_pt = ".$Datos->cve." ";
	$qu2 = $dbcon->qBuilder($conn, 'do', $u2);
	// dd($u2);
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
	case 'getMaquinas':
		getMaquinas($dbcon);
		break;
	case 'TraerMaquinas':
		TraerMaquinas($dbcon, $objDatos->maquina);
		break;
	case 'getTipoMaterial':
		getTipoMaterial($dbcon);
		break;
	case 'ssProduccionLinea1':
		ssProduccionLinea1($dbcon);
		break;
	case 'ssProduccionLinea2':
		ssProduccionLinea2($dbcon);
		break;
	case 'guardarProduccionL1':
		guardarProduccionL1($dbcon, $objDatos);
		break;
	case 'guardarProduccionL2':
		guardarProduccionL2($dbcon, $objDatos);
		break;
	case 'EliminarProduccion':
		EliminarProduccion($dbcon, $objDatos);
		break;
	case 'EditarProduccion':
		EditarProduccion($dbcon, $objDatos);
		break;
	case 'getReporte':
		getReporte($dbcon, $objDatos);
		break;
}

?>
