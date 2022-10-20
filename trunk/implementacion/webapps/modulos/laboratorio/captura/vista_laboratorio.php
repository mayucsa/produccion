<?php
		include_once "../../superior.php";
		include_once"modelo_laboratorio.php";
?>
        <head>
            <title>Captura de Laboratorio</title>
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
          <h1><i class="fas fa-flask"></i> Captura de Laboratorio</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="vista_laboratorio.php">Captura de Laboratorio</a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card">
                <div class="card-body">
                              <form novalidate id="formlaboratorio" onsubmit="return false" autocomplete="off" method="POST">
                              <div class="row form-group form-group-sm">
                                    <div class="col-sm-2 text-center">Concentrado</div>
                                    <div class="col-sm-4 text-left">
                                        <select class="form-control form-group-sm" id="selectconcentrado" name="selectconcentrado">
                                            <option selected="selected" value="0">[Seleccione una opción..]</option>
                                            <?php   
                                                $sql        = ModeloLaboratorio::showconcentrado();
                                                foreach ($sql as $key =>$value) {
                                                    echo '<option value="'.$value["cve_concentrado"].'">'.$value["nombre_concentrado"].'</option>';
                                                }
                                             ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2 text-center">Cantidad</div>
                                    <div class="col-sm-4 text-left">
                                        <input type="text" id="inputcantidad" name="inputcantidad" class="form-control form-control-md validanumericos">
                                    </div>
                              </div>
                               <div class="row form-group form-group-sm border-top" >
                                    <div class="col-sm-12" align="center" >
                                        <?php
                                            if ($clave == 1 || $clave == 11 || $clave == 12) {
                                        ?>
                                                <input type="submit" value="Guardar" href="#" onclick="insertarCaptura()" class="btn btn-primary" style="margin-bottom: -25px !important">
                                        <?php
                                            }else{
                                        ?>
                                                <input type="submit" value="Guardar" href="#" onclick="sinacceso()" class="btn btn-primary" style="margin-bottom: -25px !important">
                                        <?php
                                            }
                                        ?>
                                        <!-- <input type="submit" value="Guardar" href="#" onclick="insertarCaptura()" class="btn btn-primary" style="margin-bottom: -25px !important"> -->
                                    </div>
                               </div>
                              </form>
                                <div align="right">
                                    <a href="excelquimicos.php" id="btnExcel" type="button" class="btn btn-success">Descargar Excel <b class="fas fa-file-excel"></b></a>
                                </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4 align="center">Inventario de Concentrado</h4> 
                                            <div class="table-responsive-sm">
                                                <table class="table table-sm table-striped table-bordered table-hover" id="tableconcentrado" ></table>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4 align="center">Inventario de Quimicos</h4> 
                                            <div class="table-responsive-sm">
                                                <table class="table table-sm table-striped table-bordered table-hover" id="tableconcentradokg" ></table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <h4 align="center">Listado de Captura</h4> 
                                        <div class="table-responsive-sm">
                                             <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablacaptura">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Concentrado</th>
                                                            <th class="text-center">Cantidad</th>   
                                                            <th class="text-center">Fecha de captura</th>   
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
      <?php include_once "../../footer.php" ?>
    </main>

        <script src="vista_laboratorio.js"></script>

	    <script src="../../../includes/js/jquery351.min.js"></script>



<?php include_once "../../inferior.php" ?>

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>

<script type="text/javascript">
    mostrar();
</script>

<script type="text/javascript">
    mostrarkg();
</script>

<script type="text/javascript">
    consultarQuimico();
</script>

<script type="text/javascript">
    consultarTrapaso();
</script>

<script type="text/javascript">
    consultarDevolucion();
</script>

<!-- <script type="text/javascript">
    consultar();
</script> -->

<script type="text/javascript">
    consultarproduccion();
</script>
    
    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>

