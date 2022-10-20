<?php
// include_once "../../../dbconexion/conexion.php";
// include_once "../../../modulos/datos_serverside.php";
// header('Content-Type: application/json');

// DB table to use
$table = 'seg_producto';
 
// Table's primary key
$primaryKey = 'cve_segproducto';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'nombre_producto',       'dt' => 0),
    array( 'db' => 'valor_presentacion',    'dt' => 1),
    array( 'db' => 'cantidad',              'dt' => 2,
                    'formatter' => function( $d, $row ) {
            return number_format($d / 1000, 2, '.', ',');
        }),
    array( 'db' => 'cantidad',              'dt' => 3,
                    'formatter' => function( $d, $row ) {
            return number_format($d, 2, '.', ',').' Kg';
        }),
    array( 'db' => 'cantidad',              'dt' => 4,
                    'formatter' => function( $d, $row ) {
            return number_format($d / $row['valor_presentacion']).' Pza';
        }),
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