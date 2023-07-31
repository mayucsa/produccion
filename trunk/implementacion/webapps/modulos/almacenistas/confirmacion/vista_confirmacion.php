<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        include_once"modelo_confirmacion.php";
        // include_once"enviar_mail.php";
?>
        <head>
            <title>Confirmaci&oacute;n desalojo</title>
                <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
            </style>
        </head>
<div ng-controller="vistaConfirmarDesalojo">
            <!-- MODAL DE EDITAR -->
<div id="modalEditar" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row form-group form-group-sm">
                <div class="col-lg-12 d-lg-flex">
                    <div style="width: 50%;" class="form-floating mx-1">
                        <input ng-show="false" type="text" ng-model="folioe" id="inputfolioe" name="inputfolioe" class="form-control form-control-md validanumericos" disabled>
                        <label>Folio</label>
                    </div>
                </div>
                <div class="col-lg-12 d-lg-flex">
                    <div style="width: 100%;" class="form-floating mx-1">
                       <select class="form-control form-control-sm" ng-model="productoe" id="selectproductoe" name="selectproductoe" disabled>
                              <option selected="selected" value="" disabled>[Seleccione una opción..]</option>
                                    <?php foreach (ModeloProducto::showProducto() as $value) { ?>
                                    <option value="<?=$value['cve_bloquera']?>"><?=$value['cod_producto']?> - <?=$value['nombre_producto']?> - <?=$value['presentacion']?> - <?=$value['num_celdas']?> CELDAS</option>
                                    <?php } ?>
                        </select>
                        <label>Producto</label>
                    </div>
                </div>
            </div>
            <div class="row form-group form-group-sm">
                <div class="col-lg-12 d-lg-flex">
                    <div style="width: 100%;" class="form-floating mx-1">
                        <input type="text" ng-model="desalojoe" id="inputdesalojoe" name="inputdesalojoe" class="form-control form-control-md validanumericos">
                        <label>Cantidad de desalojo</label>
                    </div>
                    <div style="width: 100%;" class="form-floating mx-1">
                        <input type="text" ng-model="despuntadose" id="inputdespuntadose" name="inputdespuntadose" class="form-control form-control-md validanumericos">
                        <label>Cantidad despuntados</label>
                    </div>
                    <div style="width: 100%;" class="form-floating mx-1">
                        <input type="text" ng-model="roturae" id="inputroturae" name="inputroturae" class="form-control form-control-md validanumericos" ng-blur="validaExistencia(producto, desalojo, despuntados, rotura)">
                        <label>Cantidad de rotura</label>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-click="editar(obj.cve_desalojo)">Editar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

            <!-- MODAL DE CONFIRMACIÓN -->
            <div class="row" style="position: fixed; z-index: 9; background-color: white; width: 70%; margin-left: 20%;  border-radius: 15px; padding: 5vH; border: solid;" ng-show="modalMisRequ == true">
                <div class="col-lg-12 col-md-12" style="max-height: 50vH; overflow-y: auto;">
                    <h3>Confirmacion</h3>
                    <div class="row form-group form-group-sm">
                        <div class="col-lg-12 d-lg-flex" ng-show="false">
                            <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" ng-model="idproducto" id="inputidproducto" name="inputidproducto" class="form-control form-control-md validanumericos" disabled>
                                <label>Producto</label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group form-group-sm">
                        <div class="col-lg-12 d-lg-flex">
                            <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" ng-model="folio" id="inputfolio" name="inputfolio" class="form-control form-control-md validanumericos" disabled>
                                <label>Folio</label>
                            </div>
                            <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" ng-model="producto" id="inputproducto" name="inputproducto" class="form-control form-control-md validanumericos" disabled>
                                <label>Producto</label>
                            </div>
                            <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" ng-model="desalojo" id="inputdesalojo" name="inputdesalojo" class="form-control form-control-md validanumericos" disabled>
                                <label>Cantidad desalojada</label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group form-group-sm">
                        <div class="col-lg-12 d-lg-flex">
                            <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" ng-model="despuntado" id="inputdespuntado" name="inputdespuntado" class="form-control form-control-md validanumericos" disabled>
                                <label>Cantidad de despuntados</label>
                            </div>
                            <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" ng-model="rotura" id="inputrotura" name="inputrotura" class="form-control form-control-md validanumericos" disabled>
                                <label>Cantidad de rotura</label>
                            </div>
                            <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" ng-model="estiba" id="inputestiba" name="inputestiba" class="form-control form-control-md validanumericos" ng-blur="validaEstiba(estiba)">
                                <label>Número de estiba</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 text-right">
                    <button class="btn btn-success" ng-click="confirmar()">Confirmar estiba</button>
                    <button class="btn btn-danger" ng-click="setModalMisRequ()">Cerrar</button>
                </div>
            </div>

    <main class="app-content">
        <div class="app-title">
            <div>
              <h1><i class="fas fa-check-square"></i> Confirmaci&oacute;n desalojo</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="vista_confirmacion.php"> Confirmaci&oacute;n desalojo</a></li>
            </ul>
        </div>
        <div class="card card-info">
            <div class="card-header">
                 <h3 class="card-title">CONFIRMACI&Oacute;N DE DESALOJOS</h3>
                 <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                     </button>
                 </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaConfirmacion">
                        <thead>
                            <tr>
                                <th class="text-center">Folio</th>
                                <th class="text-center">Área</th>
                                <th class="text-center">Producto</th>
                                <th class="text-center">Cantidad desalojo</th>
                                <th class="text-center">Cantidad despuntados</th>
                                <th class="text-center">Cantidad rotura</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Turno</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="(i, obj) in ssConfirmacionsDesalojo track by i">
                                <td class="text-center">{{obj.cve_desalojo}}</td>
                                <td class="text-center">{{obj.area}}</td>
                                <td class="text-center">{{obj.nombre_producto}} - {{obj.presentacion}} - {{obj.num_celdas}} CELDAS</td>
                                <td class="text-center">{{obj.cantidad_total}}</td>
                                <td class="text-center">{{obj.cantidad_despuntados}}</td>
                                <td class="text-center">{{obj.cantidad_rotura}}</td>
                                <td class="text-center">{{obj.fecha_registro}}</td>
                                <td class="text-center">
                                    <span class="badge badge-success">
                                        {{obj.Turno}}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class= "btn btn-warning btn-sm" ng-show="perfilUsu.desalojo_almacenistas_edit == 1" ng-click="obtenerDatosEdit(obj.cve_desalojo)" title="Editar" data-toggle="modal" data-target="#modalEditar" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> </span>
                                    <span class= "btn btn-success btn-sm" ng-show="perfilUsu.desalojo_almacenistas_confirmar == 1" ng-click="setModalMisRequ(obj.cve_desalojo)" title="Confirmar estiba"><i class="fas fa-check-circle"></i> </span>
                                    <!-- <span class= "btn btn-danger btn-sm" ng-click="sweet()" title="Confirmar estiba"><i class="fas fa-check-circle"></i> </span> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      <?php include_once "../../footer.php" ?>
    </main>
</div>
    

<!-- <script src="vista_confirmacion.js"></script> -->

<script src="../../../includes/js/adminlte.min.js"></script>

<script src="../../../includes/js/jquery351.min.js"></script>

<script src="vista_confirmacion_ajs.js"></script>

<?php include_once "modal_confirmacion.php" ?>

<?php include_once "../../inferior.php" ?>

    <!-- <script src="vista_vibro.js"></script> -->

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