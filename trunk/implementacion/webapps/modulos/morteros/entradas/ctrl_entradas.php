<?php 
// include_once "../../../dbconexion/conexion.php";
include_once "modelo_entradas.php";

	$objModelo = new modeloCapturaEntrada();

	$datos = $objModelo->mostrarDatos();

	$tabla = '<table id="tablaMatPrima">
                    <thead>
                        <tr class="text-center">
                            <th width="20%" class="text-center">Nombre</th>
                            <th width="20%" class="text-center">Cantidad</th>
                            <th width="20%" class="text-center">Categoria</th>
                            <th width="20%" class="text-center">Fecha de registro</th>
                            <th width="20%" class="text-center">Editar</th>
                        </tr>
                    </thead>
                    <tbody>';
    $datosTabla = "";

    foreach ($datos as $key => $value) {
    $datosTabla = $datosTabla. '<tr>
    								<td class="text-center">'.$value['nombre'].'</td>
    								<td class="text-center">'.$value['cantidad_entrada'].' Kg</td>
                                    <td class="text-center">'.$value['categoria'].'</td>
    								<td class="text-center">'.$value['fecha_registro'].'</td>
    								<td class="text-center ">
    									<span class= "btn btn-warning" onclick= "obtenerDatos('.$value['cve_entrada'].')" data-toggle="modal" data-target="#modalMatPrimaUpdate" data-whatever="@getbootstrap"> 
    										<i class="fas fa-edit"></i>
    									</span>
    								</td>
                                </tr>';
    }

    echo $tabla.$datosTabla.'</tbody>
                            </table';
 ?>