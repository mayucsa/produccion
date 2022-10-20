<?php 
include_once "../../../dbconexion/conexion.php";
include_once"modelo_vibro.php";

$cve_presentacionb = $_POST['cve_presentacionb'];

$celdas = ModeloProducto::showPiezasVibro($cve_presentacionb);

    foreach ($celdas as $key =>$value) {
        echo '<span value="'.$value["cantidad_bandeja"].'">'.$value["cantidad_bandeja"].'</span>';
    }

 ?>