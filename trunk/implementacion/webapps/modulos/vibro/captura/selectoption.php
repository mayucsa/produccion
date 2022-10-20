<?php 
include_once "../../../dbconexion/conexion.php";
include_once"modelo_vibro.php";

$cve_pbloquera = $_POST['cve_pbloquera'];

$presentacion = ModeloProducto::showPresentacionVibro($cve_pbloquera);

echo  '   <option value="0">[Seleccione una opción..]</option>';

    foreach ($presentacion as $key =>$value) {
        echo '  <option value="'.$value["cve_presentacionb"].'">'.$value["nombre"].'</option>';
    }

 ?>