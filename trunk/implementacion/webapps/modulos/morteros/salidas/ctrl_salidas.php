<?php 
// include_once "../../../dbconexion/conexion.php";
include_once "modelo_salidas.php";

    $objModelo = new modeloCapturaSalida();

    $datos = $objModelo->mostrarDatos();

    $tabla = '<table id="tableSalidas">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Presentación</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Motivo</th>
                            <th class="text-center">Fecha de registro</th>
                        </tr>
                    </thead>
                    <tbody>';
    $datosTabla = "";

    foreach ($datos as $key => $value) {
    $datosTabla = $datosTabla. '<tr>
                                    <td class="text-center">'.$value['nombre_salida'].'</td>
                                    <td class="text-center">'.$value['presentacion_salida'].' Kg</td>
                                    <td class="text-center">'.$value['cantidad_salida'].'</td>
                                    <td class="text-center">'.$value['motivo_salida'].'</td>
                                    <td class="text-center">'.$value['fecha_registro'].'</td>
                                </tr>';
    }

    echo $tabla.$datosTabla.'</tbody>
                            </table>';

 ?>