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
<div ng-controller="vistaDespachoBloqueras">

    <!-- MODAL INDICAR ESTIBA -->
    <div class="row" style="position: fixed; z-index: 9; background-color: white; width: 70%; margin-left: 20%;  border-radius: 15px; padding: 5vH; border: solid;" ng-show="modalMisEstiba == true">
        <div class="col-lg-12 col-md-12" style="max-height: 50vH; overflow-y: auto;">
            <h3>Indicar estiba</h3>
            <div class="row form-group form-group-sm">
                <div class="col-lg-12 d-lg-flex">
                    <div style="width: 40%;" class="form-floating mx-1">
                        <input type="text" ng-model="folioe" id="inputfolio" name="inputfolio" class="form-control form-control-md validanumericos" disabled>
                        <label>Folio</label>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover w-100 shadow" id="tablaModalEstiba">
                    <thead>
                        <tr>
                            <th class="text-center">Cve producto</th>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Cantidad estiba</th>
                            <th class="text-center">Estiba</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="(i, obj) in tEstibasBloquera track by i">
                            <td class="text-center">{{obj.cod_producto}}</td>
                            <td class="text-center">{{obj.nombre_producto}} - {{obj.presentacion}} - {{obj.num_celdas}}</td>
                            <td class="text-center">{{obj.CUNIDADESCAPTURADAS}} PZA</td>
                            <td class="text-center">
                                <input type="text" ng-model="obj.cantidad_salida" class="form-control text-right" ng-keyup="checkCantSalidas(i)">
                            </td>
                            <td class="text-center">
                                <input type="text" ng-model="obj.estiba" id="inputestiba" ng-blur="validaEstiba(i)" ng-keyup="obj.estiba = setNumerico(obj.estiba)" class="form-control text-right">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 text-right">
            <button class="btn btn-success" ng-click="validacionEstiba()">Descontar estiba</button>
            <button class="btn btn-danger" ng-click="setModalEstiba()">Cerrar</button>
        </div>
    </div>

    <main class="app-content">
        <div class="app-title">
            <div>
            <h1><i class="fas fa-sign-out-alt"></i> Salidas bloqueras</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="ver_salidas.php"> Salidas bloqueras</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">SALIDAS DEL DÍA</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                             <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover w-100 shadow" id="tableSalidasBloquera">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Folio</th>
                                                <th class="text-center">Cliente</th>
                                                <th class="text-center">Chofer / placas</th>
                                                <th class="text-center">Fecha de surtido</th>
                                                <th class="text-center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="(i, obj) in tSalidasBloquera track by i">
                                                <td class="text-center">{{obj.CFOLIO}}</td>
                                                <td class="text-center">{{obj.CRAZONSOCIAL}}</td>
                                                <td class="text-center">{{obj.CTEXTOEXTRA2}}</td>
                                                <td class="text-center">{{obj.fecha_registro}}</td>
                                                <td class="text-center">
                                                    <span class= "btn btn-success btn-sm" ng-click="setModalEstiba(obj.CFOLIO)" title="Indicar estiba"><i class="fas fa-directions"></i> </span>
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

<script src="salidas_bloqueras_ajs.js"></script>

<script src="../../../includes/js/jquery351.min.js"></script>


<?php include_once "../../inferior.php" ?>

    <script src="vista_salidas.js"></script>

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
