<?php
session_start();
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
$var2   = "categoria = 'Materia Prima'";
// $varia = $var 'where' ;
$columns = array(
    array( 'db' => 'cve_entrada',            'dt' => 0),
    array( 'db' => 'nombre',            'dt' => 1),
    array( 'db' => 'cantidad_entrada',  'dt' => 2,
        'formatter' => function( $d, $row ) {
            return number_format($d, 2, '.', ',').' Kg';
        }),
    // array( 'db' => 'categoria',         'dt' => 2),
    array(  'db' => 'fecha_registro',    
            'dt' => 3,
        'formatter' => function( $d, $row ) {
            return date( 'Y-m-d', strtotime($d));
        }
    ),
    array( 'db' => 'cve_entrada',   'dt' => 4, 'formatter' => function($d, $row){
        if ($_SESSION['entradas_morteros_edit'] == 1) {
            return  '<span class= "btn btn-warning" onclick= "obtenerDatos('.$row[4].')" title="Editar" data-toggle="modal" data-target="#modalMatPrimaUpdate" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> </span>'. ' '.
                    '<span class= "btn btn-danger" onclick= "Eliminar('.$row[4].')" title="Eliminar" data-toggle="modal" data-target="#modalDeleteMP" data-whatever="getbootstrap"><i class="fas fa-trash-alt"></i> </span>';
        }else{
            return  '<span class= "btn btn-warning" onclick= "sinacceso()" title="Editar"><i class="fas fa-edit"></i> </span>'.' '.
                    '<span class= "btn btn-danger" onclick= "sinacceso()" title="Eliminar"><i class="fas fa-trash-alt"></i> </span>';
        }
    }),
    // array( 'db' => 'categoria',         'dt' => 4),
    // array(        'dt' => 4)
    // array( 'dt' => 5)
);
 
// SQL server connection information
include_once "../../../dbconexion/conexionServerSide.php";
 
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