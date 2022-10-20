<?php 
require_once "../../../includes/php/classes_excel/PHPExcel.php";
include_once "modelo_estiba.php";
// header("Content-Type: application/xls");
// header("Content-Disposition: attachment; filename= inventario.xls");
$objModelo = new modeloInventario();

// $titles = array('Producto', 'Materia Prima', 'Quimicos');
$sheet = 0;
// $sheet = 1;

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


// $objPHPExcel->createSheet();
// $objPHPExcel = new PHPExcel_Worksheet ( $objPHPExcel , 'My Data' );
            $objPHPExcel -> getSheet ( 1 );
            $objPHPExcel -> getSheetByName ( 'Hoja de trabajo 1' );

// $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');
// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Mayucsa - Mayamat ');
// $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:F2');
// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'INVENTARIO DE BLOQUERA POR ESTIBAS');
// $objPHPExcel->setActiveSheetIndex(0)->mergeCells('H2:I2');
// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', '=AHORA()');
// $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:F1')->applyFromArray($titulos); 


// $objPHPExcel->setActiveSheetIndex(0)
// ->setCellValue('A3', 'Area')        
// ->setCellValue('B3', 'Nombre de producto')
// ->setCellValue('C3', 'Presentación')        
// ->setCellValue('D3', 'Numero de celdas')
// ->setCellValue('E3', 'Número de estiba')
// ->setCellValue('f3', 'Cantidad por estiba')
// ;

// $objPHPExcela->setActiveSheetIndex(1)
// ->setCellValue('A3', 'Area')        
// ->setCellValue('B3', 'Nombre de producto')
// ->setCellValue('C3', 'Presentación')        
// ->setCellValue('D3', 'Numero de celdas')
// ->setCellValue('E3', 'Número de estiba')
// ->setCellValue('f3', 'Cantidad por estiba')
// ;

// $objPHPExcel->setActiveSheetIndex(0)->getStyle('A3:F3')->applyFromArray($encabezado);
// $objPHPExcel->setActiveSheetIndex(0)->getStyle('H3:I3')->applyFromArray($encabezado);


	// $datos = $objModelo->mostrarExcel();
	// $ite = 4;

	// foreach ($datos as $clave) {
 //            $objPHPExcel->setActiveSheetIndex(0)
 //            ->setCellValue('A'.$ite, $clave['area'])        
 //            ->setCellValue('B'.$ite, $clave['nombre_producto'])
 //            ->setCellValue('C'.$ite, $clave['presentacion'])
 //            ->setCellValue('D'.$ite, $clave['num_celdas'])
 //            ->setCellValue('E'.$ite, $clave['numero_estiba'])
 //            ->setCellValue('F'.$ite, $clave['cantidad_estiba'])
 //            ;

 //      $ite++;
	// }
	// $data = $obj->

for($i = 'A'; $i <= 'Z'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
    // $objPHPExcela->setActiveSheetIndex(1)->getColumnDimension($i)->setAutoSize(TRUE);
}
$objPHPExcel->getActiveSheet()->setTitle('Mayucsa');
$objPHPExcel->setActiveSheetIndex(0);
// $objPHPExcela->getActiveSheet()->setTitle('Mayucsa');
// $objPHPExcela->setActiveSheetIndex(1);
// $objPHPExcel -> addSheet ( $myWorkSheet , 0 );
$objPHPExcel->getActiveSheet();



/*------------------------------------------------------------------------------------------------------*/


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Inventario del mes.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
 ?>