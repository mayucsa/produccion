<?php 
require_once "../../../includes/php/classes_excel/PHPExcel.php";
include_once "modelo_saqueria.php";
// header("Content-Type: application/xls");
// header("Content-Disposition: attachment; filename= inventario.xls");
$objModelo = new modeloSaqueria();

$titles = array('Producto', 'Materia Prima', 'Quimicos');
$sheet = 0;

$titulos = array(
        'font' => array('bold' => true,  'size' => '12'),
        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
        'alignment' => array('certical' => PHPExcel_Style_Alignment::VERTICAL_TOP,),
);

$encabezado = array(
        'font' => array( 'bold' => true,  'size' => '12', 'color' => array('rgb' => 'FFFFFF'),),
        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
        'alignment' => array('certical' => PHPExcel_Style_Alignment::VERTICAL_TOP,),
        'fill' => array('type' =>  PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '1A4672')),
);

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()
            ->setCreator("Mayucsa")
            ->setLastModifiedBy("Mayucsa")
            ->setTitle("Documento Excel Mayucsa")
            ->setSubject("Documento Excel Mayucsa")
            ->setDescription("")
            ->setKeywords("")
            ->setCategory("");

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Mayucsa - Mayamat ');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:F2');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'INVENTARIO DE PRODUCTO FINALIZADO');
// $objPHPExcel->setActiveSheetIndex(0)->mergeCells('H2:I2');
// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', 'INVENTARIO DE MATERIA PRIMA ');
// $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:F1')->applyFromArray($titulos); 


$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A3', 'Tipo de movimiento')        
->setCellValue('B3', 'Codigo')
->setCellValue('C3', 'Concepto')        
->setCellValue('D3', 'Presentacion')
->setCellValue('E3', 'Cantidad')
->setCellValue('F3', 'Fecha de movimiento')
// ->setCellValue('I3', 'Cantidad en KG')
// ->setCellValue('I3', 'Cantidad en KG')
;

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3:F3')->applyFromArray($encabezado);
// $objPHPExcel->setActiveSheetIndex(0)->getStyle('H3:I3')->applyFromArray($encabezado);

    // $fecha_inicio = $_POST['fecha_inicio'];
    // $fecha_fin = $_POST['fecha_fin'];
    if (strlen($_GET['fecha_inicio'])>0 AND strlen($_GET['fecha_fin'])>0) {
            $fecha_inicio = $_GET['fecha_inicio'];
            $fecha_fin = $_GET['fecha_fin'];
            }

	$datos = $objModelo->descargaExcel($fecha_inicio, $fecha_fin);
	$ite = 4;

	foreach ($datos as $clave) {
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ite, $clave['tipo'])        
            ->setCellValue('B'.$ite, $clave['codigo'])
            ->setCellValue('C'.$ite, $clave['cve_producto'])
            ->setCellValue('D'.$ite, $clave['valor_presentacion'])
            ->setCellValue('E'.$ite, $clave['sacos_totales'])
            ->setCellValue('F'.$ite, $clave['fecha_registro'])
            ;

      $ite++;
	}
	// $data = $obj->

for($i = 'A'; $i <= 'Z'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
}
$objPHPExcel->getActiveSheet()->setTitle('Mayucsa');
$objPHPExcel->setActiveSheetIndex(0);


/*------------------------------------------------------------------------------------------------------*/


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte Saqueria.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
 ?>