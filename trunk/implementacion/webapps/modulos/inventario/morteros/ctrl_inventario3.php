<?php  
    include_once "modelo_inventario.php";

    $objModelo = new modeloInventario();

    $data = $objModelo->mostrarQuimicos();

    $table = '<table id="tQuimicos">
                    <thead>
                        <tr class="text-center"></th>
                            <th>Quimico</th>
                            <th class="text-center">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>';
    $dataTabla = "";

    foreach ($data as $key => $value) {
    $dataTabla = $dataTabla. '<tr>
                                    <th>'.$value['nombre_quimico'].'</th>
                                    <td class="text-center">'.$value['cantidad_quimico'].'  Kg</td>
                                </tr>';
    }

    echo $table.$dataTabla.'</tbody>
                            </table>';

?>