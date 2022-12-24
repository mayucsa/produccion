<?php
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}
function getMisProducciones($dbcon){
	// $sql = "SELECT cve_req FROM requisicion WHERE cve_usuario = ".$cve_usuario." ORDER BY fecha_registro desc LIMIT 10";
	$misProducciones = [];
	$cont = 0;
	// $array = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	// foreach ($array as $i => $val) {
		$sqle = "SET lc_time_names = 'es_MX'";
		$sql = "SELECT cve_captura, CONCAT(cve_producto,' - ', valor_presentacion, ' ','KG') as producto, num_barcadas, FORMAT(kg_real, 2) as kg_real, sacos_totales, date_format(fecha_registro, '%d/%M/%Y') as fecha
				FROM captura_produccion
				WHERE estatus_registro = 'VIG' 
				ORDER BY fecha_registro DESC";
		$articulos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
		foreach ($articulos as $value) {
			$misProducciones[$cont] = $value;
			$cont ++;
		}	
	// }
	dd($misProducciones);
}

function eliminarCaptura($dbcon, $datos){
	$cve_usuario = $datos->cve_usuario;
	$cve_captura = $datos->cve_captura;

	$sql = "CALL deleteproduccionmorteros(".$cve_captura.",'".$cve_usuario."')";
	// $sql = "CALL deleteproduccionmorteros(?,?)";
	$storeprocedure = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	// $storeprocedure = mysqli_query($dbcon->conn(), $sql);
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
	case 'getMisProducciones':
		getMisProducciones($dbcon);
		break;
	case 'eliminarCaptura':
		eliminarCaptura($dbcon, $objDatos);
		break;
}
?>
