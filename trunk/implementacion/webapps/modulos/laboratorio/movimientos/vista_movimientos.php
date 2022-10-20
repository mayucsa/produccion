<?php   
    include_once "../../superior.php";
    // include_once "../../../dbconexion/conexion.php";
    include_once "modelo_movimiento.php";

?>        
        <head>
            <title>Movimientos</title>

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
<div class="modal fade" id="myLoadingGral" tabindex="-3" data-backdrop="static" data-keyboard="false" style="padding-top:20%; overflow-y:visible;" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div align="center"><img src="../../../includes/imagenes/loading_gral.gif" width="140px"></div>
    <div id="divtextloading" align="center" style="font-weight:bold; font-size:20px; color:#FFFFFF">Espere un momento...</div>
</div>
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
          <h1><i class="fas fa-exchange-alt"></i> Movimientos</h1>
          <!-- <p>Start a beautiful journey here</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="vista_entradas.php">Movimientos</a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card">
                <div class="card-header">
                    <div align="right" class="form-group form-group-sm" style="margin-bottom: 0px !important">
                        <?php
                            if ($clave == 1  || $clave == 11 || $clave == 12) {
                        ?>
                            <button id="btntraspaso" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTraspaso" data-whatever="@getbootstrap"><span class="fa fa-plus-circle"></span> Traspaso</button>
                            <button id="btndevolucion" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDevolucion" data-whatever="@getbootstrap"><span class="fa fa-minus-circle"></span> Devolución</button>
                        <?php
                            }else{
                        ?>
                            <button id="btntraspaso" type="button" class="btn btn-primary" onclick="sinacceso()"><span class="fa fa-plus-circle"></span> Traspaso</button>
                            <button id="btndevolucion" type="button" class="btn btn-danger" onclick="sinacceso()"><span class="fa fa-minus-circle"></span> Devolución</button>
                        <?php
                            }
                        ?>
<!--                         <button id="btntraspaso" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTraspaso" data-whatever="@getbootstrap"><span class="fa fa-plus-circle"></span> Traspaso</button>
                        <button id="btndevolucion" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDevolucion" data-whatever="@getbootstrap"><span class="fa fa-minus-circle"></span> Devolución</button> -->
                    </div>
                </div>
                <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4 align="center">Traspasos</h4> 
                                        <div class="table-responsive-sm">
                                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablatraspaso">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Concentrado</th>
                                                        <th class="text-center">Cantidad</th>   
                                                        <th class="text-center">Fecha de Traspaso</th>   
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
                                <div class="col-sm-6">
                                    <h4 align="center">Devoluciones</h4> 
                                        <div class="table-responsive-sm">
                                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tabladevolucion">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Concentrado</th>
                                                        <th class="text-center">Cantidad</th>   
                                                        <th class="text-center">Fecha de Devolución</th>   
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
      <?php include_once "../../footer.php" ?>
    </main>


    <script src="vista_movimientos.js"></script>


<?php include_once "modalTraspaso.php" ?>
<?php include_once "modalDevolucion.php" ?>

<?php include_once "../../inferior.php" ?>


    <script src="vista_movimientos.js"></script>

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>

<script type="text/javascript">
    consultarTrapaso();
</script>

<script type="text/javascript">
    consultarDevolucion();
</script>

    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>
    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>
    
   