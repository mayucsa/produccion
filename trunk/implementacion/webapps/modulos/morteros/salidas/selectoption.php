<?php 
include_once "../../../dbconexion/conexion.php";
include_once"modelo_salidas.php";

$cve_producto = $_POST['cve_producto'];

$presentacion = modeloCapturaSalida::showPresentacion($cve_producto);

    foreach ($presentacion as $key =>$value) {
        echo '<option value="'.$value["valor_presentacion"].'">'.$value["valor_presentacion"].'</option>';
    }
// var_dump($presentacion)

// $tonelada = ModeloProducto::showTonelada($cve_producto);

//     foreach ($tonelada as $key =>$value) {
//         echo '<option value="'.$value["cve_segtonelada"].'">'.$value["tonelada"].'</option>';
 
//     }
// var_dump($tonelada)

 ?>