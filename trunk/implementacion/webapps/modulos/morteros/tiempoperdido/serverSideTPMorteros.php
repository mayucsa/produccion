<?php
session_start();
include_once "../../../dbconexion/conexion.php";
// header('Content-Type: application/json');

// DB table to use
$table = 'seg_tiempoperdido';
 
// Table's primary key
$primaryKey = 'cve_tp';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$var    = "estatus_tp = 'VIG' AND area = 'Morteros'";
// $columns = array(
//     array( 'db' => 'cve_maq',          'dt' => 0 ),
//     array( 'db' => 'cve_fallo',    'dt' => 1 ),
//     array( 'db' => 'hora_inicio',          'dt' => 2),
//     array( 'db' => 'hora_fin',          'dt' => 3),
//     array(
//         'db'        => 'fecha_registro',
//         'dt'        => 4,
        // 'formatter' => function( $d, $row ) {
        //     return date( 'Y-m-d', strtotime($d));
        // }
//     ),
//     array( 'db' => 'cve_tpbesser',       'dt' => 5),
//     array(
//         'db'        => 'fecha_registro',
//         'dt'        => 6,
        // 'formatter' => function( $d, $row ) {
        //     return date( 'H:i:s', strtotime($d));
        // }
//     ),
// );

            // ['db' => '`tp`.`fecha_registro`', 'dt' => 4, 'formatter' => function( $d, $row ) {
                // if ($_SESSION['rol'] == '1') {
                    // return con html de botones para editar y eliminar
                // } else {
                    // return con html de botones para solo editar
                // }
                // return date( 'Y-m-d', strtotime($d));
            // }, 'field' => 'fecha_registro'],
        $columns = [
            ['db' => '`tp`.`cve_tp`', 'dt' => 0, 'field' => 'cve_tp'],
            ['db' => '`m`.`nombre_maq`', 'dt' => 1, 'field' => 'nombre_maq'],
            ['db' => '`f`.`nombre_fallo`', 'dt' => 2, 'field' => 'nombre_fallo'],
            ['db' => '`tp`.`hora_inicio`', 'dt' => 3, 'field' => 'hora_inicio'],
            ['db' => '`tp`.`hora_fin`', 'dt' => 4, 'field' => 'hora_fin'],
            ['db' => '`tp`.`hora_fin`', 'dt' => 5, 'formatter' => function( $d, $row) {
                // return $d ;
                return 'Diferencia' ;
            },'field' => 'hora_fin'],

            ['db' => '`tp`.`fecha_registro`', 'dt' => 6, 'formatter' => function( $d, $row ) {
               // return validaTurnos();
                return date( 'Y-m-d', strtotime($d));
            }, 'field' => 'fecha_registro'],
            ['db' => '`tp`.`fecha_registro`', 'dt' => 7, 'formatter' => function( $d, $row ) {
                return date( 'H:i:s', strtotime($d));
            }, 'field' => 'fecha_registro'],
            ['db' => '`tp`.`cve_tp`', 'dt' => 8, 'formatter' => function( $d, $row ) {
                if ($_SESSION['tperdido_morteros_edit'] == 1) {
                    return  '<span class= "btn btn-warning" onclick= "obtenerDatosEdit('.$row[0].')" title="Editar" data-toggle="modal" data-target="#modalEditar" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> </span>'. ' '. 
                            '<span class= "btn btn-danger" onclick= "obtenerDatosE('.$row[0].')" title="Eliminar" data-toggle="modal" data-target="#modalEliminar" data-whatever="@getbootstrap"><i class="fas fa-trash-alt"></i> </span>';
                }else{
                    return  '<span class= "btn btn-warning" onclick= "sinacceso()" title="Editar"><i class="fas fa-edit"></i> </span>'. ' '. 
                            '<span class= "btn btn-danger" onclick= "sinacceso()" title="Eliminar"><i class="fas fa-trash-alt"></i> </span>';
                }
            }, 'field' => 'cve_tp']
            ];

 
 $joinQuery = " FROM `{$table}` AS `tp` 
                INNER JOIN `cat_maquinas` AS `m` ON (`tp`.`cve_maq` = `m`.`cve_maq`)
                INNER JOIN `cat_fallos` AS `f` ON (`tp`.`cve_fallo` = `f`.`cve_fallo`)";

// SQL server connection information


include_once "../../../dbconexion/conexionServerSide.php";
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
// require( '../../../includes/js/data_tables_js/ssp.class.php' );
require( '../../../includes/js/data_tables_js/sspjoin.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $var )
);

?>