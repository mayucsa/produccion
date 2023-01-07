<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        include_once"modelo_besser.php";
        // include_once"enviar_mail.php";
?>
        <head>
            <title>Captura de Producci&oacute;n</title>
                <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
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

<div ng-controller="vistaProduccionBesser">
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-tasks"></i> Producci&oacute;n Besser</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="vista_besser.php"> Producci&oacute;n Besser</a></li>
        </ul>
      </div>

    <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card">
                <div class="card card-info"> <!-- ng-show="perfilUsu.produccion_besser_captura == 1"> -->
                    <div class="card-header">
                         <h3 class="card-title">CAPTURA DE DATOS</h3>
                         <div class="card-tools">
                             <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                             </button>
                         </div>
                    </div>
                    <div class="card-body">
                        <div class="row form-group form-group-sm">
                            <div class="col-lg-12 d-lg-flex">
                                <div style="width: 50%;" class="form-floating mx-1">
                                    <select class="form-control form-control-sm" ng-model="producto" id="selectproducto" name="selectproducto" onchange="selectProducto()">
<!--                                         <option selected="selected" value="0">[Seleccione una opción..]</option>
                                        <php   
                                            $sql        = ModeloProducto::showProductoBesser();
                                                foreach ($sql as $key =>$value) {
                                                echo '<option value="'.$value["cve_bloquera"].'">'.$value["cod_producto"].' - '.$value["nombre_producto"].' - '.$value["presentacion"].' - '.$value["num_celdas"].' Celdas'.'</option>';
                                                }
                                            ?> -->
                                          <option selected="selected" value="" disabled>[Seleccione una opción..]</option>
                                                <?php foreach (ModeloProducto::showProductoBesser() as $value) { ?>
                                                <option value="<?=$value['cve_bloquera']?>"><?=$value['cod_producto']?> - <?=$value['nombre_producto']?> - <?=$value['presentacion']?> - <?=$value['num_celdas']?> Celdas</option>
                                                <?php } ?>
                                    </select>
                                    <label>Producto</label>
                                </div>
                            </div>
<!--                             <div class="col-sm-2 text-left" style="font-size:13px">Producto</div>
                            <div class="col-sm-2 text-left">
                                <select class="form-control form-control-sm" id="selectproducto" name="selectproducto" onchange="selectProducto()">
                                    <option selected="selected" value="0">[Seleccione una opción..]</option>
                                    /*php   
                                        $sql        = ModeloProducto::showProductoBesser();
                                            foreach ($sql as $key =>$value) {
                                            echo '<option value="'.$value["cve_pbloquera"].'">'.$value["nombre_producto"].'</option>';
                                            }*/
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
                            <div class="col-sm-1 text-left" style="font-size:13px">Piezas</div>-->
                            <!-- <div class="col-sm-2 text-left"> -->
                                <input ng-show="false" ng-model="pieza" id="spanpiezas" name="spanpiezas" class="form-control" style="background-color: #E9ECEF;" onchange="operaciones();" disabled>
                            <!-- </div> -->
                        </div>
                        <div class="row form-group form-group-sm">
                            <div class="col-lg-12 d-lg-flex">
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text" ng-model="barcadas" id="inputbarcadas" name="inputbarcadas" class="form-control form-control-sm validanumericos" disabled>
                                    <label>Cantidad de barcadas</label>
                                </div>
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text" ng-model="bandejas" id="inputbandeja" name="inputbandeja" class="form-control form-control-sm validanumericos"  onchange="operaciones();" disabled>
                                    <label>Bandejas producidas</label>
                                </div>
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text" ng-model="cemento" id="inputcemento" name="inputcemento" class="form-control form-control-sm validanumericos" onchange="operaciones();" disabled>
                                    <label>Cemento por barcada</label>
                                </div>
                            </div>
<!--                             <div class="col-sm-2 text-left" style="font-size:13px">Cantidad de barcadas</div>
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
                            </div> -->
                        </div>
                        <div class="row form-group form-group-sm">
                            <div class="col-lg-12 d-lg-flex">
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text" ng-model="aditivo" id="inputaditivo" name="inputaditivo" class="form-control form-control-sm validanumericos" disabled>
                                    <label>Consumo de aditivo</label>
                                </div>
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text" ng-model="pesadas" id="inputpesadas" name="inputpesadas" class="form-control form-control-sm validanumericos" onchange="operaciones();" disabled>
                                    <label>Pesadas</label>
                                </div>
                            </div>
<!--                             <div class="col-sm-2 text-left" style="font-size:13px">Consumo de aditivo</div>
                            <div class="col-sm-2 text-left">
                                <input type="text" id="inputaditivo" name="inputaditivo" class="form-control form-control-sm validanumericos" placeholder="Aditivo">
                            </div>
                            <div class="col-sm-2 text-left" style="font-size:13px">Pesadas</div>
                            <div class="col-sm-2 text-left">
                                <input type="text" id="inputpesadas" name="inputpesadas" class="form-control form-control-sm validanumericos" placeholder="Pesadas" onchange="operaciones();">
                            </div> -->
                        </div>
                        <div class="row form-group form-group-sm">
                            <div class="col-lg-12 d-lg-flex">
                                <div style="width: 33%;" class="form-floating mx-1">
                                     <input type="text" ng-model="llenado" id="inputllenado" name="inputllenado" class="form-control form-control-sm validanumericos" disabled>
                                    <label>Tiempo de llenado</label>
                                </div>
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text" ng-model="humedad" id="inputhumedad" name="inputhumedad" class="form-control form-control-sm validanumericos" disabled>
                                    <label>Humedad</label>
                                </div>
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text" ng-model="pesopromedio" id="inputpesopromedio" name="inputpesopromedio" class="form-control form-control-sm validanumericos" disabled>
                                    <label>Peso Promedio</label>
                                </div>
                            </div>
<!--                             <div class="col-sm-2 text-left" style="font-size:13px">Tiempo de llenado</div>
                            <div class="col-sm-2 text-left">
                                <input type="text" id="inputllenado" name="inputllenado" class="form-control form-control-sm validanumericos" onchange="operaciones();">
                            </div>
                            <div class="col-sm-2 text-left" style="font-size:13px">Humedad</div>
                            <div class="col-sm-2 text-left">
                                <input type="text" id="inputhumedad" name="inputhumedad" class="form-control form-control-sm validanumericos" onchange="operaciones();">
                            </div>
                            <div class="col-sm-2 text-left" style="font-size:13px">Peso promedio</div>
                            <div class="col-sm-2 text-left">
                                <input type="text" id="inputpesopromedio" name="inputpesopromedio" class="form-control form-control-sm validanumericos">
                            </div> -->
                        </div>
                        <div class="row form-group form-group-sm">
                            <div class="col-lg-12 d-lg-flex">
                                <div style="width: 33%;" class="form-floating mx-1">
                                     <input type="text" ng-model="hinicial" id="inputhinicial" name="inputhinicial" class="form-control form-control-sm validanumericos" onchange="horometro();" disabled>
                                    <label>Horometro inicial</label>
                                </div>
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text" ng-model="hfinal" id="inputhfinal" name="inputhfinal" class="form-control form-control-sm validanumericos" onchange="horometro();" disabled>
                                    <label>Horometro final</label>
                                </div>
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text" ng-model="hdiferencia" id="inputhdiferencia" name="inputhdiferencia" class="form-control form-control-sm validanumericos" style="background-color: #CDCDCD"; disabled>
                                    <label>Horometor diferencia</label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group form-group-sm border-top">
                            <div class="col-sm-12" align="center">
                                <h4>Cambios de Dosificación</h4>
                            </div>
                        </div>
                        <div class="row form-group form-group-sm">
                            <div class="col-lg-12 d-lg-flex">
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text"ng-model="polvo" id="inputpolvo" name="inputpolvo" class="form-control form-control-sm validanumericos">
                                    <label>Polvo</label>
                                </div>
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text"ng-model="segundospolvo" id="inputsegpolvo" name="inputsegpolvo" class="form-control form-control-sm validanumericos">
                                    <label>Segundos</label>
                                </div>
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input ng-model="porcentajepolvo" id="spPorcpolvo" name="spPorcpolvo" class="form-control form-control-sm" style="background-color: #CDCDCD" disabled>
                                    <label>Porcentaje</label>
                                </div>
                            </div>
<!--                             <div class="col-sm-2 text-left" style="font-size:13px">Polvo</div>
                            <div class="col-sm-2 text-left">
                                <input type="text" id="inputpolvo" name="inputpolvo" class="form-control form-control-sm validanumericos">
                            </div>
                            <div class="col-sm-2 text-left" style="font-size:13px">Segundos</div>
                            <div class="col-sm-2 text-left">
                                <input type="text" id="inputsegpolvo" name="inputsegpolvo" class="form-control form-control-sm validanumericos">
                            </div>
                            <div class="col-sm-2 text-left" style="font-size:13px">Porcentaje</div>
                            <div class="col-sm-2 text-left">
                                <span id="spPorcpolvo" name="spPorcpolvo" class="form-control form-control-sm" style="background-color: #E9ECEF"></span>
                            </div> -->
                        </div>
                        <div class="row form-group form-group-sm">
                            <div class="col-lg-12 d-lg-flex">
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text" ng-model="gravilla" id="inputgravilla" name="inputgravilla" class="form-control form-control-sm validanumericos">
                                    <label>Gravilla</label>
                                </div>
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text" ng-model="segundosgravilla" id="inputseggravilla" name="inputseggravilla" class="form-control form-control-sm validanumericos">
                                    <label>Segundos</label>
                                </div>
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input ng-model="porcentajegravilla" id="spPorcGravilla" name="spPorcGravilla" class="form-control form-control-sm" style="background-color: #CDCDCD" disabled>
                                    <label>Porcentaje</label>
                                </div>
                            </div>
<!--                             <div class="col-sm-2 text-left" style="font-size:13px">Gravilla</div>
                            <div class="col-sm-2 text-left">
                                <input type="text" id="inputgravilla" name="inputgravilla" class="form-control form-control-sm validanumericos">
                            </div>
                            <div class="col-sm-2 text-left" style="font-size:13px">Segundos</div>
                            <div class="col-sm-2 text-left">
                                <input type="text" id="inputseggravilla" name="inputseggravilla" class="form-control form-control-sm validanumericos">
                            </div>
                            <div class="col-sm-2 text-left" style="font-size:13px">Porcentaje</div>
                            <div class="col-sm-2 text-left">
                                <span id="spPorcGravilla" name="spPorcGravilla" class="form-control form-control-sm" style="background-color: #E9ECEF"></span>
                            </div> -->
                        </div>
                        <div class="row form-group form-group-sm">
                            <div class="col-lg-12 d-lg-flex">
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text" ng-model="gravillados" id="inputgravillados" name="inputgravillados" class="form-control form-control-sm validanumericos" onchange="porcentaje();">
                                    <label>Gravilla</label>
                                </div>
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text" ng-model="segundosgravillados" id="inputseggravillados" name="inputseggravillados" class="form-control form-control-sm validanumericos">
                                    <label>Segundos</label>
                                </div>
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input type="text" ng-model="porcentajegravillados" id="spPorcGravillados" name="spPorcGravillados" class="form-control form-control-sm" style="background-color: #CDCDCD" disabled>
                                    <label>Porcentaje</label>
                                </div>
                            </div>
<!--                             <div class="col-sm-2 text-left" style="font-size:13px">Gravilla</div>
                            <div class="col-sm-2 text-left">
                                <input type="text" id="inputgravillados" name="inputgravillados" class="form-control form-control-sm validanumericos" onchange="porcentaje();">
                            </div>
                            <div class="col-sm-2 text-left" style="font-size:13px">Segundos</div>
                            <div class="col-sm-2 text-left">
                                <input type="text" id="inputseggravillados" name="inputseggravillados" class="form-control form-control-sm validanumericos">
                            </div>
                            <div class="col-sm-2 text-left" style="font-size:13px">Porcentaje</div>
                            <div class="col-sm-2 text-left">
                                <span id="spPorcGravillados" name="spPorcGravillados" class="form-control form-control-sm" style="background-color: #E9ECEF"></span>
                            </div> -->
                        </div>
                        <div class="row form-group form-group-sm">
                            <div class="col-lg-12 d-lg-flex">
                                <div style="width: 33%;" class="form-floating mx-1">
                                     <input ng-model="piezastotal" id="spPiezasTotal" name="spPiezasTotal" class="form-control form-control-sm" style="background-color: #CDCDCD;" disabled>
                                    <label>Piezas totales</label>
                                </div>
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input ng-model="cementototal" id="spConsumoCemento" name="spConsumoCemento" class="form-control form-control-sm" style="background-color: #CDCDCD;" disabled>
                                    <label>Consumo total de cemento</label>
                                </div>
                                <div style="width: 33%;" class="form-floating mx-1">
                                    <input ng-model="cementopieza" id="spCementoPieza" name="spCementoPieza" class="form-control form-control-sm" style="background-color: #CDCDCD;" disabled>
                                    <label>Cemento por pieza</label>
                                </div>
                            </div>
<!--                             <div class="col-sm-2 text-left" style="font-size:13px">Piezas totales</div>
                            <div class="col-sm-2 text-left">
                                <span id="spPiezasTotal" name="spPiezasTotal" class="form-control form-control-sm" style="background-color: #E9ECEF;"></span>
                            </div>
                            <div class="col-sm-2 text-left" style="font-size:13px">Consumo total de cemento</div>
                            <div class="col-sm-2 text-left">
                                <span id="spConsumoCemento" name="spConsumoCemento" class="form-control form-control-sm" style="background-color: #E9ECEF;"></span>
                            </div>
                            <div class="col-sm-2 text-left" style="font-size:13px">Cemento por pieza</div>
                            <div class="col-sm-2 text-left">
                                <span id="spCementoPieza" name="spCementoPieza" class="form-control form-control-sm" style="background-color: #E9ECEF;"></span>
                            </div> -->
                            <div class="col-sm-2 text-left">
                                <span hidden  id="spanuser" name="spanuser" class="form-control form-control-sm" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
                            </div>
                        </div>
                        <div class="row form-group form-group-sm border-top">
                            <div class="col-sm-12" align="center" >
                                <input type="submit" value="Guardar" href="#" ng-click="validacionCampos()" class="btn btn-primary" style="margin-bottom: -25px !important">
                                <input type="submit" value="Limpiar" href="#" ng-click="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">REGISTRO DE CAPTURA</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaCapturaBloquera">
                                <thead>
                                    <tr>
                                        <th class="text-center">Folio</th>
                                        <th class="text-center">Nombre de producto</th>
                                        <th class="text-center">Cantidad Barcadas</th>
                                        <th class="text-center">Bandejas producidas</th>
                                        <th class="text-center">Piezas producidas</th>
                                        <th class="text-center">Cemento utilizado</th>
                                        <th class="text-center">Aditivo utilizado</th>
                                        <th class="text-center">Fecha captura</th>
                                        <th class="text-center">Turno</th>
                                        <th class="text-center">Opciones</th>
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
    </div>
      <?php include_once "../../footer.php" ?>
    </main>
</div>

<script type="text/javascript">
    function operaciones(id){
        var datos = new FormData();

        var a = ($('#spanpiezas').val() * $('#inputbandeja').val());

         $("#spPiezasTotal").val(a);

        var tp = (a - $('#inputpesadas').val());

        $("#spPiezasTotal").val(tp);

        var b = ($('#inputbarcadas').val() * $('#inputcemento').val());

        $("#spConsumoCemento").val(b);

        var c = ($('#spConsumoCemento').val() / $('#spPiezasTotal').val());

        var totalc = parseFloat(c).toFixed(3);

        $("#spCementoPieza").val(totalc);

    }
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

        $("#spPorcpolvo").val(h + '%');

        $("#spPorcGravilla").val(i + '%');

        $("#spPorcGravillados").val(j + '%');

    }
    function horometro(id){
        var datos = new FormData();

        var dif = ($('#inputhfinal').val() - $('#inputhinicial').val());
        var d = parseFloat(dif).toFixed(3);
        console.log(d);
        $("#inputhdiferencia").val(d);
    }
</script>

<!-- <script src="vista_captura.js"></script> -->

    <script src="../../../includes/js/adminlte.min.js"></script>

    <script src="../../../includes/js/jquery351.min.js"></script>

    <!-- <script src="vista_captura.js"></script> -->

<?php include_once "../../inferior.php" ?>

    <script src="vista_besser.js"></script>
    <script src="vista_besser_ajs.js"></script>

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>
    
    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>

    <script src="../../../includes/js/data_tables_js/jquery.dataTables.min.js"></script>
    <script src="../../../includes/js/data_tables_js/dataTables.buttons.min.js"></script>
    <script src="../../../includes/js/data_tables_js/jszip.min.js"></script>
    <script src="../../../includes/js/data_tables_js/pdfmake.min.js"></script>
    <script src="../../../includes/js/data_tables_js/vfs_fonts.js"></script>
    <script src="../../../includes/js/data_tables_js/buttons.html5.min.js"></script>
    <script src="../../../includes/js/data_tables_js/buttons.print.min.js"></script>

    <script type="text/javascript">
        consultar();
    </script>