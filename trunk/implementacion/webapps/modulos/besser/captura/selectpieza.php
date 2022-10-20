<?php 
include_once "../../../dbconexion/conexion.php";
include_once"modelo_besser.php";

$cve_presentacionb = $_POST['cve_presentacionb'];

$celdas = ModeloProducto::showPiezasBesser($cve_presentacionb);

    foreach ($celdas as $key =>$value) {
        echo '<option value="'.$value["cantidad_bandeja"].'">'.$value["cantidad_bandeja"].'</option>';
    }

 ?>