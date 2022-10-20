<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        include_once"modelo_seguridad.php";
?>
        <head>
            <title>Captura de Producci&oacute;n</title>
            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
            <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css"> -->
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
                <h1><i class="fas fa-tasks"></i> Seguridad</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="vista_seguridad.php"> Seguridad</a></li>
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
                            <div style="width: 25%;" class="form-floating mx-1">
                                <input type="text" id="inputnameproducto" name="inputnameproducto" class="form-control form-control-md">
                                <label>Nombre de producto</label>
                            </div>
                            <div style="width: 25%;" class="form-floating mx-1">
                                <select class="form-control form-group-md" id="selectpresentacion" name="selectpresentacion">
                                    <option selected="selected" value="0">[Seleccione una opción..]</option>
                                    <?php   
                                        $sql        = ModeloProducto::showPresentacion();

                                            foreach ($sql as $value) {
                                            echo '<option value="'.$value["valor_presentacion"].'">'.$value["valor_presentacion"].'</option>';
                                            }
                                        ?>
                                </select>
                                <label>Presentación</label>
                            </div>
                            <div style="width: 25%;" class="form-floating mx-1">
                                <select class="form-control form-group-md" id="selecttonelada" name="selecttonelada">
                                    <option selected="selected" value="0">[Seleccione una opción..]</option>
                                    <?php   
                                        $sql        = ModeloProducto::showTonelada();

                                            foreach ($sql as $value) {
                                            echo '<option value="'.$value["tonelada_producto"].'">'.$value["tonelada_producto"].'</option>';
                                            }
                                        ?>
                                </select>
                                <label>Tonelada</label>
                            </div>
                            <div style="width: 25%;" class="form-floating mx-1">
                                <select class="form-control form-group-md" id="selectcodsaco" name="selectcodsaco">
                                    <option selected="selected" value="0">[Seleccione una opción..]</option>
                                    <?php   
                                        $sql        = ModeloProducto::showSaco();

                                            foreach ($sql as $value) {
                                            echo '<option value="'.$value["cve_segmatprima"].'">'.$value["codsaco"].'</option>';
                                            }
                                        ?>
                                </select>
                                <label>Saco que utilizara</label>
                            </div>
                            <span hidden id="spanuser" name="spanuser" class="form-control form-control-sm" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
                        </div>
                    </div>
                    <div class="row form-group form-group-sm border-top">
                        <div class="col-sm-12" align="center">
                            <input type="submit" value="Guardar" href="#" onclick="validacionCampos()" class="btn btn-primary" style="margin-bottom: -25px !important">
                            <input type="submit" value="Limpiar" href="#" onclick="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-info">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover w-100 shadow" id="tablaMPproducto">
                            <thead>
                                <tr>
                                    <th class="text-center">Clave</th>
                                    <th class="text-center">Producto</th>
                                    <th class="text-center">Estatus</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- ./ end card-body -->
            </div> <!-- ./ end card-info -->

          </div>
        </div>
    </div> <!--FIN DE DIV ROW--->
      <?php include_once "../../footer.php" ?>
    </main>



<!-- <script src="vista_captura.js"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script> -->
<script src="../../../includes/js/adminlte.min.js"></script>

    <script src="../../../includes/js/jquery351.min.js"></script>

    <script src="vista_seguridad.js"></script>

<?php 
    include_once "../../inferior.php";
    include_once "modalver_mp.php";
?>

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>
    
    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>
    
<!--     <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script> -->


    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
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