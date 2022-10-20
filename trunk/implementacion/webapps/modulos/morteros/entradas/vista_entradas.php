<?php   
    include_once "../../superior.php";
    include_once "../../../dbconexion/conexion.php";
    include_once "modelo_entradas.php";
?>        
        <head>
            <title>Entradas</title>
                <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">

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
                <!-- <div class="card-body">
                    <div align="right" class="form-group form-group-sm" style="margin-bottom: 0px !important">
                        <?php
                            //if ($captura_mortero == 1) //{
                        ?>
                                <button id="btnEntrada" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalMatPrima" data-whatever="@getbootstrap"><span class="fas fa-plus-circle"></span> Materia Prima</button>
                        <?php
                            //}else{
                        ?>
                                <button id="btnEntrada" type="button" class="btn btn-primary" onclick="sinacceso()"><span class="fas fa-plus-circle"></span> Materia Prima</button>
                        <?php
                            //}
                        ?>
                    </div>
                </div>-->

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">CAPTURA DE ENTRADAS</h3>
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
                                    <select required id="comb_mat_prima" name="comb_mat_prima" class="js-example-basic-single form-control">
                                        <option selected="selected" value="0">[Seleccione una opción..]</option>
                                        <?php   
                                            $sql        = "SELECT * FROM seg_materia_prima";
                                            $query      = $stmt -> prepare ($sql);
                                            $query      -> execute();
                                            $resultado  = $query -> fetchAll();

                                            foreach ($resultado as $resultado) {
                                                echo '<option>'.$resultado["nombre_materia_prima"].'</option>';
                                            }
                                         ?>
                                    </select>
                                    <label for="iptCategoria">Producto</label>
                                </div>
                                <div style="width: 25%;" class="form-floating mx-1">
                                    <input required type="text" class="form-control validanumericos" id="comb_cantidad" name="comb_cantidad">
                                    <label for="iptCategoria">Cantidad</label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group form-group-sm border-top">
                            <div class="col-sm-12" align="center">
                            <?php
                                if ($captura_mortero == 1) {
                            ?>
                                    <input type="submit" value="Guardar" href="#" onclick="validacionCampos()" class="btn btn-primary" style="margin-bottom: -25px !important">
                            <?php
                                }else{
                            ?>
                                    <input type="submit" value="Guardar" href="#" onclick="sinacceso()" class="btn btn-primary" style="margin-bottom: -25px !important">
                            <?php
                                }
                            ?>
                                <!-- <input type="submit" value="Guardar" href="#" onclick="insertReproceso()" class="btn btn-primary" style="margin-bottom: -25px !important"> -->
                                <input type="submit" value="Limpiar" href="#" onclick="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important">
                            </div>
                        </div>
                    </div>
                </div>
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
                                            id="iptFecha"
                                            class="form-control"
                                            data-index="2">
                                    <label for="iptFecha">Fecha</label>
                                </div>
                            </div>
                        </div>
                    </div> <!-- ./ end card-body -->
                </div> <!-- ./ end card-info -->
                <div class="card card-info">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tableMatPrima">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Cantidad</th>
                                        <!-- <th class="text-center">Categoria</th> -->
                                        <th class="text-center">Fecha de registro</th>
                                        <th class="text-center">Opciones</th>
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
            </div><!-- ./ end card -->
          </div>
        </div>
      </div>
      <?php include_once "../../footer.php" ?>
    </main>

<script src="../../../includes/js/adminlte.min.js"></script>

<script src="../../../includes/js/jquery351.min.js"></script>

<script src="vista_entradas.js"></script>

<?php 
    include_once "modalInsertar.php" ?>
<?php 
    include_once "modalUpdate.php" ?>
<?php 
    include_once "../../inferior.php"
?>

    <script src="vista_entradas.js"></script>

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

<!-- <script type="text/javascript">
    consultar();
</script> -->

<script type="text/javascript">
    <?php
    if ($edit_mortero == 1) {
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