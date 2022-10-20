<?php 
include_once "modelo_inventario.php";

	$objModelo = new modeloInventario();

	$datos = $objModelo->mostrarProducto();

	$tabla = '<table id="tProducto">
                    <thead>
                        <tr class="text-center"></th>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Presentación</th>
                            <th class="text-center">Cantidad en Tonelada</th>
                            <th class="text-center">Cantidad en KG</th>
                            <th class="text-center">Cantidad de Sacos</th>
                        </tr>
                    </thead>
                    <tbody>';
    $datosTabla = "";

    foreach ($datos as $key => $value) {
        $cuarenta = 40;
        $veinte = 20;
        $tonelada = 1000;
    $datosTabla = $datosTabla. '<tr>
    								<th>'.$value['nombre_producto'].'</th>
    								<td class="text-center">'.$value['valor_presentacion'].' Kg</td>
                                    <td class="text-center">'.$value['cantidad'] / $tonelada.'</td>
                                    <td class="text-center">'.$value['cantidad'].'</td>
                                    <td class="text-center">'.$value['cantidad'] / $value['valor_presentacion'].'</td>
                                </tr>';
    }

    echo $tabla.$datosTabla.'</tbody>
                            </table>';

	
 ?>