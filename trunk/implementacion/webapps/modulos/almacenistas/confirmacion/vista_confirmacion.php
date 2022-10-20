<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        include_once"modelo_confirmacion.php";
        // include_once"enviar_mail.php";
?>
        <head>
            <title>Confirmaci&oacute;n desalojo</title>
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
          <h1><i class="fas fa-check-square"></i> Confirmaci&oacute;n desalojo</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="vista_captura.php"> Confirmaci&oacute;n desalojo</a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card">
                <div class="card-body">
                    <h3>Autorizaciones</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaConfirmacion">
                            <thead>
                                <tr>
                                    <th class="text-center">Área</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Presentación</th>
                                    <th class="text-center">Celdas</th>
                                    <th class="text-center">Cantidad total</th>
                                    <th class="text-center">Cantidad despuntados</th>
                                    <th class="text-center">Cantidad rotura</th>
                                    <th class="text-center">Confirmación</th>
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
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
<!--                 <div class="card-header">
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
                    </div> -->
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once "../../footer.php" ?>
    </main>



    

<script src="vista_confirmacion.js"></script>

<script src="../../../includes/js/jquery351.min.js"></script>

<!-- <script src="vista_vibro.js"></script> -->

<?php include_once "modal_confirmacion.php" ?>

<?php include_once "../../inferior.php" ?>

    <!-- <script src="vista_vibro.js"></script> -->

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>
    
    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>

<script type="text/javascript">
    <?php
    if ($clave == 1 || $clave == 10) {
        ?>
        consultar();
        // consultarEstiba();
    <?php
    }else{
        ?>
        consult();
        // consultEstiba();
        <?php
    }
     ?>
</script>
<!--     <script type="text/javascript">
        consultarEstiba();
    </script> -->