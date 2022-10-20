<?php 
include_once "../../../dbconexion/conexion.php";
include_once"modelo_desalojo.php";

$cve_presentacionb = $_POST['cve_presentacionb'];

$celdas = ModeloProducto::showCeldasBesser($cve_presentacionb);

    foreach ($celdas as $key =>$value) {
        echo '<option value="'.$value["num_celda"].'">'.$value["num_celda"].'</option>';
    }

 ?>