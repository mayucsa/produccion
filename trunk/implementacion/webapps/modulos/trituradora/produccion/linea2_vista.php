<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        // include_once"modelo_tiempoperdido.php";
        // include_once"enviar_mail.php";
?>
    <head>
        <title>Captura de Producci&oacute;n</title>

        <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
        <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="../../../includes/timepicker/bootstrap-clockpicker.min.css">
        <link rel="stylesheet" type="text/css" href="../../../includes/datapicker/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="../../../includes/datapicker/jquery-ui.min.css">
    </head>

<div ng-controller="VistaProduccionLinea2">
<!-- MODAL REPORTE -->
<div id="modalReporte" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Reporte de movimientos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row form-group form-group-sm">
          <div class="col-lg-12 d-lg-flex">
            <div style="width: 100%;">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <input type="checkbox" ng-model="repoGlobal" ng-click="checkTipoRepo(1)">
                  </div>
                </div>
                <input type="text" placeholder="Global" class="form-control" aria-label="Text input with checkbox" disabled>
              </div>
            </div>

            <div style="width: 100%;">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <input type="checkbox" ng-model="repoDetallado" ng-change="checkTipoRepo(2)">
                  </div>
                </div>
                <input type="text" placeholder="Detallado" class="form-control" aria-label="Text input with checkbox" disabled>
              </div>
            </div>
          </div>
        </div>
        <div class="row form-group form-group-sm" ng-show="repoDetallado">
          <div class="col-lg-12 d-lg-flex">
            <div style="width: 100%;" class="form-floating mx-1">
              <input class="date-picker form-control" min="2022-11-27" ng-model="fechaRepo" id="fechaRepo" ng-blur="checkFecha(fechaRepo, 2)">
              <label>Fecha</label>
            </div>
            <div style="width: 100%;" class="form-floating mx-1">
                <select class="form-control form-group-md" ng-model="turnoRepo" id="turnoRepo">
                    <option value="">[Seleccione una opción..]</option>
                    <option value="1">1er turno</option>
                    <option value="2">2do turno</option>
                    <option value="3">3er turno</option>
                </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-click="getReporte()" ng-disabled="repoDetallado && fechaRepo == '' && turnoRepo == ''">Imprimir <i class="fas fa-print"></i></button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL EDITAR GRUPO -->
<div id="modalEditar" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-l">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card-body">
        <input ng-show="false" type="text" ng-model="cve_pte" class="form-control" id="inputidedit" name="inputidedit" disabled >
          <div class="row form-group form-group-sm">
              <div class="col-lg-12 d-lg-flex">
                  <div style="width: 50%;" class="form-floating mx-1">
                      <select class="form-control form-group-md" ng-model="maquinae"  id="selectmaquinae" name="selectmaquinae">
                          <option selected="selected" value="0">[Seleccione una opción..]</option>
                          <option ng-repeat="(i, obj) in Maquinas" value="{{obj.cve_maq}}">{{obj.cve_alterna}} - {{obj.nombre_maq}}</option>
                      </select>
                      <label>Máquina</label>
                  </div>
                  <div style="width: 50%;" class="form-floating mx-1">
                      <select class="form-control form-group-md" ng-model="tmateriale" id="inputtmateriale" name="inputtmateriale">
                          <option selected="selected" value="0">[Seleccione una opción..]</option>
                          <option ng-repeat="(i, obj) in TipoMaterial" value="{{obj.cve_mt}}">{{obj.cve_alterna}} - {{obj.nombre_material}}</option>
                      </select>
                      <label>Tipo de material</label>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="button" value="Actualizar" ng-click="editartp()" class="btn btn-primary">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- FIN DE MODAL -->
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-tasks"></i> Producci&oacute;n Linea 2</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="linea1_vista.php"> Producci&oacute;n</a></li>
        </ul>
      </div>

    <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card card-info">
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
                            <div style="width: 100%;" class="form-floating mx-1">
                                <select class="form-control form-group-md" ng-model="maquina" id="selectmaquina" name="selectmaquina">
                                    <option selected="selected" value="" disabled>[Seleccione una opción..]</option>
                                    <option ng-repeat="(i, obj) in Maquinas" value="{{obj.cve_maq}}">{{obj.cve_alterna}} - {{obj.nombre_maq}}</option>
                                </select>
                                <label>Máquina</label>
                            </div>
                            <!-- <div style="width: 100%;" class="form-floating mx-1">
                                <input type="number" ng-model="maquina" id="inputmaquina" class="form-control form-control-sm validanumericos" ng-keypress="($event.charCode==13)?validaMaquina(maquina):return">
                                <label>Código de máquina</label>
                            </div>
                            <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" ng-model="nmaquina" name="inputnmaquina" class="form-control form-control-sm UpperCase" disabled>
                                <label>Nombre de Máquina</label>
                            </div> -->
                            <div style="width: 100%;" class="form-floating mx-1">
                                <select class="form-control form-group-md" ng-model="tmaterial" id="selecttmaterial" name="selecttmaterial">
                                    <option selected="selected" value="" disabled>[Seleccione una opción..]</option>
                                    <option ng-repeat="(i, obj) in TipoMaterial" value="{{obj.cve_mt}}">{{obj.cve_alterna}} - {{obj.nombre_material}}</option>
                                </select>
                                <label>Tipo de material</label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group form-group-sm border-top">
                        <div class="col-sm-12" align="center">
                            <input type="submit" value="Guardar" href="#" ng-click="validacionDatos()" class="btn btn-primary" style="margin-bottom: -25px !important" ng-show="perfilUsu.produccion_trituradoral1_captura == 1">
                            <input type="submit" value="Limpiar" href="#" ng-click="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important" ng-show="perfilUsu.produccion_trituradoral1_captura == 1">
                            <button type="submit" href="#" class="btn btn-danger" data-toggle="modal" data-target="#modalReporte" data-whatever="@getbootstrap" style="margin-bottom: -25px !important">Reporte <i class="fas fa-file-pdf"></i></button>
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
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover w-100 shadow" id="tableserverSideTPLinea2">
                                <thead>
                                    <tr>
                                        <th class="text-center">Folio</th>
                                        <th class="text-center">Máquina</th>
                                        <th class="text-center">Material</th>
                                        <th class="text-center">M3</th>
                                        <th class="text-center">Supervisor</th>
                                        <th class="text-center">Fecha captura</th>
                                        <th class="text-center">Turno</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(i, obj) in ssProduccionLinea2 track by i">
                                        <td class="text-center">{{obj.cve_pt}}</td>
                                        <td class="text-center">{{obj.nombre_maq}}</td>
                                        <td class="text-center">{{obj.cve_alterna}} - {{obj.nombre_material}}</td>
                                        <td class="text-center">{{obj.capacidad_m3}}</td>
                                        <td class="text-center">{{obj.nombre}} {{obj.apellido}}</td>
                                        <td class="text-center">{{obj.fecha_registro}}</td>
                                        <td class="text-center">
                                            <span class= "badge badge-success">
                                                {{obj.Turno}}
                                            </span>
                                        </td>
                                        <td class="text-center" nowrap="nowrap">
                                            <span class= "btn btn-warning btn-sm" ng-show="perfilUsu.produccion_trituradoral2_edit == 1" ng-click="obtenerDatosEdit(obj.cve_pt)" title="Editar" data-toggle="modal" data-target="#modalEditar" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> </span>
                                            <span class= "btn btn-danger btn-sm" ng-show="perfilUsu.produccion_trituradoral2_edit == 1" ng-click="eliminartp(obj.cve_pt)" title="Eliminar"><i class="fas fa-trash-alt"></i> </span>
                                            <span class= "btn btn-warning btn-sm" ng-show="perfilUsu.produccion_trituradoral2_edit == 0" ng-click="sinacceso()" title="Editar"><i class="fas fa-edit"></i> </span>
                                            <span class= "btn btn-danger btn-sm" ng-show="perfilUsu.produccion_trituradoral2_edit == 0" ng-click="sinacceso()" title="Eliminar"><i class="fas fa-trash-alt"></i> </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

          </div>
        </div>
    </div> <!--FIN DE DIV ROW--->
        <?php include_once "reporte.html";  ?>
        <?php include_once "../../footer.php";  ?>
    </main>
</div>

    <script src="../../../includes/js/adminlte.min.js"></script>

    <script src="../../../includes/js/jquery351.min.js"></script>

    <!-- <script src="tiempoperdido.js"></script> -->
    <script src="produccion_ajs.js"></script>

<?php 
include_once "../../inferior.php";
?>

    <!-- <script src="vista_besser.js"></script> -->

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

    <script type="text/javascript" src="../../../includes/timepicker/bootstrap-clockpicker.min.js"></script>
    <script type="text/javascript" src="../../../includes/datapicker/jquery-ui.min.js"></script>
    <script>
        $('.date-picker').datepicker({
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            // minDate: tomorrow,
            // changeDay: true,
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy-mm-dd',
            showDays: false,
        });
    </script>