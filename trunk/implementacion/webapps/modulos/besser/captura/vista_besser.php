<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        include_once"modelo_besser.php";
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


    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-tasks"></i> Producci&oacute;n Besser</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="vista_captura.php"> Producci&oacute;n Besser</a></li>
        </ul>
      </div>

    <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card">
                <div class="card-body">
                <form novalidate id="tablaCapturaVibro" onsubmit="return false" autocomplete="off" method="POST">
                    <div class="row form-group form-group-sm">
                        <div class="col-sm-2 text-left" style="font-size:13px">Producto</div>
                        <div class="col-sm-2 text-left">
                            <select class="form-control form-control-sm" id="selectproducto" name="selectproducto" onchange="selectProducto()">
                                <option selected="selected" value="0">[Seleccione una opción..]</option>
                                <?php   
                                    $sql        = ModeloProducto::showProductoBesser();
                                        foreach ($sql as $key =>$value) {
                                        echo '<option value="'.$value["cve_pbloquera"].'">'.$value["nombre_producto"].'</option>';
                                        }
                                    ?>
                            </select>
                        </div>
                        <div class="col-sm-2 text-left" style="font-size:13px">Presentación</div>
                        <div class="col-sm-2 text-left">
                            <select class="form-control form-control-sm" id="selectpresentacion" name="selectpresentacion" onchange="selectPresentacion()" disabled>
                                <option selected="selected" value="0">[Seleccione una opción..]</option>
                            </select>
                        </div>
                        <div class="col-sm-2 text-left" style="font-size:13px">Celdas</div>
                        <div class="col-sm-2 text-left">
                            <select class="form-control form-control-sm" id="selectceldas" name="selectceldas" disabled>
                                <option selected="selected" value="0">[Seleccione una opción..]</option>
                            </select>
                        </div>
                        <div hidden class="col-sm-1 text-left" style="font-size:13px">Piezas</div>
                        <div hidden class="col-sm-2 text-left">
                            <span hidden id="spanpiezas" name="spanpiezas" class="form-control" style="background-color: #E9ECEF;" onchange="operaciones();"></span>
                        </div>
                    </div>
                    <div class="row form-group form-group-sm">
                        <div class="col-sm-2 text-left" style="font-size:13px">Cantidad de barcadas</div>
                        <div class="col-sm-2 text-left">
                            <input type="text" id="inputbarcadas" name="inputbarcadas" class="form-control form-control-sm validanumericos" placeholder="Barcadas">
                        </div>
                        <div class="col-sm-2 text-left" style="font-size:13px">Bandejas producidas</div>
                        <div class="col-sm-2 text-left">
                            <input type="text" id="inputbandeja" name="inputbandeja" class="form-control form-control-sm validanumericos" placeholder="Bandejas" onchange="operaciones();">
                        </div>
                        <div class="col-sm-2 text-left" style="font-size:13px">Cemento por barcada</div>
                        <div class="col-sm-2 text-left">
                            <input type="text" id="inputcemento" name="inputcemento" class="form-control form-control-sm validanumericos" placeholder="Cemento" onchange="operaciones();">
                        </div>
                    </div>
                    <div class="row form-group form-group-sm">
                        <div class="col-sm-2 text-left" style="font-size:13px">Consumo de aditivo</div>
                        <div class="col-sm-2 text-left">
                            <input type="text" id="inputaditivo" name="inputaditivo" class="form-control form-control-sm validanumericos" placeholder="Aditivo">
                        </div>
                        <div class="col-sm-2 text-left" style="font-size:13px">Pesadas</div>
                        <div class="col-sm-2 text-left">
                            <input type="text" id="inputpesadas" name="inputpesadas" class="form-control form-control-sm validanumericos" placeholder="Pesadas" onchange="operaciones();">
                        </div>
                    </div>
                    <div class="row form-group form-group-sm">
                        <div class="col-sm-2 text-left" style="font-size:13px">Tiempo de llenado</div>
                        <div class="col-sm-2 text-left">
                            <input type="text" id="inputllenado" name="inputllenado" class="form-control form-control-sm validanumericos" placeholder="Llenado" onchange="operaciones();">
                        </div>
                        <div class="col-sm-2 text-left" style="font-size:13px">Humedad</div>
                        <div class="col-sm-2 text-left">
                            <input type="text" id="inputhumedad" name="inputhumedad" class="form-control form-control-sm validanumericos" placeholder="Humedad" onchange="operaciones();">
                        </div>
                        <div class="col-sm-2 text-left" style="font-size:13px">Peso promedio</div>
                        <div class="col-sm-2 text-left">
                            <input type="text" id="inputpesopromedio" name="inputpesopromedio" class="form-control form-control-sm validanumericos" placeholder="Peso promedio">
                        </div>
                    </div>
                    <div class="row form-group form-group-sm border-top">
                        <div class="col-sm-12" align="center">
                            <h4>Cambios de Dosificación</h4>
                        </div>
                    </div>
                    <div class="row form-group form-group-sm">
                        <div class="col-sm-2 text-left" style="font-size:13px">Polvo</div>
                        <div class="col-sm-2 text-left">
                            <input type="text" id="inputpolvo" name="inputpolvo" class="form-control form-control-sm validanumericos" placeholder="Latas">
                        </div>
                        <div class="col-sm-2 text-left" style="font-size:13px">Segundos</div>
                        <div class="col-sm-2 text-left">
                            <input type="text" id="inputsegpolvo" name="inputsegpolvo" class="form-control form-control-sm validanumericos" placeholder="Segs">
                        </div>
                        <div class="col-sm-2 text-left" style="font-size:13px">Porcentaje</div>
                        <div class="col-sm-2 text-left">
                            <span id="spPorcpolvo" name="spPorcpolvo" class="form-control form-control-sm" style="background-color: #E9ECEF"></span>
                        </div>
                    </div>
                    <div class="row form-group form-group-sm">
                        <div class="col-sm-2 text-left" style="font-size:13px">Gravilla</div>
                        <div class="col-sm-2 text-left">
                            <input type="text" id="inputgravilla" name="inputgravilla" class="form-control form-control-sm validanumericos" placeholder="Latas">
                        </div>
                        <div class="col-sm-2 text-left" style="font-size:13px">Segundos</div>
                        <div class="col-sm-2 text-left">
                            <input type="text" id="inputseggravilla" name="inputseggravilla" class="form-control form-control-sm validanumericos" placeholder="Segs">
                        </div>
                        <div class="col-sm-2 text-left" style="font-size:13px">Porcentaje</div>
                        <div class="col-sm-2 text-left">
                            <span id="spPorcGravilla" name="spPorcGravilla" class="form-control form-control-sm" style="background-color: #E9ECEF"></span>
                        </div>
                    </div>
                    <div class="row form-group form-group-sm">
                        <div class="col-sm-2 text-left" style="font-size:13px">Gravilla</div>
                        <div class="col-sm-2 text-left">
                            <input type="text" id="inputgravillados" name="inputgravillados" class="form-control form-control-sm validanumericos" placeholder="Latas" onchange="porcentaje();">
                        </div>
                        <div class="col-sm-2 text-left" style="font-size:13px">Segundos</div>
                        <div class="col-sm-2 text-left">
                            <input type="text" id="inputseggravillados" name="inputseggravillados" class="form-control form-control-sm validanumericos" placeholder="Segs">
                        </div>
                        <div class="col-sm-2 text-left" style="font-size:13px">Porcentaje</div>
                        <div class="col-sm-2 text-left">
                            <span id="spPorcGravillados" name="spPorcGravillados" class="form-control form-control-sm" style="background-color: #E9ECEF"></span>
                        </div>
                    </div>
                    <div class="row form-group form-group-sm">
                        <div class="col-sm-2 text-left" style="font-size:13px">Piezas totales</div>
                        <div class="col-sm-2 text-left">
                            <span id="spPiezasTotal" name="spPiezasTotal" class="form-control form-control-sm" style="background-color: #E9ECEF;" onchange="operaciones();"></span>
                        </div>
                        <div class="col-sm-2 text-left" style="font-size:13px">Consumo total de cemento</div>
                        <div class="col-sm-2 text-left">
                            <span id="spConsumoCemento" name="spConsumoCemento" class="form-control form-control-sm" style="background-color: #E9ECEF;"></span>
                        </div>
                        <div class="col-sm-2 text-left" style="font-size:13px">Cemento por pieza</div>
                        <div class="col-sm-2 text-left">
                            <span id="spCementoPieza" name="spCementoPieza" class="form-control form-control-sm" style="background-color: #E9ECEF;"></span>
                        </div>
                        <div class="col-sm-2 text-left">
                            <span hidden  id="spanuser" name="spanuser" class="form-control form-control-sm" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
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
                        <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaCapturaBloquera">
                            <thead>
                                <tr>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Presentación</th>
                                    <th class="text-center">Cantidad Barcadas</th>
                                    <th class="text-center">Bandejas producidas</th>
                                    <th class="text-center">Piezas producidas</th>
                                    <th class="text-center">Cemeno utilizado</th>
                                    <th class="text-center">Aditivo utilizado</th>
                                    <th class="text-center">Fecha captura</th>
                                    <th class="text-center">Turno</th>
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

<script type="text/javascript">
    function operaciones(id){
        var datos = new FormData();

        var a = ($('#spanpiezas').text() * $('#inputbandeja').val());

        var tp = (a - $('#inputpesadas').val());

        $("#spPiezasTotal").html(tp);

        var b = ($('#inputbarcadas').val() * $('#inputcemento').val());

        $("#spConsumoCemento").html(b);

        var c = ($('#spConsumoCemento').text() / $('#spPiezasTotal').text());

        var totalc = parseFloat(c).toFixed(3);

        $("#spCementoPieza").html(totalc);

    }
</script>

<script type="text/javascript">
    function porcentaje(id){
        var datos = new FormData();

        var sum = (parseFloat($('#inputpolvo').val()) + parseFloat($('#inputgravilla').val()) + parseFloat($('#inputgravillados').val()));

        var d = ($('#inputpolvo').val() * 100);

        var e = ($('#inputgravilla').val() * 100);

        var ed = ($('#inputgravillados').val() * 100);

        var f = (d / sum);

        var g = (e / sum);

        var gd = (ed / sum);

        var h = parseInt(f);

        var i = parseInt(g);

        var j = parseInt(gd);

        $("#spPorcpolvo").html(h + '%');

        $("#spPorcGravilla").html(i + '%');

        $("#spPorcGravillados").html(j + '%');

    }
</script>

<!-- <script src="vista_captura.js"></script> -->


    <script src="../../../includes/js/jquery351.min.js"></script>

    <!-- <script src="vista_captura.js"></script> -->

<?php include_once "../../inferior.php" ?>

    <script src="vista_besser.js"></script>

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>
    
    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>

    <script type="text/javascript">
        consultar();
    </script>