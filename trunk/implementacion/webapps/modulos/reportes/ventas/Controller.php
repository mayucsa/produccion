<?php 
require_once '../../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

date_default_timezone_set('America/Chihuahua');
function dd($var){
    if (is_array($var) || is_object($var)) {
        die(json_encode($var));
    }else{
        die($var);
    }
}


function ventasbloquera($dbcon, $fecha){
	$total1 = 0;
	$total2 = 0;
	$total3 = 0;
	$total4 = 0;
	$total5 = 0;
	$total6 = 0;
	$total7 = 0;
	$total8 = 0;
	$total9 = 0;
	$total10 = 0;
	$total11 = 0;
	$sql = " 	SELECT CAST(ssb.CFOLIO as int) as CFOLIO, spb.area, ssb.cod_producto,
				CASE
					WHEN ssb.cod_producto = 'B201' THEN
						IFNULL(CUNIDADESCAPTURADASO, 0) ELSE 0 END AS B1,
				CASE
					WHEN ssb.cod_producto = 'B304' THEN
						IFNULL(CUNIDADESCAPTURADASO, 0) ELSE 0 END AS B2,
				CASE
					WHEN ssb.cod_producto = 'B301' THEN
						IFNULL(CUNIDADESCAPTURADASO, 0) ELSE 0 END AS B3,
				CASE
					WHEN ssb.cod_producto = 'B101' THEN
						IFNULL(CUNIDADESCAPTURADASO, 0) ELSE 0 END AS B4,
				CASE
					WHEN ssb.cod_producto = 'B206' THEN
						IFNULL(CUNIDADESCAPTURADASO, 0) ELSE 0 END AS B5,
				CASE
					WHEN ssb.cod_producto = 'B316' THEN
						IFNULL(CUNIDADESCAPTURADASO, 0) ELSE 0 END AS B6,
				CASE
					WHEN ssb.cod_producto = 'B401' THEN
						IFNULL(CUNIDADESCAPTURADASO, 0) ELSE 0 END AS B7,
				CASE
					WHEN ssb.cod_producto = 'B501' THEN
						IFNULL(CUNIDADESCAPTURADASO, 0) ELSE 0 END AS B8,
				CASE
					WHEN ssb.cod_producto = 'B801' THEN
						IFNULL(CUNIDADESCAPTURADASO, 0) ELSE 0 END AS B9,
				CASE
					WHEN ssb.cod_producto = 'B901' THEN
						IFNULL(CUNIDADESCAPTURADASO, 0) ELSE 0 END AS B10,
				CASE
					WHEN ssb.cod_producto = 'B001' THEN
						IFNULL(CUNIDADESCAPTURADASO, 0) ELSE 0 END AS B11,
				ad.CRAZONSOCIAL, ad.CTEXTOEXTRA2, ssb.fecha_registro
				FROM seg_salidas_bloquera ssb
				INNER JOIN admDocumentos ad ON ssb.CFOLIO = ad.CFOLIO
				INNER JOIN seg_producto_bloquera spb ON ssb.cod_producto = spb.cod_producto 
				WHERE ssb.fecha_registro >= DATE('".$fecha."')
				ORDER BY ssb.fecha_registro ASC ";
	$ventas = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	$resultado = [];
	$aux = 0;
	$w = 0;
	foreach ($ventas as $i => $val) {
		if($i == 55){
			$aux++; $w = 0;
		}
		if(($i - 55 ) % 65 == 0){
			$aux++; $w = 0;
		}
		// $val->fecha_registro = explode(' ', $val->fecha_registro)[0];
		$resultado[$aux][$i] = $val;
		
		$w++;
		$total1 += floatval($val->B1);
		$total2 += floatval($val->B2);
		$total3 += floatval($val->B3);
		$total4 += floatval($val->B4);
		$total5 += floatval($val->B5);
		$total6 += floatval($val->B6);
		$total7 += floatval($val->B7);
		$total8 += floatval($val->B8);
		$total9 += floatval($val->B9);
		$total10 += floatval($val->B10);
		$total11 += floatval($val->B11);
	}
	dd([
		'datos' => $resultado,
		'total1' => $total1,
		'total2' => $total2,
		'total3' => $total3,
		'total4' => $total4,
		'total5' => $total5,
		'total6' => $total6,
		'total7' => $total7,
		'total8' => $total8,
		'total9' => $total9,
		'total10' => $total10,
		'total11' => $total11,
		'fecha' => $fecha
	]);
}
function ventastrituradora($dbcon, $fecha){
	$total1 = 0;
	$total2 = 0;
	$total3 = 0;
	$total4 = 0;
	$sql = " 	SELECT CAST(sst.CFOLIO as int) as CFOLIO,sst.cod_producto, 
				CASE
					WHEN sst.cod_producto = 'T210' OR sst.cod_producto = 'T211' THEN
						IFNULL(sst.CUNIDADESCAPTURADAS , 0) ELSE 0 END AS POLVO,
				CASE
					WHEN sst.cod_producto = 'T220' OR sst.cod_producto = 'T221' THEN
						IFNULL(sst.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS GRAVA,
				CASE
					WHEN sst.cod_producto = 'T230' OR sst.cod_producto = 'T231' THEN
						IFNULL(sst.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS GRAVILLA,
				CASE
					WHEN sst.cod_producto = 'T240' OR sst.cod_producto = 'T241' THEN
						IFNULL(sst.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS MATERIAL,
				ad.CRAZONSOCIAL, ad.CTEXTOEXTRA2, fecha_registro
				FROM seg_salidas_trituradora sst
				INNER JOIN admDocumentos ad ON sst.CFOLIO = ad.CFOLIO
				WHERE fecha_registro >= DATE('".$fecha."')
				ORDER BY fecha_registro ASC ";
	$ventas = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	$resultado = [];
	$aux = 0;
	$w = 0;
	foreach ($ventas as $i => $val) {
		if($i == 55){
			$aux++; $w = 0;
		}
		if(($i - 55 ) % 65 == 0){
			$aux++; $w = 0;
		}
		// $val->fecha_registro = explode(' ', $val->fecha_registro)[0];
		$resultado[$aux][$i] = $val;
		
		$w++;
		$total1 += floatval($val->POLVO);
		$total2 += floatval($val->GRAVA);
		$total3 += floatval($val->GRAVILLA);
		$total4 += floatval($val->MATERIAL);
	}
	dd([
		'datos' => $resultado,
		'total1' => $total1,
		'total2' => $total2,
		'total3' => $total3,
		'total4' => $total4,
		'fecha' => $fecha
	]);
}
function ventasmortero($dbcon, $fecha){
	$total1 = 0;
	$total2 = 0;
	$total3 = 0;
	$total4 = 0;
	$total5 = 0;
	$total6 = 0;
	$total7 = 0;
	$total8 = 0;
	$total9 = 0;
	$total10 = 0;
	$total11 = 0;
	$total12 = 0;
	$total13 = 0;
	$total14 = 0;
	$total15 = 0;
	$total16 = 0;
	$total17 = 0;
	$total18 = 0;
	$total19 = 0;
	$total20 = 0;
	$total21 = 0;
	$total22 = 0;
	$total23 = 0;
	$total24 = 0;
	$sql = " 	SELECT CAST(ss.CFOLIO as int) as CFOLIO, ss.cod_producto,
				CASE
					WHEN ss.cod_producto = 'M510' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B1,
				CASE
					WHEN ss.cod_producto = 'M516' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B2,
				CASE
					WHEN ss.cod_producto = 'M520' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B3,
				CASE
					WHEN ss.cod_producto = 'M599' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B4,
				CASE
					WHEN ss.cod_producto = 'M540' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B5,
				CASE
					WHEN ss.cod_producto = 'M581' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B6,
				CASE
					WHEN ss.cod_producto = 'M530' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B7,
				CASE
					WHEN ss.cod_producto = 'M586' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B8,
				CASE
					WHEN ss.cod_producto = 'M563' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B9,
				CASE
					WHEN ss.cod_producto = 'M648' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B10,
				CASE
					WHEN ss.cod_producto = 'M596' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B11,
				CASE
					WHEN ss.cod_producto = 'M579' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B12,
				CASE
					WHEN ss.cod_producto = 'M588' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B13,
				CASE
					WHEN ss.cod_producto = 'M582' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B14,
				CASE
					WHEN ss.cod_producto = 'M583' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B15,
				CASE
					WHEN ss.cod_producto = 'M574' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B16,
				CASE
					WHEN ss.cod_producto = 'M562' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B17,
				CASE
					WHEN ss.cod_producto = 'M587' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B18,
				CASE
					WHEN ss.cod_producto = 'M703' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B19,
				CASE
					WHEN ss.cod_producto = 'M589' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B20,
				CASE
					WHEN ss.cod_producto = 'M550' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B21,
				CASE
					WHEN ss.cod_producto = 'M572' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B22,
				CASE
					WHEN ss.cod_producto = 'M597' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B23,
				CASE
					WHEN ss.cod_producto = 'M781' THEN
						IFNULL(ss.CUNIDADESCAPTURADAS, 0) ELSE 0 END AS B24,
				ad.CRAZONSOCIAL, ad.CTEXTOEXTRA2, ss.fecha_registro 
				FROM seg_salidas ss
				INNER JOIN admDocumentos ad ON ss.CFOLIO = ad.CFOLIO
				WHERE ss.fecha_registro >= DATE('".$fecha."')
				ORDER BY fecha_registro ASC ";
	$ventas = $dbcon->qBuilder($dbcon->conn(), 'all', $sql);
	$resultado = [];
	$aux = 0;
	$w = 0;
	foreach ($ventas as $i => $val) {
		if($i == 55){
			$aux++; $w = 0;
		}
		if(($i - 55 ) % 65 == 0){
			$aux++; $w = 0;
		}
		// $val->fecha_registro = explode(' ', $val->fecha_registro)[0];
		$resultado[$aux][$i] = $val;
		
		$w++;
		$total1 += floatval($val->B1);
		$total2 += floatval($val->B2);
		$total3 += floatval($val->B3);
		$total4 += floatval($val->B4);
		$total5 += floatval($val->B5);
		$total6 += floatval($val->B6);
		$total7 += floatval($val->B7);
		$total8 += floatval($val->B8);
		$total9 += floatval($val->B9);
		$total10 += floatval($val->B10);
		$total11 += floatval($val->B11);
		$total12 += floatval($val->B12);
		$total13 += floatval($val->B13);
		$total14 += floatval($val->B14);
		$total15 += floatval($val->B15);
		$total16 += floatval($val->B16);
		$total17 += floatval($val->B17);
		$total18 += floatval($val->B18);
		$total18 += floatval($val->B19);
		$total20 += floatval($val->B20);
		$total21 += floatval($val->B21);
		$total22 += floatval($val->B22);
		$total23 += floatval($val->B23);
		$total24 += floatval($val->B24);
	}
	dd([
		'datos' => $resultado,
		'total1' => $total1,
		'total2' => $total2,
		'total3' => $total3,
		'total4' => $total4,
		'total5' => $total5,
		'total6' => $total6,
		'total7' => $total7,
		'total8' => $total8,
		'total9' => $total9,
		'total10' => $total10,
		'total11' => $total11,
		'total12' => $total12,
		'total13' => $total13,
		'total14' => $total14,
		'total15' => $total15,
		'total16' => $total16,
		'total17' => $total17,
		'total18' => $total18,
		'total19' => $total19,
		'total20' => $total20,
		'total21' => $total21,
		'total22' => $total22,
		'total23' => $total23,
		'total24' => $total24,
		'fecha' => $fecha
	]);
}
// 
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
	case 'ventasbloquera':
		ventasbloquera($dbcon, $objDatos->fecha);
		break;
	case 'ventastrituradora':
		ventastrituradora($dbcon, $objDatos->fecha);
		break;
	case 'ventasmortero':
		ventasmortero($dbcon, $objDatos->fecha);
		break;
}

?>