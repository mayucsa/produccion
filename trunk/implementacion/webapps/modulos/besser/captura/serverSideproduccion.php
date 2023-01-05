<?php
session_start();
include_once "../../../dbconexion/conexion.php";
// header('Content-Type: application/json');

// DB table to use
$table = 'captura_produccionbloquera';
 
// Table's primary key
$primaryKey = 'cve_produccion_bloquera';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$var    = "prod.estatus_registro = 'VIG' AND inv.area = 'Besser'";

$columns = [
    ['db' => '`prod`.`cve_produccion_bloquera`', 'dt' => 0, 'field' => 'cve_produccion_bloquera'],
    ['db' => '`inv`.`nombre_producto`', 'dt' => 1, 'formatter' => function($d, $row){
        return $d.' - '.$row[10]. ' - '.$row[11]. ' Celdas';
    }, 'field' => 'nombre_producto'],
    ['db' => '`prod`.`cantidad_barcadas`', 'dt' => 2, 'field' => 'cantidad_barcadas'],
    ['db' => '`prod`.`bandejas_producidas`', 'dt' => 3, 'field' => 'bandejas_producidas'],
    ['db' => '`prod`.`piezas_totales`', 'dt' => 4, 'field' => 'piezas_totales'],
    ['db' => '`prod`.`consumototal_cemento`', 'dt' => 5, 'field' => 'consumototal_cemento'],
    ['db' => '`prod`.`consumo_aditivo`', 'dt' => 6, 'field' => 'consumo_aditivo'],
    ['db' => '`prod`.`fecha_registro`', 'dt' => 7, 'formatter' => function( $d, $row ) {
            return date( 'Y-m-d', strtotime($d));
        }, 'field' => 'fecha_registro'],
    ['db' => '`prod`.`fecha_registro`', 'dt' => 8, 'formatter' => function( $d, $row ) {
        return date( 'H:i:s', strtotime($d));
    }, 'field' => 'fecha_registro'],
    ['db' => '`prod`.`cve_produccion_bloquera`', 'dt' => 9, 'formatter' => function($d, $row){
        if ($_SESSION['produccion_besser_edit'] == 1 ) {
            return  '<a class= "btn btn-warning" href="odcPDFformato.php?cve_odc='.$row[0].'" target="_blank" title="Descargar PDF"><i class="fas fa-file-pdf"></i> </a>' . ' '.
                    '<span class= "btn btn-danger" onclick= "eliminar('.$row[0].')" title="Eliminar"><i class="fas fa-window-close"></i> </span>';
        } else{
            return '<a class= "btn btn-warning" href="odcPDFformato.php?cve_odc='.$row[0].'" target="_blank" title="Descargar PDF"><i class="fas fa-file-pdf"></i> </a>';
        }
    }, 'field' => 'cve_produccion_bloquera'],
    ['db' => '`inv`.`presentacion`', 'dt' => 10, 'field' => 'presentacion'],
    ['db' => '`inv`.`num_celdas`', 'dt' => 11, 'field' => 'num_celdas'],
];

 $joinQuery = " FROM `{$table}` AS `prod` 
                INNER JOIN `seg_producto_bloquera` AS `inv` ON (`inv`.`cve_bloquera` = `prod`.`cve_bloquera`)
                ";

// SQL server connection information


include_once "../../../dbconexion/conexionServerSide.php";
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../../../includes/js/data_tables_js/sspjoin.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $var )
);
?>