<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        // include_once"modelo_vibro.php";
        // include_once"enviar_mail.php";
?>
        <head>
            <title>Inventario Bloqueras</title>

            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
        </head>

    <main class="app-content">
        <div class="app-title">
            <div>
              <h1><i class="fas fa-boxes"></i> Inventario Bloqueras</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="inventario_bloquera.php"> Inventario Bloqueras</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card">
                        <div class="card-body">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">CRITERIOS DE BÚSQUEDA</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 d-lg-flex" style="display: flex; justify-content: flex-end">
                                            <div style="width: 20%;" class="form-floating mx-1">
                                                <input 
                                                        type="text" 
                                                        id="iptNombre"
                                                        class="form-control"
                                                        data-index="0">
                                                <label for="iptNombre">Area</label>
                                            </div>
                                            <div style="width: 20%;" class="form-floating mx-1">
                                                <input 
                                                        type="text" 
                                                        id="iptPresentacion"
                                                        class="form-control"
                                                        data-index="2">
                                                <label for="iptPresentacion">Nombre Producto</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-info">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover w-100 shadow" id="tableBloqueras">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">&Aacute;rea</th>
                                                    <th class="text-center">C&oacutedigo de producto</th>
                                                    <th class="text-center">Nombre de producto</th>
                                                    <th class="text-center">Cantidad</th>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <?php include_once "../../footer.php" ?>
    </main>

    <script src="../../../includes/js/adminlte.min.js"></script>

<script src="inventario_bloquera.js"></script>

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

    <script type="text/javascript">
        consultar();
    </script>