<?php 
include_once "../../../dbconexion/conexion.php";
include_once"modelo_captura.php";

$cve_producto = $_POST['cve_producto'];

$tonelada = ModeloProducto::showTonelada($cve_producto);

    foreach ($tonelada as $key =>$value) {
        echo '<span value="'.$value["tonelada_producto"].'">'.$value["tonelada_producto"].'</span>';
 
    }
// var_dump($tonelada)

 ?>