<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        include_once "modelo_salidas.php";
?>
        <head>
            <title>Salida Producto</title>

            <style type="text/css">
                body{
                    background-color: #f7f6f6;
                }
                table thead{
                    background-color: #1A4672;
                    color:  white;
                }
            </style>
        </head>

<div class="modal fade" id="modalMensajes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top:10%; overflow-y:visible;" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-danger">
                <h5 class="modal-title" id="encabezadoModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cuerpoModal"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-sign-out-alt"></i> Salidas</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="vista_salidas.php">Salidas</a></li>
        </ul>
      </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active border" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><strong>Producto Finalizado</strong> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link border" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><strong>Materia Prima</strong></a>
                            </li>
                        </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <form novalidate id="tablaSalida" onsubmit="return false" autocomplete="off" method="POST">
                        <div class="row form-group form-group-sm">
                            <div class="col-sm-2 text-right">Producto</div>
                            <div class="col-sm-4">
                                <select class="form-control" id="salidaproducto" name="salidaproducto" onchange="selectProducto()"  required>
                                    <option selected="selected" value="0">[Seleccione una opción..]</option>
                                    <?php   
                                        $sql        = modeloCapturaSalida::showProducto();

                                        foreach ($sql as $key =>$value) {
                                            echo '<option value="'.$value["cve_producto"].'">'.$value["nombre_producto"].'</option>';
                                        }

                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-2 text-right">Presentación</div>
                            <div class="col-sm-4 text-left">
                                <select class="form-control" id="selectpresentacion"  name="selectpresentacion">
                                    <option selected="selected" value="0">[Seleccione una opción..]</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group form-group-sm">
                            <div class="col-sm-2 text-right">Motivo</div>
                            <div class="col-sm-4">
                                <select class="form-control" id="salidamotivo" name="salidamotivo" >
                                    <option selected="selected" value="0">[Seleccione una opción..]</option>
                                    <option>Ventas</option>
                                    <option>Reproceso</option>
                                    <option>Uso Interno</option>
                                    <option>Pruebas</option>
                                    <option>Rotura</option>
                                    <option>Muestra a Clientes</option>
                                </select>
                            </div>
                            <div class="col-sm-2 text-right">Cantidad</div>
                            <div class="col-sm-4 text-left">
                                <input type="text" id="inputcantidad" name="inputcantidad" class="form-control validanumericos" >
                            </div>
                        </div>

                        <div class="row form-group form-group-sm border-top">
                            <div class="col-sm-12" align="center">
                                <?php
                                    if ($clave == 1 || $clave == 6) {
                                ?>
                                        <input type="submit" value="Guardar" href="#" onclick="darSalida()" class="btn btn-primary" style="margin-bottom: -25px !important">
                                <?php
                                    }else{
                                ?>
                                        <input type="submit" value="Guardar" href="#" onclick="sinacceso()" class="btn btn-primary" style="margin-bottom: -25px !important">
                                <?php
                                    }
                                ?>
                                <!-- <input type="submit" value="Guardar" href="#" onclick="darSalida()" class="btn btn-primary" style="margin-bottom: -25px !important"> -->
                            </div>
                        </div>
                    </form>

                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <form novalidate id="tablaSalidaMP" onsubmit="return false" autocomplete="off" method="POST">
                        <div class="row form-group form-group-sm">
                            <div class="col-sm-1 text-left">Materia Prima</div>
                            <div class="col-sm-3">
                                <select class="form-control" id="salidamp" name="salidamp">
                                    <option selected="selected" value="0">[Seleccione una opción..]</option>
                                    <?php   
                                        $sql        = modeloCapturaSalida::showMP();

                                        foreach ($sql as $key =>$value) {
                                            echo '<option value="'.$value["nombre_materia_prima"].'">'.$value["nombre_materia_prima"].'</option>';
                                        }

                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-1 text-left">Motivo</div>
                            <div class="col-sm-3">
                                <select class="form-control" id="salidamotivomp" name="salidamotivomp" >
                                    <option selected="selected" value="0">[Seleccione una opción..]</option>
                                    <option>Ventas</option>
                                    <option>Reproceso</option>
                                    <option>Uso Interno</option>
                                    <option>Pruebas</option>
                                    <option>Rotura</option>
                                    <option>Muestra a Clientes</option>
                                </select>
                            </div>
                            <div class="col-sm-1 text-left">Cantidad</div>
                            <div class="col-sm-3 text-left">
                                <input type="text" id="inputcantidadmp" name="inputcantidadmp" class="form-control validanumericos" >
                            </div>
                        </div>
                        <div class="row form-group form-group-sm border-top">
                            <div class="col-sm-12" align="center">
                                <?php
                                    if ($clave == 1 || $clave == 6) {
                                ?>
                                        <input type="submit" value="Guardar" href="#" onclick="SalidaMP()" class="btn btn-primary" style="margin-bottom: -25px !important">
                                <?php
                                    }else{
                                ?>
                                        <input type="submit" value="Guardar" href="#" onclick="sinacceso()" class="btn btn-primary" style="margin-bottom: -25px !important">
                                <?php
                                    }
                                ?>
                                <!-- <input type="submit" value="Guardar" href="#" onclick="SalidaMP()" class="btn btn-primary" style="margin-bottom: -25px !important"> -->
                            </div>
                        </div>
                    </form>

                    </div>
                </div>

                    </div>
                    <div class="card-footer">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tableSalida">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Presentación</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Motivo</th>
                                        <th class="text-center">Fecha de registro</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                
            </div>

        </div>
    </div>

      <?php include_once "../../footer.php" ?>
    </main>


    <script src="vistas_salida.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script> -->
    <script src="../../../includes/js/jquery331.min.js"></script>

<?php include_once "modalesSalida.php" ?>

<?php include_once "../../inferior.php" ?>

    <script src="vistas_salida.js"></script>

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>

<script type="text/javascript">
    <?php
    if ($clave == 1) {
        ?>
        consultar();
    <?php
    }else{
        ?>
        consult();
        <?php
    }
     ?>
</script> 

    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>
    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>
    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>