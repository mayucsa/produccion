<?php
include_once "../../../dbconexion/conexion.php";
// header('Content-Type: application/json');

// DB table to use
$table = "cat_productos" ;
 
// Table's primary key
$primaryKey = 'cve_producto';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
// $var    = "estatus = 'VIG'";
// $var1    = "INNER JOIN cat_productos P ON P.cve_producto = C.cve_producto INNER JOIN cat_materia_prima M ON M.cve_materia_prima = C.cve_materia_prima";
$columns = array(
    array( 'db' => 'cve_producto',          'dt' => 0 ),
    array( 'db' => 'nombre_producto',    'dt' => 1 ),
    array( 'db' => 'estatus_producto',    'dt' => 2 ),
);
 
// SQL server connection information


include_once "../../../dbconexion/conexionServerSide.php";
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../../../includes/js/data_tables_js/ssp.class.php' );
 
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns )
);
?>