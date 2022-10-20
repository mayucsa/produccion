<?php
include_once "../../../dbconexion/conexion.php";
// header('Content-Type: application/json');

// DB table to use
$table = 'seg_inventario_estibas';
 
// Table's primary key
$primaryKey = 'cve_estiba';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
// $var    = "estatus_registro = 'VIG'";
$var    = "estatus_estiba = 'VIG' AND cantidad_estiba > 0 ";
$order  = "ORDER BY numero_estiba ASC LIMIT 15";
$columns = array(
    array( 'db' => 'area',                  'dt' => 0 ),
    array( 'db' => 'nombre_producto',       'dt' => 1 ),
    array( 'db' => 'num_celdas',            'dt' => 2 ),
    array( 'db' => 'presentacion',          'dt' => 3 ),
    array( 'db' => 'numero_estiba',         'dt' => 4 ),
    array( 'db' => 'cantidad_estiba',       'dt' => 5,
                    'formatter' => function( $d, $row ) {
            return number_format($d).' Pza';
        } ),
    array( 'db' => 'cve_estiba',         'dt' => 7 ),
);
 
// SQL server connection information

// $sql_details = array(
//     'user' => 'root',
//     'pass' => '',
//     'db'   => 'produccionmayucsa',
//     'host' => 'localhost'
// );
$sql_details = array(
    'user' => 'mayucsac_root',
    'pass' => '$oportemys#1',
    'db'   => 'mayucsac_produccionmayucsa',
    'host' => '162.241.62.122'
);
// $sql_details = array(
//     'user' => 'mayucsac_root',
//     'pass' => '$oportemys#1',
//     'db'   => 'mayucsac_prue_produccion',
//     'host' => '162.241.62.122'
// );
// $sql_details = array(
//     'user' => 'mayucsac_root',
//     'pass' => '$oportemys#1',
//     'db'   => 'mayucsac_produccion',
//     'host' => '162.241.62.122'
// );
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../../../includes/js/data_tables_js/ssp.class.php' );
 
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $var)
);
?>