<?php 
include_once "../../../dbconexion/conexion.php";
include_once "modelo_saqueria.php";

    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    
	// $objModelo = new modeloSaqueria();

	$datos = modeloSaqueria::entradassalidas($fecha_inicio, $fecha_fin);

	$tabla = '<table id="tablaSaqueria">
                    <thead>
                        <tr class="text-center">
                            <th width="10%" class="text-center">Tipo de movimiento</th>
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
 ?>