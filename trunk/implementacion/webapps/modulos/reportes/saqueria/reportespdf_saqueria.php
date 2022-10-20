<?php 
    ob_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

<link rel="stylesheet" type="text/css" href="../../../includees/css/main.css">

</head>
<body>

<?php 
// include_once "../../superior.php";
include_once "../../../dbconexion/conexion.php";
include_once "modelo_saqueria.php";

    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    
    // $objModelo = new modeloSaqueria();

    $datos = modeloSaqueria::reportepdf($fecha_inicio, $fecha_fin);

    $tabla = '<table class="table table-striped table-bordered table-hover" id="tablaSaqueria">
                    <thead>
                        <tr class="text-center">
                            <th width="10%" class="text-center">Tipo</th>
                            <th width="10%" class="text-center">Clave</th>
                            <th width="20%" class="text-center">Concepto</th>
                            <th width="20%" class="text-center">Presentacion</th>
                            <th width="15%" class="text-center">Cantidad</th>
                            <th width="20%" class="text-center">Fecha de movimiento</th>
                        </tr>
                    </thead>
                    <tbody>';
    $datosTabla = "";

    foreach ($datos as $key => $value) {
    $datosTabla = $datosTabla. '<tr>
                                    <td class="text-center">'.$value['tipo'].'</td>
                                    <td class="text-center">'.$value['codigo'].'</td>
                                    <td class="text-center">'.$value['cve_producto'].'</td>
                                    <td class="text-center">'.$value['valor_presentacion'].'</td>
                                    <td class="text-center">'.$value['sacos_totales'].'</td>
                                    <td class="text-center">'.$value['fecha_registro'].'</td>
                                </tr>';
    }

    echo $tabla.$datosTabla.'</tbody>
                            </table';

// include_once "../../inferior.php"

 ?>

</body>
</html>
<?php 
    $html = ob_get_clean();
    // echo $html;

    include_once "../../../includes/librerias/dompdf/autoload.inc.php";

    use Dompdf\Dompdf;
    $dompdf = new Dompdf();

    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);

    $dompdf->loadHtml($html);

    $dompdf->setPaper('letter');

    $dompdf->render();

    $dompdf->stream("saqueria_morteros.pdf", array("Attachment" => false));

?>