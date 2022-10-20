<?php 
include_once "../../../dbconexion/conexion.php";
include_once"modelo_salidas.php";

$cve_pbloquera = $_POST['cve_pbloquera'];
$cve_presentacionb = $_POST['cve_presentacionb'];

$presentacion = ModeloSalidas::showEstibaVibroCase($cve_pbloquera, $cve_presentacionb);

echo  '   <option value="0">[Seleccione una opción..]</option>';

    foreach ($presentacion as $key =>$value) {
        echo '<option value="'.$value["numero_estiba"].'">'.$value["numero_estiba"].'</option>';
    }

 ?>