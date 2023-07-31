<?php 
include_once "../../../dbconexion/conexion.php";
include_once"modelo_besser.php";

$cve_bloquera = $_POST['cve_bloquera'];

$celdas = ModeloProducto::showPiezasBesser($cve_bloquera);

    foreach ($celdas as $key =>$value) {
        echo $value["cantidad_bandeja"];
    }


 ?>