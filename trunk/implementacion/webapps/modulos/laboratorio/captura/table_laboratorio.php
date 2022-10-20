<?php 
include_once "modelo_laboratorio.php";

	$objModelo = new modeloConcentrado();

	$datos = $objModelo->mostrarDatos();

	$tabla = '<table id="tableconcentrado">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center">Concentrado</th>
                            <th class="text-center">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>';
    $datosTabla = "";

    foreach ($datos as $key => $value) {
    $datosTabla = $datosTabla. '<tr>
    								<td class="text-center">'.$value['nombre_concentrado'].'</td>
    								<td class="text-center">'.$value['cantidad_concentrado'].' Pza</td>
                                </tr>';
    }

    echo $tabla.$datosTabla.'</tbody>
                            </table>';
 ?>