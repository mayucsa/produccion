<?php 
include_once "../../../dbconexion/conexion.php";
include_once"modelo_desalojo.php";

$cve_pbloquera = $_POST['cve_pbloquera'];

$presentacion = ModeloProducto::showPresentacionVibro($cve_pbloquera);

    foreach ($presentacion as $key =>$value) {
        echo '<option value="'.$value["cve_presentacionb"].'">'.$value["nombre"].'</option>';
    }

 ?>