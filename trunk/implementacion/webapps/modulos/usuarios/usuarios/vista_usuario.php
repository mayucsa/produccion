<?php   
    include_once "../../superior.php";
    // include_once "../../../dbconexion/conexion.php";
    include_once "modelo_usuario.php";

?>        
        <head>
            <title>Roles de Usuario</title>

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
          <h1><i class="fa fa-user-tag"></i> Usuario</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="vista_usuario.php"> Usuario</a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card">
        <form novalidate id="tablaCapturausuario" onsubmit="return false" autocomplete="off" method="POST">
                <div class="card-header">
                    <div align="right" class="form-group form-group-sm" style="margin-bottom: 0px !important">
                      <input type="submit" value="Guardar" href="#" onclick="insertUsuario()" class="btn btn-primary">
                      <input type="submit" value="Limpiar" href="#" onclick="limpiarCampos()" class="btn btn-warning">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row form-group form-group-sm">
                        <div class="col-sm-1 text-left" >Usuario</div>
                        <div class="col-sm-3 text-left">
                            <input type="text" id="inputusuario" name="inputusuario" class="form-control form-control-md">
                        </div>

                        <div class="col-sm-1 text-left" >Contraseña</div>
                        <div class="col-sm-3 text-left">
                            <input type="password" id="inputpassword" name="inputpassword" class="form-control form-control-md">
                        </div>

                        <div class="col-sm-1 text-left" >Rol</div>
                        <div class="col-sm-3 text-left">
                            <select class="form-control form-group-sm" id="selectrol" name="selectrol">
                                <option selected="selected" value="0">[Seleccione una opción..]</option>
                                    <?php   
                                        $sql        = ModeloUsuario::showRol();
    
                                        foreach ($sql as $key =>$value) {
                                            echo '<option value="'.$value["cve_rol"].'">'.$value["nombre_rol"].'</option>';
                                                }
    
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group form-group-sm">
                        <div class="col-sm-1 text-left" >Nombre</div>
                        <div class="col-sm-3 text-left">
                            <input type="text" id="inputnombre" name="inputnombre" class="form-control form-control-md">
                        </div>

                        <div class="col-sm-1 text-left" >Apellido Paterno</div>
                        <div class="col-sm-3 text-left">
                            <input type="text" id="inputapellido" name="inputapellido" class="form-control form-control-md">
                        </div>

                        <div class="col-sm-1 text-left" >Puesto</div>
                        <div class="col-sm-3 text-left">
                            <input type="text" id="inputpuesto" name="inputpuesto" class="form-control form-control-md">
                        </div>
                    </div>
                </div>
        </form>
                <div class="card-footer">
                  <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablausuario">
                          <thead>
                              <tr>
                                    <th class="text-center">Usuario</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Puesto</th>
                                    <th class="text-center">Rol</th>
                                    <th class="text-center">Estatus</th>
                                    <th class="text-center">Fecha de Registro</th>
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


    <script src="vista_usuario.js"></script>

<!-- <?php /*include_once "modalrol.php"*/ ?> -->
<?php include_once "../../inferior.php" ?>

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>

<script type="text/javascript">
    consultarUsuario();
</script>

    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>
    
    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>