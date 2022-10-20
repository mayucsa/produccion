<?php
include_once "../../../dbconexion/conexion.php";
// header('Content-Type: application/json');

// DB table to use
$table = 'cat_usuarios';
// $tablerol = 'cat_roles';
 
// Table's primary key
$primaryKey = 'cve_usuario';
// $primaryKeyrol = 'cve_rol';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
// $var = "SELECT nombre_rol from cat_rol where ";
$columns = array(
    array( 'db' => 'nombre_usuario',    'dt' => 0),
    array( 'db' => 'nombre',            'dt' => 1),
    array( 'db' => 'puesto',            'dt' => 2),
    array( 'db' => 'cve_rol',           'dt' => 3),
    array( 'db' => 'estatus_usuario',   'dt' => 4),
    array( 'db' => 'fecha_registro',    'dt' => 5),
    array( 'db' => 'apellido',          'dt' => 6)
);
 
// // SQL server connection information

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
//  $sql_details = array(
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
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns)
);
?>