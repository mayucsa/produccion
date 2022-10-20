<?php 
include_once "modelo_laboratorio.php";

	$objModelo = new modeloinventario();

	$datos = $objModelo->mostrarQuimicos();

	$tabla = '<table id="tableconcentradokg">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center" scope="col">Quimico</th>
                            <th class="text-center" scope="col">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>';
    $datosTabla = "";

    foreach ($datos as $key => $value) {
    $datosTabla = $datosTabla. '<tr>
    								<td class="text-center" scope="eow">'.$value['nombre_quimico'].'</td>
    								<td class="text-center" scope="eow">'.$value['cantidad_quimico'].' Kg</td>
                                </tr>';
    }

    echo $tabla.$datosTabla.'</tbody>
                            </table';
 ?>