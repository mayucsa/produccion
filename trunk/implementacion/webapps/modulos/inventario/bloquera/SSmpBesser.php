<?php
include_once "../../../dbconexion/conexion.php";
// header('Content-Type: application/json');

// DB table to use
$table = 'seg_mp_bloquera';
 
// Table's primary key
$primaryKey = 'cve_mp';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
// $var    = "estatus_registro = 'VIG'";
$var    = "area = 'Besser' AND  estatus_mp = 'VIG'";
$columns = array(
    array( 'db' => 'nombre_materia_prima',      'dt' => 0 ),
    array( 'db' => 'cantidad_materia_prima',    'dt' => 1,
                    'formatter' => function( $d, $row ) {
            return number_format($d, 2, '.', ',' );
        }),
    array( 'db' => 'unidad_medida',      'dt' => 2 )
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