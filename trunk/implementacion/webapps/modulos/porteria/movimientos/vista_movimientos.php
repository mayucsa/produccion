<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        // include_once"modelo_entradas.php";
        // include_once"enviar_mail.php";
?>
        <head>
            <title>Captura de Producci&oacute;n</title>
                <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
        </head>

<div ng-controller="vistaMovtosPorteria">
    <main class="app-content">
        <div class="app-title">
            <div>
              <h1><i class="fa fa-box-open"></i> Movimientos porteria</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="vista_movimientos.php"> Movimientos porteria</a></li>
            </ul>
        </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card">
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
                                <div style="width: 25%;" class="form-floating mx-1">
                                    <input type="text" ng-model="folio" id="inputfolio" name="inputfolio" class="form-control form-control-md validanumericos">
                                    <label>Folio</label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group form-group-sm border-top">
                            <div class="col-sm-12" align="center" >
                                <!-- <input type="submit" value="Generar salida" href="#" ng-click="validacionDatos()" class="btn btn-primary" style="margin-bottom: -25px !important"> -->
                                <!-- <input type="submit" value="Limpiar" href="#" ng-click="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important"> -->
                                <!-- <input type="submit" value="modal" data-toggle="modal" data-target="#modalverificar" data-whatever="@getbootstrap" class="btn btn-danger" style="margin-bottom: -25px !important"> -->
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
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaMovtos">
                                <thead>
                                    <tr>
                                        <th class="text-center">Folio</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Chofer / placa</th>
                                        <th class="text-center">Hora de entrada</th>
                                        <th class="text-center">Hora de salida</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(i, obj) in ssMovtos track by i">
                                        <td class="text-center">{{obj.folio}}</td>
                                        <td class="text-center">{{obj.cliente}}</td>
                                        <td class="text-center">{{obj.chofer}}</td>
                                        <td class="text-center">{{obj.entrada}}</td>
                                        <td class="text-center">{{obj.salida}}</td>
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


    

<!-- <script src="vista_salida_ajs.js"></script> -->

<script src="../../../includes/js/adminlte.min.js"></script>

<script src="../../../includes/js/jquery351.min.js"></script>

<script src="vista_movimientos_ajs.js"></script>

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

    <script type="text/javascript">
        // consultar();
    </script>