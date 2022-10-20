<?php 
include_once "../../../dbconexion/conexion.php";
include_once"modelo_salidas.php";

$cve_presentacionb = $_POST['cve_presentacionb'];
$num_celdas = $_POST['num_celdas'];

$presentacion = ModeloSalidas::showEstibaBesserCase($cve_presentacionb, $num_celdas);

echo  '   <option value="0">[Seleccione una opción..]</option>';

    foreach ($presentacion as $key =>$value) {
        echo '<option value="'.$value["numero_estiba"].'">'.$value["numero_estiba"].'</option>';
    }

 ?>