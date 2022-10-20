<?php
include_once "../../../dbconexion/conexion.php";
// header('Content-Type: application/json');

// DB table to use
$table = 'seg_desalojo';
 
// Table's primary key
$primaryKey = 'cve_desalojo';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
// $var    = "estatus_registro = 'VIG'";
$var    = "estatus_desalojo = 'VIG' AND confirmacion = 'False'";
$columns = array(
    array( 'db' => 'area',   'dt' => 0 ),
    array( 'db' => 'nombre_producto',   'dt' => 1 ),
    array( 'db' => 'presentacion',      'dt' => 2 ),
    array( 'db' => 'num_celdas',      'dt' => 3 ),
    array( 'db' => 'cantidad_total',          'dt' => 4,
                    'formatter' => function( $d, $row ) {
            return number_format($d).' Pza';
        } ),
    // array( 'db' => 'cantidad_rotura',          'dt' => 4,
    //                 'formatter' => function( $d, $row ) {
    //         return number_format($d).' Pza';
    //     } ),
    array( 'db' => 'cantidad_despuntados',          'dt' => 5,
                    'formatter' => function( $d, $row ) {
            return number_format($d).' Pza';
        } ),
    array( 'db' => 'cantidad_rotura',          'dt' => 6,
                    'formatter' => function( $d, $row ) {
            return number_format($d).' Pza';
        } ),
    array( 'db' => 'cve_desalojo',       'dt' => 7),
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
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $var )
);
?>