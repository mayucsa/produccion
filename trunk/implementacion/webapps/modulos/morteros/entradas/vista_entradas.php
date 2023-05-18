<?php   
    include_once "../../superior.php";
    include_once "../../../dbconexion/conexion.php";
    include_once "modelo_entradas.php";
?>        
        <head>
            <title>Entradas</title>
                <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">

        </head>
<div ng-controller="vistaEntradasMorteros">
    <div class="modal fade" id="myLoadingGral" tabindex="-3" data-backdrop="static" data-keyboard="false" style="padding-top:20%; overflow-y:visible;" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div align="center"><img src="../../../includes/imagenes/loading_gral.gif" width="140px"></div>
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
<div ng-controller="vistaEntradasMorteros">

<!-- MODAL EDITAR ENTRADA -->
<div id="modalEditar" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card-body">
        <input ng-show="false" type="text" ng-model="cve_tpe" class="form-control" id="inputidedit" name="inputidedit" disabled >
          <div class="row form-group form-group-sm">
              <div class="col-lg-12 d-lg-flex">
                    <div style="width: 25%;" class="form-floating mx-1">
                        <input class="date-picker form-control validanumericos" ng-model="folioe" id="folioe" autocomplete="off" ng-disabled="true">
                        <label>Cantidad</label>
                    </div>
              </div>
              <div class="col-lg-12 d-lg-flex">
                    <div style="width: 100%;" class="form-floating mx-1">
                        <select class="form-control form-group-md" ng-model="emateriaprima" id="emateriaprima" ng-disabled="true">
                            <option selected="selected" value="" disabled>[Seleccione una opción..]</option>
                            <option ng-repeat="(i, obj) in mp" value="{{obj.cve_mpmorteros}}">{{obj.cod_materiaprima}} - {{obj.nombre_materiaprima}}</option>
                        </select>
                        <label>Materia prima</label>
                    </div>
                    <div style="width: 100%;" class="form-floating mx-1">
                        <input class="date-picker form-control validanumericos" ng-model="cantidade" id="cantidade" autocomplete="off">
                        <label>Cantidad</label>
                    </div>
                    <div style="width: 100%;" class="form-floating mx-1" ng-show="false">
                        <input class="date-picker form-control validanumericos" ng-model="cantoriginal" id="cantoriginal" autocomplete="off">
                        <label>Cantidad</label>
                    </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="button" value="Actualizar" ng-click="editar()" class="btn btn-primary">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-box-open"></i> Entradas</h1>
            <!-- <p>Start a beautiful journey here</p> -->
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="vista_entradas.php">Entradas</a></li>
            </ul>
        </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card">
                <div class="card card-info" ng-show="perfilUsu.entradas_morteros_captura == 1">
                    <div class="card-header">
                        <h3 class="card-title">CAPTURA DE ENTRADAS</h3>
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
                                    <select class="form-control form-group-md" ng-model="materiaprima">
                                        <option selected="selected" value="" disabled>[Seleccione una opción..]</option>
                                        <option ng-repeat="(i, obj) in mp" value="{{obj.cve_mpmorteros}}">{{obj.cod_materiaprima}} - {{obj.nombre_materiaprima}}</option>
                                    </select>
                                    <label>Materia prima</label>
                                </div>
                                <div style="width: 100%;" class="form-floating mx-1">
                                    <input class="date-picker form-control validanumericos" ng-model="cantidad" id="cantidad" autocomplete="off">
                                    <label>Cantidad</label>
                                </div>
                            </div>                            
                        </div>
                        <div class="row form-group form-group-sm border-top">
                            <div class="col-sm-12" align="center">
                                <input type="submit" value="Guardar" href="#" ng-click="validacionCampos()" class="btn btn-primary" style="margin-bottom: -25px !important">
                                <input type="submit" value="Limpiar" href="#" ng-click="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">TABLA GLOBAL DE ENTRADAS</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaEntradas">
                                <thead>
                                    <tr>
                                        <th class="text-center">Folio</th>
                                        <th class="text-center">Tipo</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Fecha de registro</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(i, obj) in datosMateriaPrima track by i">
                                        <td class="text-center">{{obj.cve_entrada}}</td>
                                        <td class="text-center">{{obj.categoria}}</td>
                                        <td class="text-center">{{obj.nombre_materiaprima}}</td>
                                        <td class="text-center">{{obj.cantidad_entrada}}</td>
                                        <td class="text-center">{{obj.fecha_registro}}</td>
                                        <td nowrap="nowrap" class="text-center">
                                            <span class= "btn btn-warning btn-sm" ng-show="perfilUsu.entradas_morteros_edit == 1" ng-click="consultar(obj.cve_entrada, obj.cve_, obj.cantidad_entrada)" title="Editar" data-toggle="modal" data-target="#modalEditar" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> </span>
                                            <span class= "btn btn-danger btn-sm" ng-show="perfilUsu.entradas_morteros_edit == 1" ng-click="eliminar(obj.cve_entrada, obj.cantidad_entrada, obj.cve_)" title="Eliminar"><i class="fas fa-trash-alt"></i> </span>
                                            <!-- <span class= "btn btn-warning btn-sm" ng-show="perfilUsu.entradas_morteros_edit == 0" ng-click="sinacceso()" title="Editar"><i class="fas fa-edit"></i> </span> -->
                                            <!-- <span class= "btn btn-danger btn-sm" ng-show="perfilUsu.entradas_morteros_edit == 0" ng-click="sinacceso()" title="Eliminar"><i class="fas fa-trash-alt"></i> </span> -->
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
      </div>
      <?php include_once "../../footer.php" ?>
    </main>
</div>

<script src="../../../includes/js/adminlte.min.js"></script>

<script src="../../../includes/js/jquery351.min.js"></script>

<script src="vista_entradas.js"></script>

<?php 
    include_once "modalInsertar.php"; 
    include_once "modalUpdate.php";
    include_once "../../inferior.php";
?>
    <script src="vista_entradas_ajs.js"></script>

    <script src="vista_entradas.js"></script>

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

<!-- <script type="text/javascript">
    consultar();
</script> -->

<script type="text/javascript">
        // consultar();
</script>