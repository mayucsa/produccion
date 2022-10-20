<?php
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
// $var    = "estatus_registro = 'VIG'";
$var    = "area = 'Besser' AND  estatus_registro = 'VIG'";
$columns = array(
    array( 'db' => 'nombre_producto',       'dt' => 0 ),
    array( 'db' => 'presentacion',          'dt' => 1 ),
    array( 'db' => 'cantidad_barcadas',     'dt' => 2),
    array( 'db' => 'bandejas_producidas',   'dt' => 3,
                    'formatter' => function( $d, $row ) {
            return number_format($d);
        } ),
    array(
        'db'        => 'piezas_totales',    'dt' => 4,
                    'formatter' => function( $d, $row ) {
            return number_format($d);
        }
    ),
    array( 'db' => 'consumototal_cemento',          'dt' => 5,
                    'formatter' => function( $d, $row ) {
            return number_format($d).' Kg';
        }
     ),
    array( 'db' => 'consumo_aditivo',          'dt' => 6,
                    'formatter' => function( $d, $row ) {
            return number_format($d, 2, '.', ',').' Lts';
        }
     ),
    array(
        'db'        => 'fecha_registro',
        'dt'        => 7,
        // 'formatter' => function( $d, $row ) {
        //     return date( 'jS M y', strtotime($d));
        // }
    ),
    array( 'db' => 'num_celdas',        'dt' => 8 ),
    array( 'db' => 'estatus_registro',   'dt' => 9 ),
    array(
        'db'        => 'fecha_registro',
        'dt'        => 10,
        'formatter' => function( $d, $row ) {
            return date( 'H:i:s', strtotime($d));
        }
    ),
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