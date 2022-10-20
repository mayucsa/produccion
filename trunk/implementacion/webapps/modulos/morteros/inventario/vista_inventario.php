<?php
    include_once "../../superior.php";
    include_once "../../../dbconexion/conexion.php";
    // include_once "ctrl_inventario.php";    
?>
         <head>
            <title>Inventario de Producto</title>

<!--             <style type="text/css">
                body{
                    background-color: #f7f6f6;
                }
                table thead{
                    background-color: #1A4672;
                    color:  white;
                }
            </style> -->
            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
        </head>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-boxes"></i> Inventario Morteros</h1>
          <!-- <p>Mayucsa / Mayamat</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="vista_inventario.php">Inventario Morteros</a></li>
        </ul>
      </div>

    <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active border" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><strong>Producto</strong> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link border" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><strong>Materia Prima</strong></a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
                                                    <label for="iptNombre">Nombre</label>
                                                </div>
                                                <div style="width: 20%;" class="form-floating mx-1">
                                                    <input 
                                                            type="text" 
                                                            id="iptPresentacion"
                                                            class="form-control"
                                                            data-index="1">
                                                    <label for="iptPresentacion">Presentación</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- ./ end card-body -->
                                </div> <!-- ./ end card-info -->

                                <div class="card card-info">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover w-100 shadow" id="tProduct">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Producto</th>
                                                        <th class="text-center">Presentación</th>
                                                        <th class="text-center">Cantidad en tonelada</th>
                                                        <th class="text-center">Cantidad en KG</th>
                                                        <th class="text-center">Cantidad en sacos</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
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
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
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
                                                            id="iptCodigo"
                                                            class="form-control"
                                                            data-index="0">
                                                    <label for="iptCodigo">Código</label>
                                                </div>
                                                <div style="width: 20%;" class="form-floating mx-1">
                                                    <input 
                                                            type="text" 
                                                            id="iptNombremp"
                                                            class="form-control"
                                                            data-index="1">
                                                    <label for="iptNombremp">Nombre</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- ./ end card-body -->
                                </div> <!-- ./ end card-info -->
                                <div class="card card-info">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover w-100 shadow" style="width: 100%;" id="tMatPrim">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Código</th>
                                                        <th class="text-center">Materia Prima</th>
                                                        <th class="text-center">Cantidad</th>   
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
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
          </div>
        </div>
    </div>


        <?php include_once "../../footer.php" ?>

    </main>
    <script src="../../../includes/js/adminlte.min.js"></script>

<?php include_once "../../inferior.php" ?>

    <script src="vista_inventario.js"></script>

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
        consultarProducto();
        consultarMP();
    </script>