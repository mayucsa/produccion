<?php
// include_once "../../../dbconexion/conexion.php";
// header('Content-Type: application/json');

// DB table to use
$table = 'seg_quimico';
 
// Table's primary key
$primaryKey = 'cve_segquimico';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$number = 'cantidad';
$columns = array(
    array( 'db' => 'nombre_quimico',       'dt' => 0 ),
    array( 'db' => 'cantidad_quimico',    'dt' => 1, 
                    'formatter' => function( $d, $row ) {
            return number_format($d, 2, '.', ',').' Kg';
        }),
    // array( 'db' => $number,                 'dt' => 2,
    //                 'formatter' => function( $d, $row ) {
    //         return number_format($d);
    //     } ),
    // array( 'db' => 'cantidad',         'dt' => 3 ),
    // array( 'db' => 'fecha_registro',         'dt' => 4 ),
    // array(
    //     'db'        => 'fecha_registro',
    //     'dt'        => 4,
        // 'formatter' => function( $d, $row ) {
        //     return date( 'jS M y', strtotime($d));
        // }
    // ),
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
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
?>