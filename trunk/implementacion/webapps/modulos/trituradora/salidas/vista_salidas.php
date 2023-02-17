<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        // include_once"modelo_salidas.php";
        // include_once"enviar_mail.php";
?>
        <head>
            <title>Captura de Producci&oacute;n</title>
            <style type="text/css">
                canvas {
                    width: 500px;
                    height: 300px;
                    background-color: white;
                    border: solid 1px;
                }
                body{
                    background-color: #f7f6f6;
                }
                table thead{
                    background-color: #1A4672;
                    color:  white;
                }
                .fixedTable tbody{
                    display: block;
                    height:400px;
                    overflow-y:auto;
                }
                .fixedTable thead, tbody, tr{
                    display: table;
                    width: 100%;
                    table-layout: fixed;
                }
                .fixedTable thead{
                    width: calc( 100% - 1em )
                }
            </style>
                <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
            </style>
        </head>
<div ng-controller="vistaDespachoTrituradora">
    <!-- Modal firma -->
    <div class="modal fade" id="firmasModal" tabindex="-1" aria-labelledby="firmasModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="firmasModalLabel">Firmar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6 offset-md-2">
                    <canvas id="pizarra"></canvas>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-light" onclick="limpiar()">Limpiar firma</button>
            <button type="button" class="btn btn-danger" ng-click="cancelarFirma()">Cancelar</button>
            <button class="btn btn-success" ng-click="aceptarFirma()">Aceptar</button>
          </div>
        </div>
      </div>
    </div>
            <!-- MODAL DE DESPACHO -->
            <div class="row" style="position: fixed; z-index: 9; background-color: white; width: 70%; margin-left: 20%;  border-radius: 15px; padding: 5vH; border: solid;" ng-show="modalMisRequ == true">
                <div class="col-lg-12 col-md-12" style="max-height: 50vH; overflow-y: auto;">
                    <h3>Verificación de producto</h3>
                    <div class="row form-group form-group-sm">
                        <div class="col-lg-12 d-lg-flex">
                            <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" ng-model="documento" id="inputdocumento" name="inputdocumento" class="form-control form-control-md validanumericos" disabled>
                                <label>CIDDOCUMENTO</label>
                            </div>
                            <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" ng-model="foliov" id="inputfoliov" name="inputfoliov" class="form-control form-control-md validanumericos" disabled>
                                <label>Folio</label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group form-group-sm">
                        <div class="col-lg-12 d-lg-flex">
                            <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" ng-model="clientev" id="inputclientev" name="inputclientev" class="form-control form-control-md validanumericos" disabled>
                                <label>Cliente</label>
                            </div>
                            <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" ng-model="placasv" id="inputplacasv" name="inputplacasv" class="form-control form-control-md validanumericos" disabled>
                                <label>Chofer / placas</label>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover w-100 shadow" id="tablaModal">

                        </table>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 text-right">
                    <button class="btn btn-success" ng-click="verificar()">Confirmar nota de ventas</button>
                    <button class="btn btn-danger" ng-click="setModalMisRequ()">Cerrar</button>
                </div>
            </div>
            <!-- FIN DEL MODAL -->
    <main class="app-content">
        <div class="app-title">
            <div>
            <h1><i class="fas fa-sign-out-alt"></i> Salidas trituradora</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="vista_salidas.php"> Salidas trituradora</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Despacho bloqueras</h3>
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
                                        <input type="number" ng-model="folio" id="nextFocusHeader0" class="form-control form-control-sm validanumericos" ng-keypress="($event.charCode==13)?validaFolio(folio):return">
                                        <label>Folio</label>
                                    </div>
                                    <!-- <div style="width: 100%;" class="form-floating mx-1">
                                        <input type="text" ng-model="documento" id="nextFocusHeader1" name="inputdocumento" class="form-control form-control-sm validanumericos" readonly>
                                        <label>Documento</label>
                                    </div> -->
                                    <div style="width: 100%;" class="form-floating mx-1">
                                        <input type="text" ng-model="cliente" id="nextFocusHeader1" name="inputcliente" class="form-control form-control-sm validanumericos" disabled>
                                        <label>Cliente</label>
                                    </div>
                                    <div style="width: 100%;" class="form-floating mx-1">
                                        <input type="text" ng-model="placas" id="inputplacas" name="inputplacas" class="form-control form-control-sm validanumericos" disabled>
                                        <label>Chofer / placas</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group form-group-sm border-top">
                                <div class="col-sm-12" align="center">
                                    <input type="submit" value="Surtir pedido" href="#" ng-click="despachar()" ng-show="admDocumentosDetalle.length > 0" class="btn btn-primary" style="margin-bottom: -25px !important">
                                    <input type="submit" value="Limpiar" href="#" ng-click="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important">
                                    <!-- <input type="submit" value="prueba" href="#" ng-click="prueba()" class="btn btn-success" style="margin-bottom: -25px !important"> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="tile">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Despacho bloqueras</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row form-group form-group-sm">
                                <div class="col-lg-12 d-lg-flex">
                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Folio</th>
                                                <th class="text-center">Clave Producto</th>
                                                <th class="text-center">Producto</th>
                                                <th class="text-center">Cantidad</th>
                                                <!-- <th class="text-center">Indicar cant a surtir</th> -->
                                                <!-- <th class="text-center">Estiba</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="(i, obj) in admDocumentosDetalle track by i">
                                                <td class="text-center">{{obj.CFOLIO}}</td>
                                                <td class="text-center">{{obj.CIDPRODUCTO}}</td>
                                                <td class="text-center">{{obj.CNOMBREPRODUCTO}}</td>
                                                <td class="text-center">{{obj.CUNIDADESCAPTURADAS}} {{obj.CUNIDADMEDIDA}} / {{obj.SERVOBSERVAMOV}} SACOS</td>
                                                <!-- <td class="text-center">
                                                    <input type="text" ng-model="obj.CUNIDADESCAPTURADAS" class="form-control text-right">
                                                </td> -->
                                                <!-- <td class="text-center">
                                                    <input type="text" ng-model="estiba" ng-blur="validaEstiba(estiba, obj.CIDPRODUCTO, obj.CUNIDADESCAPTURADAS)" class="form-control text-right">
                                                </td> -->
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

<script src="vista_salidas_ajs.js"></script>

<script src="../../../includes/js/jquery351.min.js"></script>


<?php include_once "../../inferior.php" ?>

    <!-- <script src="vista_salidas.js"></script> -->

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
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>