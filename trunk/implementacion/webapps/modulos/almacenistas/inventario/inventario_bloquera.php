<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        // include_once"modelo_confirmacion.php";
        // include_once"enviar_mail.php";
?>
        <head>
            <title>Inventario por estibas</title>
                <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
        </head>

<div id="modalEstiba" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="tableConfirmacion" autocomplete="off" method="POST">
            <label hidden for="message-text" class="col-form-label">ID:</label>
            <input hidden type="text" class="form-control" id="comb_ide" name="comb_ide" required="" >
          <div class="form-group form-group-sm">
            <label for="recipient-name " class="col-form-label">Área:</label>
              <select id="comb_areae" name="comb_areae" class="js-example-basic-single form-control" required ="" disabled>
                  <option selected="selected" disabled>[Selecciones una opción..]</option>
                      <?php   
                          $sql        = "SELECT cve_estiba, area FROM seg_inventario_estibas";
                          $query      = $stmt -> prepare ($sql);
                          $query      -> execute();
                          $resultado  = $query -> fetchAll();

                        foreach ($resultado as $resultado) {
                            echo '<option>'.$resultado["area"].'</option>';
                        }
                      ?>
              </select>
          </div>
          <div class="form-group form-group-sm">
            <label for="recipient-name " class="col-form-label">Producto:</label>
              <select id="comb_productoe" name="comb_productoe" class="js-example-basic-single form-control" required ="" disabled>
                  <option selected="selected" disabled>[Selecciones una opción..]</option>
                      <?php   
                          $sql        = "SELECT cve_estiba, nombre_producto FROM seg_inventario_estibas";
                          $query      = $stmt -> prepare ($sql);
                          $query      -> execute();
                          $resultado  = $query -> fetchAll();

                        foreach ($resultado as $resultado) {
                            echo '<option>'.$resultado["nombre_producto"].'</option>';
                        }
                      ?>
              </select>
          </div>
          <div class="form-group form-group-sm">
            <label for="recipient-name " class="col-form-label">Presentación:</label>
              <select id="comb_presente" name="comb_presente" class="js-example-basic-single form-control" required ="" disabled>
                  <option selected="selected" disabled>[Selecciones una opción..]</option>
                      <?php   
                          $sql        = "SELECT cve_estiba, presentacion FROM seg_inventario_estibas";
                          $query      = $stmt -> prepare ($sql);
                          $query      -> execute();
                          $resultado  = $query -> fetchAll();

                        foreach ($resultado as $resultado) {
                            echo '<option>'.$resultado["presentacion"].'</option>';
                        }
                      ?>
              </select>
          </div>
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Celdas:</label>
            <input type="text" class="form-control validanumericos" id="input_celdase" name="input_celdase" required="" disabled>
          </div>
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Numero de estiba:</label>
            <input type="text" class="form-control validanumericos" id="input_estibae" name="input_estibae" required="" disabled>
          </div>
          <!-- <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Cantidad rotura:</label>
            <input type="text" class="form-control validanumericos" id="input_cantroturac" name="input_cantroturac" required="" disabled>
          </div> -->
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Cantidad:</label>
            <input type="text" class="form-control validanumericos" id="input_cantidade" name="input_cantidade" required="" disabled>
          </div>
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Rotura del día:</label>
            <input type="text" class="form-control validanumericos" id="input_roturae" name="input_roturae" required="">
          </div>
            <div class="form-group form-group-sm">
                <span hidden id="spanuser" name="spanuser" class="form-control" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
            </div>
      </div>
        <div class="modal-footer">
          <input type="button" value="Confirmar" onclick="RoturaDiaria()" class="btn btn-primary">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div ng-controller="vistaInventario">

            <!-- MODAL DE ROTURA -->
            <div class="row" style="position: fixed; z-index: 9; background-color: white; width: 70%; margin-left: 20%;  border-radius: 15px; padding: 5vH; border: solid;" ng-show="modalMisRequ == true">
                <div class="col-lg-12 col-md-12" style="max-height: 50vH; overflow-y: auto;">
                    <h3>Rotura del día</h3>
                    <div class="row form-group form-group-sm">
                        <div class="col-lg-12 d-lg-flex" ng-show="false">
                            <div style="width: 33%;" class="form-floating mx-1">
                                <input type="text" ng-model="idproducto" id="inputidproducto" name="inputidproducto" class="form-control form-control-md validanumericos" disabled>
                                <label>Producto</label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group form-group-sm">
                        <div class="col-lg-12 d-lg-flex">
                            <div style="width: 33%;" class="form-floating mx-1">
                                <input type="text" ng-model="producto" id="inputproducto" name="inputproducto" class="form-control form-control-md validanumericos" disabled>
                                <label>Producto</label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group form-group-sm">
                        <div class="col-lg-12 d-lg-flex">
                            <div style="width: 33%;" class="form-floating mx-1">
                                <input type="text" ng-model="estiba" id="inputestiba" name="inputestiba" class="form-control form-control-md validanumericos" disabled>
                                <label>Numero de estiba</label>
                            </div>
                            <div style="width: 33%;" class="form-floating mx-1">
                                <input type="text" ng-model="existencia" id="inputexistencia" name="inputexistencia" class="form-control form-control-md validanumericos" disabled>
                                <label>Existencia</label>
                            </div>
                            <div style="width: 33%;" class="form-floating mx-1">
                                <input type="text" ng-model="rotura" id="inputrotura" name="inputrotura" class="form-control form-control-md validanumericos" ng-blur="validaExistencia(rotura)">
                                <label>Cantidad de rotura</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 text-right">
                    <button class="btn btn-success" ng-click="roturadiaria()">Confirmar estiba</button>
                    <button class="btn btn-danger" ng-click="setModalMisRequ()">Cerrar</button>
                </div>
            </div>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-check-square"></i> Inventario por estibas</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="inventario_bloquera.php"> Inventario por estibas</a></li>
        </ul>
      </div>

<!--       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card">
                <div class="card-header">
                    <div align="right">
                        <a href="excelestibas.php" id="btnExcel" type="button" class="btn btn-success">Descargar Excel <b class="fas fa-file-excel"></b></a>
                        <a href="excelinvetario.php" id="btnExcel" type="button" class="btn btn-success">Inventario del mes <b class="fas fa-file-excel"></b></a>
                    </div>
                </div>
                <div class="card-body">
                    <h3>Inventario por estibas</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaEstibas">
                            <thead>
                                <tr>
                                    <th class="text-center">Área</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Número de celdas</th>
                                    <th class="text-center">Presentación</th>
                                    <th class="text-center">Número de estiba</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Rotura</th>
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
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div> -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="card">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">INVENTARIO BLOQUERA</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaEstibas">
                                <thead>
                                    <tr>
                                        <th class="text-center">Area</th>
                                        <th class="text-center">Producto</th>
                                        <th class="text-center">Número de estiba</th>
                                        <th class="text-center">Cantidad actual</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(i, obj) in ssInventarioBloquera track by i">
                                        <td class="text-center">{{obj.area}}</td>
                                        <td class="text-center">{{obj.nombre_producto}} - {{obj.presentacion}} - {{obj.num_celdas}} CELDAS</td>
                                        <td class="text-center">{{obj.numero_estiba}}</td>
                                        <td class="text-center">{{obj.cantidad_estiba}}</td>
                                        <td class="text-center">
                                            <span class= "btn btn-danger btn-sm" ng-show="perfilUsu.inventario_almacenistas_rotura == 1" ng-click="setModalMisRequ(obj.numero_estiba)"><i class="fas fa-unlink"></i> </span>
                                            <span class= "btn btn-danger btn-sm" ng-show="perfilUsu.inventario_almacenistas_rotura == 0" ng-click="sinacceso()" ng-show=""><i class="fas fa-unlink"></i> </span>
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
      <?php include_once "../../footer.php" ?>
    </main>
</div> 

<script src="../../../includes/js/adminlte.min.js"></script>

<script src="inventario_bloquera_ajs.js"></script>

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

    <script src="../../../includes/js/data_tables_js/jquery.dataTables.min.js"></script>
    <script src="../../../includes/js/data_tables_js/dataTables.buttons.min.js"></script>
    <script src="../../../includes/js/data_tables_js/jszip.min.js"></script>
    <script src="../../../includes/js/data_tables_js/pdfmake.min.js"></script>
    <script src="../../../includes/js/data_tables_js/vfs_fonts.js"></script>
    <script src="../../../includes/js/data_tables_js/buttons.html5.min.js"></script>
    <script src="../../../includes/js/data_tables_js/buttons.print.min.js"></script>
