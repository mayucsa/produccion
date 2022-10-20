<?php 
include_once "../../../dbconexion/conexion.php";
include_once"modelo_salidas.php";

$cve_pbloquera = $_POST['cve_pbloquera'];

$presentacion = ModeloProducto::showPresentacionBesser($cve_pbloquera);

echo  '   <option value="0">[Seleccione una opción..]</option>';

    foreach ($presentacion as $key =>$value) {
        echo '<option value="'.$value["cve_presentacionb"].'">'.$value["nombre"].'</option>';
    }
// var_dump($presentacion)

// $tonelada = ModeloProducto::showTonelada($cve_producto);

//     foreach ($tonelada as $key =>$value) {
//         echo '<option value="'.$value["cve_segtonelada"].'">'.$value["tonelada"].'</option>';
 
//     }
// var_dump($tonelada)

 ?>