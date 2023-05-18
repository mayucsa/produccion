<?php
date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}
function getMisEntradas($dbcon){
	$sql = "	SELECT cve_entrada, smm.categoria, sem.cve_, smm.nombre_materiaprima, /*FORMAT(sem.cantidad_entrada, 2)*/sem.cantidad_entrada AS cantidad_entrada, sem.fecha_registro
				FROM seg_entradas_morteros sem 
				INNER JOIN mayucsademo.seg_materiaprima_morteros smm ON sem.cve_ = smm.cve_mpmorteros 
				WHERE estatus_entrada IN ('vig', 'editado')
				ORDER BY sem.fecha_registro DESC
				LIMIT 200 " ;
	$mp = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	dd($mp);
}
function getMateriaPrima($dbcon){
	$sql = "	SELECT cve_mpmorteros, cod_materiaprima, nombre_materiaprima, categoria
				FROM seg_materiaprima_morteros smm 
				WHERE estatus_materiaprima = 'VIG'
				ORDER BY categoria ASC " ;
	$mp = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	dd($mp);
}

function GuardarEntrada($dbcon, $Datos){
	$status = 'VIG';
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();

	$sql1 = " UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima + ".$Datos->cantidad." WHERE cve_mpmorteros = ".$Datos->materiaprima." ";
	$qBuilder1 = $dbcon->qBuilder($conn, 'do', $sql1);
	$sql = "INSERT INTO seg_entradas_morteros(cve_, cantidad_entrada, estatus_entrada, realizado_por, fecha_registro) 
			VALUES ( ".$Datos->materiaprima.", ".$Datos->cantidad.", '".$status."', ".$Datos->id.", '".$fecha."' );";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);

	if ($qBuilder) {
		$getId = "SELECT max(cve_entrada) cve_entrada FROM seg_entradas_morteros WHERE
		fecha_registro = '".$fecha."'
		AND realizado_por = ".$Datos->id."
		AND cve_ = ".$Datos->materiaprima."
		AND cantidad_entrada = ".$Datos->cantidad."
		AND estatus_entrada = '".$status."' ";

		$getId = $dbcon->qBuilder($conn, 'first', $getId);
		dd(['code'=>200,'msj'=>'Carga ok', 'folio'=>$getId->cve_entrada]);
	}else{
		dd(['code'=>300, 'msj'=>'error al crear folio.', 'sql'=>$sql]);
	}
}

function eliminar($dbcon, $Datos){
	$status = 'delete';
	$fecha = date('Y-m-d H:i:s');
	$conn = $dbcon->conn();

	$sql = " UPDATE seg_entradas_morteros SET eliminado_por = ".$Datos->id.", fecha_eliminado = '".$fecha."', estatus_entrada = '".$status."'  WHERE cve_entrada = ".$Datos->cve." ";
	$qBuilder = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);

	$sql1 = " UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = cantidad_materiaprima - ".$Datos->cantidad." WHERE cve_mpmorteros = ".$Datos->cvemp." ";
	$qBuilder1 = $dbcon->qBuilder($conn, 'do', $sql1);
}
function editar($dbcon, $Datos){
	$status = 'editado';
	$fecha = date('Y-m-d H:i:s');
	// $original = floatval($Datos->original);
	$conn = $dbcon->conn();

	$sql = " UPDATE seg_entradas_morteros SET cantidad_entrada = ".$Datos->cantidad.", cantidad_editado = ".$Datos->original.", fecha_editado = '".$fecha."', estatus_entrada = '".$status."'  WHERE cve_entrada = ".$Datos->folio." ";
	$qBuilder = $dbcon->qBuilder($dbcon->conn(), 'do', $sql);
	// dd($sql);
	$sql1 = " UPDATE seg_materiaprima_morteros SET cantidad_materiaprima = (cantidad_materiaprima - ".$Datos->original.") + ".$Datos->cantidad."  WHERE cve_mpmorteros = ".$Datos->cvemp." ";
	$qBuilder1 = $dbcon->qBuilder($conn, 'do', $sql1);
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
	case 'getMisEntradas':
		getMisEntradas($dbcon);
		break;
	case 'eliminar':
		eliminar($dbcon, $objDatos);
		break;
	case 'editar':
		editar($dbcon, $objDatos);
		break;
	case 'GuardarEntrada':
		GuardarEntrada($dbcon, $objDatos);
	case 'getMateriaPrima':
		getMateriaPrima($dbcon, $objDatos);
	case 'getMpSaco':
		getMpSaco($dbcon, $objDatos);
}
?>
