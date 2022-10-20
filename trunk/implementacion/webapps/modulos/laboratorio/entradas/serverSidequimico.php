<?php
include_once "../../../dbconexion/conexion.php";
// include_once "vista_entradas.js";
// header('Content-Type: application/json');dor 

// DB table to use
$table = 'seg_entradas';
 
// Table's primary key
$primaryKey = 'cve_entrada';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
// $col = 'Quimicos';
$var    = "estatus_entrada = 'VIG'";
$var2   = "categoria = 'Quimico'";
// $varia = $var 'where' ;
$columns = array(
    array( 'db' => 'nombre',            'dt' => 0),
    array( 'db' => 'cantidad_entrada',  'dt' => 1,
        'formatter' => function( $d, $row ) {
            return number_format($d, 2, '.', ',').' Kg';
        }),
    // array( 'db' => 'categoria',         'dt' => 2),
    array( 'db' => 'fecha_registro',    'dt' => 2),
    array( 'db' => 'cve_entrada',       'dt' => 3),
    // array( 'db' => 'categoria',         'dt' => 4),
    // array(        'dt' => 4)
    // array( 'dt' => 5)
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
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $var, $var2)
    // SSP::COMPLEX( $var);

);
?>