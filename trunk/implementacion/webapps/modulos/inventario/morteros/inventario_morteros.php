<?php
    include_once "../../superior.php";
    include_once "../../../dbconexion/conexion.php";
    // include_once "ctrl_inventario.php";    
?>
         <head>
            <title>Inventario de Producto</title>

            <style type="text/css">
                body{
                    background-color: #f7f6f6;
                }
                table thead{
                    background-color: #1A4672;
                    color:  white;
                }
            </style>
        </head>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-boxes"></i> Inventario</h1>
          <!-- <p>Mayucsa / Mayamat</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="inventario_morteros.php">Inventario</a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
         <div class="card">
            <div class="card-body">
                    <ul class="nav nav-pills justify-content-end">
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle btn btn-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Descargar Excel </a>
                          <div class="dropdown-menu" style="background-color:#28A745; text-align: center;">
                            <a href="excelinventario.php" id="btnExcel">Producto <b class="far fa-file-excel"></b></a>
                                <div class="dropdown-divider"></div>
                            <a href="excelmp.php" id="btnExcel">Materia Prima <b class="far fa-file-excel"></b></a>
                                <div class="dropdown-divider"></div>
                            <a href="excelquimico.php" id="btnExcel">Quimicos <b class="far fa-file-excel"></b></a>
                          </div>
                        </li>
                    </ul>
                <br>

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active border" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><strong>Producto</strong> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><strong>Materia Prima</strong></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><strong>Quimicos</strong></a>
                  </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tProduct">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Producto</th>
                                            <th class="text-center">Presentación</th>
                                            <th class="text-center">Cantidad en tonelada</th>
                                            <th class="text-center">Cantidad en KG</th>
                                            <th class="text-center">Cantidad de Sacos</th>
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
                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tMatPrim">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Materia Prima</th>
                                            <th class="text-center">Cantidad</th>   
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                  </div>
                  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tQuimico">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Quimicos</th>
                                            <th class="text-center">Cantidad</th>   
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
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


        <?php include_once "../../footer.php" ?>

    </main>


<?php include_once "../../inferior.php" ?>

    <script src="inventario.js"></script>

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>

<script type="text/javascript">
    consultarProducto();
</script>
<script type="text/javascript">
    consultarMP();
</script>
<script type="text/javascript">
    consultarQuimico();
</script>

    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>
