<?php
include_once "../../../dbconexion/conexion.php";
// header('Content-Type: application/json');

// DB table to use
$table = 'captura_produccion';
 
// Table's primary key
$primaryKey = 'cve_captura';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$var    = "estatus_registro = 'VIG'";
$columns = array(
    array( 'db' => 'cve_producto',          'dt' => 0 ),
    array( 'db' => 'valor_presentacion',    'dt' => 1 ),
    array( 'db' => 'num_barcadas',          'dt' => 2),
    array( 'db' => 'kg_real',               'dt' => 3,
                    'formatter' => function( $d, $row ) {
            return number_format($d);
        } ),
    array(
        'db'        => 'sacos_totales', 'dt'        => 4,
                    'formatter' => function( $d, $row ) {
            return number_format($d);
        }
    ),
    array(
        'db'        => 'fecha_registro',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
            return date( 'Y-m-d', strtotime($d));
        }
    ),
    array( 'db' => 'cve_captura',       'dt' => 7),
    // array(
    //     'db'        => 'salary',
    //     'dt'        => 5,
    //     'formatter' => function( $d, $row ) {
    //         return '$'.number_format($d);
    //     }
    // )
);
 
// SQL server connection information


include_once "../../../dbconexion/conexionServerSide.php";
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../../../includes/js/data_tables_js/ssp.class.php' );
 
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $var )
);
?>