<?php 
require_once "../../../includes/php/classes_excel/PHPExcel.php";
include_once "modelo_inventario.php";
// header("Content-Type: application/xls");
// header("Content-Disposition: attachment; filename= inventario.xls");
$objModelo = new modeloInventario();

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

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:E1');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Mayucsa - Mayamat ');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:E2');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'INVENTARIO DE PRODUCTO FINALIZADO');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('H2:I2');
// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', 'INVENTARIO DE MATERIA PRIMA ');
// $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:F1')->applyFromArray($titulos); 


$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A3', 'Producto')        
->setCellValue('B3', 'Presentacion')
->setCellValue('C3', 'Cantidad en Tonelada')        
->setCellValue('D3', 'Cantidad en KG')
->setCellValue('E3', 'Cantidad de Sacos')
// ->setCellValue('H3', 'Materia Prima')
// ->setCellValue('I3', 'Cantidad en KG')
// ->setCellValue('I3', 'Cantidad en KG')
;

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3:E3')->applyFromArray($encabezado);
// $objPHPExcel->setActiveSheetIndex(0)->getStyle('H3:I3')->applyFromArray($encabezado);


	$datos = $objModelo->mostrarExcel();
	$ite = 4;

	foreach ($datos as $clave) {
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ite, $clave['nombre_producto'])        
            ->setCellValue('B'.$ite, $clave['valor_presentacion'])
            ->setCellValue('C'.$ite, $clave['tonelada'])
            ->setCellValue('D'.$ite, $clave['cantidad'])
            ->setCellValue('E'.$ite, $clave['sacos'])
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
header('Content-Disposition: attachment;filename="Inventario Producto.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
 ?>