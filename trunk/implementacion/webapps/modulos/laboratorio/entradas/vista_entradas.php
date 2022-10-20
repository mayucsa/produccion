<?php   
    include_once "../../superior.php";
    include_once "../../../dbconexion/conexion.php";
    // include_once "modelo_entradas.php";

?>        
        <head>
            <title>Entradas</title>

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
          <h1><i class="fa fa-box-open"></i> Entradas</h1>
          <!-- <p>Start a beautiful journey here</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="vista_entradas.php">Entradas</a></li>
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
                                <button id="btnEntradaq" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalquimicos" data-whatever="@getbootstrap"><span class="fa fa-plus-circle"></span> Quimicos</button>
                        <?php
                            }else{
                        ?>
                                <button id="btnEntradaq" type="button" class="btn btn-primary" onclick="sinacceso()"><span class="fa fa-plus-circle"></span> Quimicos</button>
                        <?php
                            }
                        ?>
                        <!-- <button id="btnEntradaq" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalquimicos" data-whatever="@getbootstrap"><span class="fa fa-plus-circle"></span> Quimicos</button> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tableQuimico">
                            <thead>
                                <tr>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Cantidad</th>
                                    <!-- <th class="text-center">Categoria</th> -->
                                    <th class="text-center">Fecha de registro</th>
                                    <th class="text-center">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <!-- <td></td> -->
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
      <?php include_once "../../footer.php" ?>
    </main>


    <script src="vista_entradas.js"></script>
<?php include_once "modalInsertarQ.php" ?>

<?php include_once "modalUpdate.php" ?>

<?php include_once "../../inferior.php" ?>

    <script src="vista_entradas.js"></script>

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>

<script type="text/javascript">
    <?php
    include_once "../../../modulos/seguridad/login/datos_usuario.php";
        $objeto = unserialize($_SESSION['usuario']);
        $nombre = $objeto->nombre_persona;
        $apellido = $objeto->apellido_persona;
        $puesto = $objeto->puesto_persona;
        $clave  = $objeto->rol_persona;

    if ($clave == 1) {
        ?>
        consultar();
    <?php
    }else{
        ?>
        consult();
        <?php
    }
     ?>
</script>

    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>
    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>