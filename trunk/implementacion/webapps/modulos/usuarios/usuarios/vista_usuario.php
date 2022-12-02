<?php   
    include_once "../../superior.php";
    include_once "../../../dbconexion/conexion.php";
    include_once "modelo_usuario.php";

?>        
        <head>
            <title>Captura de Usuarios</title>

            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
        </head>
<!-- <div ng-controller="vistaUsuario"> -->

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
                <h1><i class="fa fa-user-tag"></i> Usuario</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="vista_usuario.php"> Usuario</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile" id="captura_user">
                    <div class="card">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">CAPTURA DE USUARIO NUEVO</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row form-group form-group-sm">
                                    <div style="width: 30%;" class="form-floating mx-1">
                                        <input required type="text" class="form-control" ng-model="inputusuario" id="inputusuario" name="inputusuario">
                                        <label>Nombre de usuario</label>
                                    </div>
                                    <div style="width: 30%;" class="form-floating mx-1">
                                        <input required type="text" class="form-control" ng-model="inputnombre" id="inputnombre" name="inputnombre">
                                        <label>Nombre</label>
                                    </div>
                                    <div style="width: 30%;" class="form-floating mx-1">
                                        <input required type="text" class="form-control" ng-model="inputapellido" id="inputapellido" name="inputapellido">
                                        <label>Apellido</label>
                                    </div>
                                </div>
                                <div class="row form-group form-group-sm">
                                    <div style="width: 30%;" class="form-floating mx-1">
                                        <input required type="text" class="form-control" ng-model="inputpuesto" id="inputpuesto" name="inputpuesto">
                                        <label>Puesto</label>
                                    </div>
                                    <div style="width: 30%;" class="form-floating mx-1">
                                        <input required type="text" class="form-control" ng-model="inputcorreo" id="inputcorreo" name="inputcorreo">
                                        <label>Email</label>
                                    </div>
                                </div>
                                <div class="row form-group form-group-sm border-top">
                                    <div class="col-sm-12" align="center">
                                        <input type="submit" value="Crear usuario" href="#" onclick="insertUsuario()" class="btn btn-primary" style="margin-bottom: -25px !important">
                                        <input type="submit" value="Limpiar" href="#" onclick="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important">
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>


      <?php include_once "../../footer.php" ?>
    </main>
<!-- </div> -->

<script src="../../../includes/js/adminlte.min.js"></script>

<script src="../../../includes/js/jquery351.min.js"></script>

<script src="vista_usuario.js"></script>


<!-- <?php /*include_once "modalrol.php"*/ ?> -->
<?php include_once "../../inferior.php" ?>

    <!-- <script src="vista_usuario_ajs.js"></script> -->

    <script src="vista_usuario.js"></script>

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>
    
    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>
    <script src="../../../includes/js/data_tables_js/jquery.dataTables.min.js"></script>
    <script src="../../../includes/js/data_tables_js/dataTables.buttons.min.js"></script>
    <script src="../../../includes/js/data_tables_js/jszip.min.js"></script>
    <script src="../../../includes/js/data_tables_js/pdfmake.min.js"></script>
    <script src="../../../includes/js/data_tables_js/vfs_fonts.js"></script>
    <script src="../../../includes/js/data_tables_js/buttons.html5.min.js"></script>
    <script src="../../../includes/js/data_tables_js/buttons.print.min.js"></script>