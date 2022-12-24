<?php
date_default_timezone_set('America/Mexico_City');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}
function getMisEntradas($dbcon){
	// $sql = "SELECT cve_req FROM requisicion WHERE cve_usuario = ".$cve_usuario." ORDER BY fecha_registro desc LIMIT 10";
	$entradasMateriaPrima = [];
	$cont = 0;
	// $array = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	// foreach ($array as $i => $val) {
		$sqle = "SET lc_time_names = 'es_MX'";
		$sql = "SELECT cve_entrada, nombre, FORMAT(cantidad_entrada, 2) as cantidad , date_format(fecha_registro, '%d/%M/%Y') as fecha
				FROM seg_entradas
				WHERE estatus_entrada = 'VIG' 
				ORDER BY cve_entrada DESC";
		$articulos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
		foreach ($articulos as $value) {
			$entradasMateriaPrima[$cont] = $value;
			$cont ++;
		}	
	// }
	dd($entradasMateriaPrima);
}

function GuardarEntrada($dbcon, $Datos){
	$status = 'VIG';
	$fecha = date('Y-m-d H:i:s');
	$tipo = 'Materia Prima';
	$conn = $dbcon->conn();
	$sql = "INSERT INTO seg_entradas(nombre, cantidad_entrada, categoria, estatus_entrada, creado_por, fecha_registro) VALUES ('".$Datos->materiaprima."', ".$Datos->cantidad.", '".$tipo."', '".$status."', ".$Datos->id.", '".$fecha."' );";
	$qBuilder = $dbcon->qBuilder($conn, 'do', $sql);
	if ($qBuilder) {
		$getId = "SELECT max(cve_entrada) cve_entrada, nombre FROM seg_entradas WHERE
		fecha_registro = '".$fecha."'
		AND creado_por = ".$Datos->id."
		AND nombre = '".$Datos->materiaprima."'
		AND cantidad_entrada = ".$Datos->cantidad."
		AND categoria = '".$tipo."'
		AND estatus_entrada = '".$status."'";

		$getId = $dbcon->qBuilder($conn, 'first', $getId);
		$sql = "UPDATE seg_materia_prima SET cantidad_materia_prima = cantidad_materia_prima + ".$Datos->cantidad." WHERE nombre_materia_prima =  ";
	}
}

function eliminarCaptura($dbcon, $Datos){
	// $cve_usuario = $datos->cve_usuario;
	// $cve_captura = $datos->cve_captura;

	$sql = "CALL deleteproduccionmorteros(".$Datos->cve_usuario.",".$Datos->cve_captura.")";
	$storeprocedure = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
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
	case 'eliminarCaptura':
		eliminarCaptura($dbcon, $objDatos);
		break;
	case 'GuardarEntrada':
		GuardarEntrada($dbcon, $objDatos);
}
?>
