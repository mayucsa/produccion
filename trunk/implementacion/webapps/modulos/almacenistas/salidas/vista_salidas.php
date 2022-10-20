<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        include_once"modelo_salidas.php";
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

<div class="modal fade" id="myLoading" tabindex="-3" data-backdrop="static" data-keyboard="false" style="padding-top:20%; overflow-y:visible;" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div align="center"><img src="../../../includes/imagenes/loading3.gif" width="140px"></div>
    <div id="divtextloading" align="center" style="font-weight:bold; font-size:20px; color:#FFFFFF">Espere un momento...</div>
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
          <h1><i class="fas fa-sign-out-alt"></i> Salida Producto Finalizado</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="vista_captura.php"> Salida Producto Finalizado</a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active border" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><strong>VibroBlock</strong> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><strong>Besser</strong></a>
                    </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form novalidate id="tablaCapturaVibro" onsubmit="return false" autocomplete="off" method="POST">
                                <div class="row form-group form-group-sm">
                                    <div class="col-sm-1 text-left" style="font-size:13px">Producto</div>
                                    <div class="col-sm-3 text-left">
                                        <select class="form-control form-control-sm" id="selectproducto" name="selectproducto" onchange="selectProducto()">
                                            <option selected="selected">[Seleccione una opción..]</option>
                                            <?php   
                                                $sql        = ModeloSalidas::showProductoVibro();
                                                    foreach ($sql as $key =>$value) {
                                                    echo '<option value="'.$value["cve_pbloquera"].'">'.$value["nombre_producto"].'</option>';
                                                    }
                                                ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-1 text-left" style="font-size:12px">Presentación</div>
                                    <div class="col-sm-3 text-left">
                                        <select class="form-control form-control-sm" id="selectpresentacion" name="selectpresentacion" onchange="selectPresentacion()" disabled>
                                            <option selected="selected">[Seleccione una opción..]</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-1 text-left" style="font-size:13px">Estiba</div>
                                    <div class="col-sm-3 text-left">
                                        <select class="form-control form-control-sm" id="selectestiba" name="selectestiba" disabled>
                                            <option selected="selected">[Seleccione una opción..]</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group form-group-sm">
                                    <div class="col-sm-1 text-left" style="font-size:13px">Cantidad</div>
                                    <div class="col-sm-3 text-left">
                                        <input type="text" id="inputcantidad" name="inputcantidad" class="form-control form-control-sm validanumericos">
                                    </div>
                                    <div class="col-sm-1 text-left" style="font-size:13px">Remisi&oacute;n</div>
                                    <div class="col-sm-3 text-left">
                                        <input type="text" id="inputremision" name="inputremision" class="form-control form-control-sm validanumericos" >
                                    </div>
                                    <div class="col-sm-1 text-left" style="font-size:13px">Placas</div>
                                    <div class="col-sm-3 text-left">
                                        <input type="text" id="inputplacas" name="inputplacas" class="form-control form-control-sm UpperCase" >
                                    </div>
                                    <!-- <div class="col-sm-1 text-left" style="font-size:13px">Piezas</div> -->
                                    <div class="col-sm-2 text-left">
                                        <span hidden id="spanuser" name="spanuser" class="form-control" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
                                    </div>
 <!--                                    <div class="col-sm-1 text-left" style="font-size:13px">Firma</div>
                                    <div class="col-sm-2 text-left">
                                        <input type="text" id="inputfirmas" name="inputfirmas" class="form-control form-control-md validanumericos" >
                                    </div> -->
                                </div>
                                <div class="row form-group form-group-sm border-top">
                                    <div class="col-sm-12" align="center" >
                            <?php
                                 if ($clave == 1 || $clave == 10) {
                            ?>
                                    <input id="btnvibro" name="btnvibro" type="submit" value="Guardar" href="#" onclick="validacionDatos()" class="btn btn-primary" style="margin-bottom: -25px !important">
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
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <form novalidate id="tablaCapturaVibro" onsubmit="return false" autocomplete="off" method="POST">
                            <div class="row form-group form-group-sm">
                                <div class="col-sm-1 text-left" style="font-size:13px">Producto</div>
                                <div class="col-sm-3 text-left">
                                    <select class="form-control form-control-sm" id="selectproductob" name="selectproductob" onchange="selectProductoBesser()">
                                        <option selected="selected" value="0">[Seleccione una opción..]</option>
                                        <?php   
                                            $sql        = ModeloProducto::showProductoBesser();
                                                foreach ($sql as $key =>$value) {
                                                echo '<option value="'.$value["cve_pbloquera"].'">'.$value["nombre_producto"].'</option>';
                                                }
                                            ?>
                                    </select>
                                </div>
                                <div class="col-sm-1 text-left" style="font-size:12px">Presentación</div>
                                <div class="col-sm-3 text-left">
                                    <select class="form-control form-control-sm" id="selectpresentacionb" name="selectpresentacionb" onchange="selectPresentacionBesser()" disabled>
                                        <option selected="selected" value="0">[Seleccione una opción..]</option>
                                    </select>
                                </div>
                                <div class="col-sm-1 text-left" style="font-size:13px">Celdas</div>
                                <div class="col-sm-3 text-left">
                                    <select class="form-control form-control-sm" id="selectceldasb" name="selectceldasb" onchange="selectEstibaBesser()" disabled>
                                        <option selected="selected" value="0">[Seleccione una opción..]</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group form-group-sm">
                                <div class="col-sm-1 text-left" style="font-size:13px">Estiba</div>
                                <div class="col-sm-3 text-left">
                                    <select class="form-control form-control-sm" id="selectestibab" name="selectestibab" disabled>
                                        <option selected="selected" value="0">[Seleccione una opción..]</option>
                                    </select>
                                </div>
                                <div class="col-sm-1 text-left" style="font-size:13px">Cantidad</div>
                                <div class="col-sm-3 text-left">
                                    <input type="text" id="inputcantidadb" name="inputcantidadb" class="form-control form-control-sm validanumericos">
                                </div>
                                <div class="col-sm-1 text-left" style="font-size:13px">Remisi&oacute;n</div>
                                <div class="col-sm-3 text-left">
                                    <input type="text" id="inputremisionb" name="inputremisionb" class="form-control form-control-sm validanumericos" >
                                </div>
                            </div>
                            <div class="row form-group form-group-sm">
                                <div class="col-sm-1 text-left" style="font-size:13px">Placas</div>
                                <div class="col-sm-3 text-left">
                                    <input type="text" id="inputplacasb" name="inputplacasb" class="form-control form-control-sm UpperCase" >
                                </div>
                                <div class="col-sm-2 text-left">
                                    <span hidden id="spanuser" name="spanuser" class="form-control" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
                                </div>
                            </div>
                            <div class="row form-group form-group-sm border-top">
                                <div class="col-sm-12" align="center" >
                            <?php
                                 if ($clave == 1 || $clave == 10) {
                            ?>
                                    <input type="submit" value="Guardar" href="#" onclick="validacionDatosBesser()" class="btn btn-primary" style="margin-bottom: -25px !important">
                            <?php
                                }else{
                             ?>
                                    <input type="submit" value="Guardar" href="#" onclick="sinacceso()" class="btn btn-primary" style="margin-bottom: -25px !important">
                            <?php
                                }
                            ?>
                                    <!-- <input type="submit" value="Guardar" href="#" onclick="validacionDatosBesser()" class="btn btn-primary" style="margin-bottom: -25px !important"> -->
                                    <input type="submit" value="Limpiar" href="#" onclick="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important">
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaSalidaVibro">
                            <thead>
                                <tr>
                                    <th class="text-center">Area</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Presentación</th>
                                    <th class="text-center">Celdas</th>
                                    <th class="text-center">Número de estiba</th>
                                    <th class="text-center">Cantidad de salida</th>
                                    <th class="text-center">Número de remision</th>
                                    <th class="text-center">Placas</th>
                                    <th class="text-center">Fecha de salida</th>
                                    <th class="text-center">Eliminar</th>
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



    

<script src="vista_salidas.js"></script>

<script src="../../../includes/js/jquery351.min.js"></script>

<script src="vista_salidas.js"></script>

<?php include_once "modal_salidas.php" ?>

<?php include_once "../../inferior.php" ?>

    <script src="vista_salidas.js"></script>

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>
    
    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>

<script type="text/javascript">
    <?php
    if ($clave == 1) {
        ?>
        consultar();
        // consultarEstiba();
    <?php
    }else{
        ?>
        consult();
        // consultEstiba();
        <?php
    }
     ?>
</script>