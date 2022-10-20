<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        include_once"modelo_desalojo.php";
        // include_once"enviar_mail.php";
?>
        <head>
            <title>Captura de Producci&oacute;n</title>
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
          <h1><i class="fas fa-dolly-flatbed"></i> Desalojo Besser</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="vista_captura.php"> Desalojo Besser</a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card">
                <div class="card-body">
                <form novalidate id="tablaDesalojoVibro" onsubmit="return false" autocomplete="off" method="POST">
                    <div class="row form-group form-group-sm">
                        <div class="col-sm-1 text-right">Producto</div>
                        <div class="col-sm-3 text-left">
                            <select class="form-control form-control-md" id="selectproducto" name="selectproducto" onchange="selectProducto()">
                                <option selected="selected" value="0">[Seleccione una opción..]</option>
                                <?php   
                                    $sql        = ModeloProducto::showProductoBesser();
                                        foreach ($sql as $key =>$value) {
                                        echo '<option value="'.$value["cve_pbloquera"].'">'.$value["nombre_producto"].'</option>';
                                        }
                                    ?>
                            </select>
                        </div>
                        <div class="col-sm-1 text-right" style="font-size:13px">Presentación</div>
                        <div class="col-sm-3 text-left">
                            <select class="form-control form-group-sm" id="selectpresentacion" name="selectpresentacion" onchange="selectPresentacion()" disabled>
                                <option selected="selected" value="0">[Seleccione una opción..]</option>
                            </select>
                        </div>
                        <div class="col-sm-1 text-left">Celdas</div>
                        <div class="col-sm-3 text-left">
                            <select class="form-control form-group-sm" id="selectceldas" name="selectceldas" disabled>
                                <option selected="selected" value="0">[Seleccione una opción..]</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group form-group-sm">
                        <div class="col-sm-1 text-right">Cantidad total</div>
                        <div class="col-sm-3 text-left">
                            <input type="text" id="inputtotal" name="inputtotal" class="form-control form-control-md validanumericos">
                        </div>
                        <div class="col-sm-1 text-right">Cantidad Rotura</div>
                        <div class="col-sm-3 text-left">
                            <input type="text" id="inputrotura" name="inputrotura" class="form-control form-control-md validanumericos">
                        </div>
                        <div class="col-sm-1 text-right">Cantidad despuntados</div>
                        <div class="col-sm-3 text-left">
                            <input type="text" id="inputdespuntados" name="inputdespuntados" class="form-control form-control-md validanumericos">
                        </div>
                        <div class="col-sm-2 text-left">
                            <span hidden id="spanuser" name="spanuser" class="form-control" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
                        </div>
                    </div>
                    <div class="row form-group form-group-sm border-top">
                        <div class="col-sm-12" align="center" >
                            <?php
                                 if ($clave == 1 || $clave == 8) {
                            ?>
                                    <input type="submit" value="Guardar" href="#" onclick="validacionDatos()" class="btn btn-primary" style="margin-bottom: -25px !important">
                            <?php
                                }else{
                             ?>
                                    <input type="submit" value="Guardar" href="#" onclick="sinacceso()" class="btn btn-primary" style="margin-bottom: -25px !important">
                            <?php
                                }
                            ?>
                            <!-- <input type="submit" value="Guardar" href="#" onclick="validacionDatos()" class="btn btn-primary" style="margin-bottom: -25px !important"> -->
                            <input type="submit" value="Limpiar" href="#" onclick="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important">
                        </div>
                    </div>
                </form>
                </div>
                <div class="card-footer">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaInvBesser">
                            <thead>
                                <tr>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Presentación</th>
                                    <th class="text-center">Celdas</th>
                                    <th class="text-center">Cantidad total</th>
                                    <th class="text-center">Cantidad rotura</th>
                                    <th class="text-center">Cantidad despuntados</th>
                                    <th class="text-center">Fecha de desalojo </th>
                                    <th class="text-center">Editar </th>
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



    

<script src="vista_desalojo.js"></script>

<script src="../../../includes/js/jquery351.min.js"></script>

<!-- <script src="vista_vibro.js"></script> -->

<?php include_once "../../inferior.php" ?>

    <!-- <script src="vista_vibro.js"></script> -->

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>
    
    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>

    <script type="text/javascript">
        consultar();
    </script>