<?php
/*
	Creación de PDF
	Author: Ismael Castrejón
	Fecha: 06/01/2023
// */
session_start();
require '../../../vendor/autoload.php';
include_once "../../../dbconexion/conn.php";
use Dompdf\Dompdf;
use Dompdf\Options;

$dompdf = new Dompdf();
$path = '../../../includees/imagenes/Mayucsa.png';
$data = file_get_contents($path); 
$dbcon	= 	new MysqlConn;
$sql = "SELECT prod.fecha_registro, cve_produccion_bloquera, horometro_inicial, horometro_final,
horometro_diferencia, nombre_producto, presentacion, num_celdas, Bandejas_producidas, 
Piezas_totales + cant_pesadas as piezas, Consumototal_cemento, Cementopor_pieza, Tiempo_llenado, 
Consumo_aditivo, humedad, Peso_promedio, Cant_pesadas, Cantidad_polvo, Segundos_polvo, Cantidad_gravilla, 
Cantidad_polvo, Segundos_polvo, Cantidad_gravilla, segundos_gravilla, porcent_polvo, porcent_gravilla, 
Cementopor_barcada, Cantidad_barcadas, Consumototal_cemento, Cantidad_gravillados, Segundos_gravillados, 
porcent_gravillados, prod.usuario
FROM captura_produccionbloquera AS prod 
INNER JOIN seg_producto_bloquera AS inv ON inv.cve_bloquera = prod.cve_bloquera 
WHERE prod.estatus_registro = 'VIG' AND inv.area = 'Besser'
AND prod.cve_produccion_bloquera = ".$_GET['id'];
// 
$res = $dbcon->qBuilder($dbcon->conn(), 'first', $sql);
$sql = "SELECT nombre, apellido, puesto FROM cat_usuarios WHERE cve_usuario = ".$res->usuario;
$usuario = $dbcon->qBuilder($dbcon->conn(),'first', $sql);
// 
$turno = isset(explode(' ', $res->fecha_registro)[1])?explode(' ', $res->fecha_registro)[1]:'00:00:00';
if ($turno >=  '01:00:00' && $turno <= '09:00:00'){
	$turno = '3er Turno';
} if ($turno >=  '09:00:01' && $turno <= '18:00:00'){
	$turno = '1er Turno';
} if ($turno >=  '18:00:01' && $turno <= '23:59:59'){
	$turno = '2do Turno';
}
$Html = '
<div class="container-fluid">
		<table style="width:100%">
			<tr>
				<td style="width: 25%;">
				<img src="data:image/gif;base64,' . base64_encode($data) . '" style="width: 100%;">
				</td>
				<td style="padding: 20px;">
					<h4>
						REPORTE DIARIO DE PRODUCCIÓN Y MOVIMIENTO DE MATERIALES EN BLOQUERA BESSER
					</h4>
				</td>
			</tr>
		</table>
		<table style="width: 80%; margin-left: 10%;">
			<tr>
				<td>
					'.(explode(' ', $res->fecha_registro)[0]).'
					<br>
					<span><b>FOLIO:</b> '.$res->cve_produccion_bloquera.'</span>
					<br>
					<br>
					<span><b>HOROMETRO INICIAL:</b> '.$res->horometro_inicial.'</span>
					<br>
					<span><b>HOROMETROFINAL:</b> '.$res->horometro_final.'</span>
					<br>
					<span><b>DIFERENCIA:</b> '.$res->horometro_diferencia.'</span>
				</td>
				<td>
					<table class="table table-bordered" style="border-collapse: collapse; width:90%;">
						<tr style="border: solid 1px;">
							<th>PRODUCTO</th>
						</tr>
						<tr style="border: solid 1px;">
							<td>
								'.$res->nombre_producto.' – '.$res->presentacion.' – '.$res->num_celdas.' 
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<div class="row" style=" margin-top: 10px;">
			<table class="table table-bordered" style="width: 60%; margin-left:20%; border-collapse: collapse;">
				<tr>
					<th style="border: solid 1px; text-align: left;">TIPO DE POLVO</th>
					<td style="border: solid 1px; text-align: right;">'.$turno.'</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">N° DE BANDEJAS BRUTAS</th>
					<td style="border: solid 1px; text-align: right;">Bandejas_p'.$res->Bandejas_producidas.'roducidas</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">N° DE PIEZAS</th>
					<td style="border: solid 1px; text-align: right;">'.$res->piezas.'</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">CONSUMO DE CEMENTO</th>
					<td style="border: solid 1px; text-align: right;">'.$res->Consumototal_cemento.'</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">Grs. CEMENTO POR PIEZA </th>
					<td style="border: solid 1px; text-align: right;">'.$res->Cementopor_pieza.'</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">TIEMPO DE LLENADO</th>
					<td style="border: solid 1px; text-align: right;">'.$res->Tiempo_llenado.'</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">CONSUMO DE ADITIVO</th>
					<td style="border: solid 1px; text-align: right;">'.$res->Consumo_aditivo.'</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">HUMEDAD</th>
					<td style="border: solid 1px; text-align: right;">'.$res->humedad.'</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">PESO PROMEDIO</th>
					<td style="border: solid 1px; text-align: right;">'.$res->Peso_promedio.'</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">PESADAS</th>
					<td style="border: solid 1px; text-align: right;">'.$res->Cant_pesadas.'</td>
				</tr>
			</table>
			<table style="margin-top: 10px; border-collapse: collapse; border: solid 1px;">
				<tr>
					<th style="text-align: center; border: solid 1px;" colspan="9">CAMBIOS DE DOSIFICACIÓN</th>
				</tr>
				<tr>
					<td style=" border: solid 1px; text-align: center;" colspan="2">LATAS</td>
					<td style=" border: solid 1px; text-align: center;" colspan="2">GRAVILLA</td>
					<td style=" border: solid 1px; text-align: center;" colspan="2">% AGREGS.</td>
					<td style=" border: solid 1px; text-align: center;" rowspan="2">KG De Cemento P/ barcada</td>
					<td style=" border: solid 1px; text-align: center;" rowspan="2">N° De Barcadas</td>
					<td style=" border: solid 1px; text-align: center;" rowspan="2">TOTAL CEMENTO</td>
				</tr>
				<tr>
					<td style=" border: solid 1px; text-align: center;">LATA</td>
					<td style=" border: solid 1px; text-align: center;">SEGS.</td>
					<td style=" border: solid 1px; text-align: center;">LATA</td>
					<td style=" border: solid 1px; text-align: center;">SEGS.</td>
					<td style=" border: solid 1px; text-align: center;">POLVO</td>
					<td style=" border: solid 1px; text-align: center;">GRAVILLA</td>
				</tr>
				<tr>
					<td style="border: solid 1px; font-size:12px; text-align: right;">'.$res->Cantidad_polvo.'</td>
					<td style="border: solid 1px; font-size:12px; text-align: right;">'.$res->Segundos_polvo.'</td>
					<td style="border: solid 1px; font-size:12px; text-align: right;">'.$res->Cantidad_gravilla.'</td>
					<td style="border: solid 1px; font-size:12px; text-align: right;">'.$res->segundos_gravilla.'</td>
					<td style="border: solid 1px; font-size:12px; text-align: right;">'.$res->porcent_polvo.'</td>
					<td style="border: solid 1px; font-size:12px; text-align: right;">'.$res->porcent_gravilla.'</td>
					<td style="border: solid 1px; font-size:12px; text-align: right;" rowspan="2">'.$res->Cementopor_barcada.'</td>
					<td style="border: solid 1px; font-size:12px; text-align: right;" rowspan="2">'.$res->Cantidad_barcadas.'</td>
					<td style="border: solid 1px; font-size:12px; text-align: right;" rowspan="2">'.$res->Consumototal_cemento.'</td>
				</tr>
				<tr>
					<td style="border: solid 1px; font-size:12px; text-align: right;" colspan="2"></td>
					<td style="border: solid 1px; font-size:12px; text-align: right;">'.$res->Cantidad_gravillados.'</td>
					<td style="border: solid 1px; font-size:12px; text-align: right;">'.$res->Segundos_gravillados.'</td>
					<td style="border: solid 1px; font-size:12px; text-align: right;"></td>
					<td style="border: solid 1px; font-size:12px; text-align: right;">'.$res->porcent_gravillados.'</td>
				</tr>
			</table>
		</div>
		<div class="row" style="margin-top: 100px; width: 30%; margin-left:35%;">
			<div class="col-4 offset-4 mt-4 pt-4">
				<center>
					<hr>
					'.$usuario->nombre.' '.$usuario->apellido.'
					<br>
					'.$usuario->puesto.'
				</center>
			</div>
		</div>
	</div>
';
try{
	$options = new Options();
	$options->set('isRemoteEnabled', TRUE);
	$options->set('isHtml5ParserEnabled', true);
	$dompdf = new DOMPDF($options);
	$dompdf->loadHtml($Html);
	$dompdf->render();
	$dompdf->stream('REPORTE_DIARIO_DE_PRODUCCION_Y_MOVIMIENTO_DE_MATERIALES_EN_BLOQUERA_BESSER.pdf');
	// $contenido = $dompdf->output();
	// // Asignamos nombre de archivo con la función RAND()
	// $nombreDelDocumento = "REPORTE_DIARIO_DE_PRODUCCION_Y_MOVIMIENTO_DE_MATERIALES_EN_BLOQUERA_BESSER.pdf";
	// $path = '../../../includees/PDF/'.$_SESSION['id'].'/';
	// if (!file_exists($path)) mkdir($path, 0777, true);
	// $bytes = file_put_contents($path.$nombreDelDocumento, $contenido);
	// echo $path.$nombreDelDocumento.'<br>';
}catch(\Exception $e){
	return [
		'code' => 400,
		'msj' => 'Error al guardar el PDF de la factura.'
	];
}
// echo 'Generado';
// return [
// 	'path' => $path,
// 	'pathfile' => $path.$nombreDelDocumento,
// 	'nombreDelDocumento' => $nombreDelDocumento,
// 	'code' => 200
// ];
?>

	