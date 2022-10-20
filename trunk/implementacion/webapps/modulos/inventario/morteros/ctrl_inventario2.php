<?php  
    include_once "modelo_inventario.php";

    $objModelo = new modeloInventario();

    $data = $objModelo->mostrarMatPrima();

	$table = '<table id="tMatPrima">
                    <thead>
                        <tr class="text-center"></th>
                            <th class="text-center">Materia Prima</th>
                            <th class="text-center">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>';
    $dataTabla = "";

    foreach ($data as $key => $value) {
    $dataTabla = $dataTabla. '<tr>
    								<th>'.$value['nombre_materia_prima'].'</th>
    								<td class="text-center">'.$value['cantidad_materia_prima']. ' ' .$value['unidad_medida'].'</td>
                                </tr>';
    }

    echo $table.$dataTabla.'</tbody>
                            </table>';

?>