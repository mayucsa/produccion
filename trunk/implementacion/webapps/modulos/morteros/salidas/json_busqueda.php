<?php
include_once "../../../dbconexion/conexion.php";
// header('Content-Type: application/json');

// DB table to use
$table = 'seg_salidas';
 
// Table's primary key
$primaryKey = 'cve_salida';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$condicion =  "estatus_salida = 'VIG'";
$columns = array(
    array( 'db' => 'nombre_salida',         'dt' => 0 ),
    array( 'db' => 'presentacion_salida',   'dt' => 1 ),
    array( 'db' => 'cantidad_salida',       'dt' => 2,
                    'formatter' => function( $d, $row ) {
            return number_format($d);
        } ),
    array( 'db' => 'motivo_salida',         'dt' => 3 ),
    array( 'db' => 'fecha_registro',        'dt' => 4 ),
    array( 'db' => 'cve_salida',            'dt' => 5 )
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
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $condicion )
);
?>