<?php
include_once "../../../dbconexion/conexion.php";
// header('Content-Type: application/json');

// DB table to use
$table = 'seg_inventario_patios';
 
// Table's primary key
$primaryKey = 'cve_ibloquera';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
// $var    = "estatus_registro = 'VIG'";
$var    = "area = 'Besser' AND  estatus_ibloquera = 'VIG'";
$columns = array(
    array( 'db' => 'nombre_producto',   'dt' => 0 ),
    array( 'db' => 'presentacion',      'dt' => 1 ),
    array( 'db' => 'num_celdas',        'dt' => 2 ),
    array( 'db' => 'cantidad_inventario',          'dt' => 3,
                    'formatter' => function($d, $row){
                        return number_format($d).' Pza';
                    })
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