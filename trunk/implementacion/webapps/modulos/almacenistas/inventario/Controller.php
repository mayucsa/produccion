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
function ssInventarioBloquera($dbcon){
	$sql = "SELECT area, numero_estiba , spb.nombre_producto, presentacion, num_celdas, cantidad_estiba  
			FROM seg_inventario_estibas sie 
    		INNER JOIN seg_producto_bloquera spb ON spb.cve_bloquera = sie.nombre_producto
    		WHERE estatus_estiba = 'VIG' AND cantidad_estiba > 0
    		ORDER BY numero_estiba ASC";
    $datos = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
    // foreach ($datos as $i => $row) {
    	// $row->Diferencia = getDifHoras($row->hora_inicio, $row->hora_fin);
    	// $row->Turno = getTurno($row->fecha_registro);
    // }
    dd($datos);
}
function roturadiaria($dbcon, $Datos){
	$fecha = date('Y-m-d H:i:s');
	$vacio = 'vacio';
	$status = 'VIG';
	$celda = '1';
	$conn = $dbcon->conn();

	$cBuilder = "SELECT nombre_producto, numero_estiba, cantidad_estiba FROM seg_inventario_estibas WHERE numero_estiba = ".$Datos->estiba;
	$cBuilder = $dbcon->qBuilder($conn, 'first', $cBuilder);
	// dd($cBuilder);

	$ctrl ="INSERT INTO seg_rotura_diaria(numero_estiba, cve_bloquera, cantidad_estiba_antes, cantidad_rotura, usuario, estatus_rotura, fecha_registro)
			VALUES(".$Datos->estiba.", ".$cBuilder->nombre_producto.", ".$cBuilder->cantidad_estiba.", ".$Datos->cantidad.", ".$Datos->id.", '".$status."', '".$fecha."' ) ";
	$ctrlBuilder = $dbcon->qBuilder($dbcon->conn(), 'do', $ctrl);
	// dd($ctrl);

	$sqlu = "UPDATE seg_inventario_estibas SET cantidad_estiba = cantidad_estiba - ".$Datos->cantidad."  WHERE numero_estiba = ".$Datos->estiba." ";
	$uBuilder = $dbcon->qBuilder($dbcon->conn(), 'do', $sqlu);
	// dd($sqlu);

	$sqlup = "UPDATE seg_inventario_patios SET cantidad_inventario = cantidad_inventario - ".$Datos->cantidad."  WHERE cve_bloquera = ".$cBuilder->nombre_producto." ";
	$uBuilder = $dbcon->qBuilder($dbcon->conn(), 'do', $sqlup);
	// dd($sqlup);

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
	case 'ssInventarioBloquera':
		ssInventarioBloquera($dbcon);
		break;
	case 'roturadiaria':
		roturadiaria($dbcon, $objDatos);
		break;
}
?>
