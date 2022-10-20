<?php 
// include_once "../../../dbconexion/conexion.php";
include_once "modelo_captura.php";

	$objModelo = new modeloMostrarCaptura();

	$datos = $objModelo->mostrarDatos();

	$tabla = '<table id="tableCaptura">
                    <thead>
                        <tr class="text-center">
                            <th width="" class="text-center">Nombre</th>
                            <th width="" class="text-center">Presentación</th>
                            <th width="" class="text-center">Cantidad de Barcadas</th>
                            <th width="" class="text-center">KG ingresado</th>
                            <th width="" class="text-center">Sacos utilizados</th>
                            <th width="" class="text-center">Fecha registro</th>
                        </tr>
                    </thead>
                    <tbody>';
    $datosTabla = "";

    foreach ($datos as $key => $value) {
    $datosTabla = $datosTabla. '<tr>
    								<td scope="row" class="text-center">'.$value['cve_producto'].'</td>
    								<td class="text-center">'.$value['valor_presentacion'].' Kg</td>
                                    <td class="text-center">'.$value['num_barcadas'].'</td>
                                    <td class="text-center">'.$value['kg_real'].'</td>
                                    <td class="text-center">'.$value['sacos_totales'].'</td>
    								<td class="text-center">'.$value['fecha_registro'].'</td>
                                </tr>';
    }

    echo $tabla.$datosTabla.'</tbody>
                            </table>';
 ?>