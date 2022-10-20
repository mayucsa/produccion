<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        // include_once"modelo_vibro.php";
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
            </style>
        </head>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-boxes"></i> Inventario Bloquera</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="inventario_bloquera.php"> Inventario Bloquera</a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card">
                <div class="card-body">
                    <h4>Producto Finalizado</h4>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active border" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><strong>Besser</strong> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><strong>VibroBlock</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><strong>Despuntados</strong></a>
                        </li>
                    </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tableBesser">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Presentación</th>
                                        <th class="text-center">Celdas</th>
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
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tableVibro">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Presentación</th>
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
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tableDespuntados">
                                <thead>
                                    <tr>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Presentación</th>
                                        <th class="text-center">Celdas</th>
                                        <th class="text-center">Cantidad</th>
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
<br>
                    <h4>Materia Prima</h4>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active border" id="pills-mpbesser-tab" data-toggle="pill" href="#pills-mpbesser" role="tab" aria-controls="pills-mpbesser" aria-selected="true"><strong>Besser</strong> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border" id="pills-mpvibro-tab" data-toggle="pill" href="#pills-mpvibro" role="tab" aria-controls="pills-mpvibro" aria-selected="false"><strong>VibroBlock</strong></a>
                        </li>
                    </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-mpbesser" role="tabpanel" aria-labelledby="pills-mpbesser-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="mpBesser">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nombre</th>
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
                    <div class="tab-pane fade" id="pills-mpvibro" role="tabpanel" aria-labelledby="pills-mpvibro-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="mpVibro">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nombre</th>
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
      <?php include_once "../../footer.php" ?>
    </main>

<script src="inventario_bloquera.js"></script>

<script src="../../../includes/js/jquery351.min.js"></script>

<!-- <script src="vista_vibro.js"></script> -->

<!-- <?php include_once "../../inferior.php" ?> -->

    <!-- <script src="vista_vibro.js"></script> -->

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>
    
    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>

    <script type="text/javascript">
        consultar();
    </script>
    <script type="text/javascript">
        consultarV();
    </script>
    <script type="text/javascript">
        consultarD();
    </script>
    <script type="text/javascript">
        consultarmpB();
    </script>
    <script type="text/javascript">
        consultarmpV();
    </script>