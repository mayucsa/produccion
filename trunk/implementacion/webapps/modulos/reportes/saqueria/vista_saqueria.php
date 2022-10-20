<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
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
          <h1><i class="fas fa-chart-bar"></i> Reporte de Saqueria</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="vista_captura.php"> Reporte de Saqueria</a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card">
                <form novalidate id="formFechas" name="formFechas" onsubmit="return false" autocomplete="off" method="POST">
                <div class="card-header">
                    <div align="right" class="form-group form-group-sm" style="margin-bottom: 0px !important">
                        <button id="btnbuscar" type="submit" class="btn btn-warning" onclick="validacionFechas()"> Buscar <span class="fas fa-search"></span></button>
                        <button id="btnpdf" name="btnpdf" type="submit" class="btn btn-danger" onclick="validacionPDF()"><span class="far fa-file-pdf" style="color: white"></span></button>
                        <!-- <button id="btnpdf" type="submit" class="btn btn-danger" onclick="descPDF()"><span class="far fa-file-pdf" style="color: white"></span></button> -->
                        <!-- <button id="btnexcel" type="submit" class="btn btn-success" onclick="descargaExcel()"><span class="far fa-file-excel" style="color: white"></span></button> -->
                        <!-- <input type="submit" value="pdf" href="reporte_pdf.php" class="btn btn-danger"> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="row form-group form-group-sm">
                        <div class="col-sm-2 text-right">Inicio</div>
                        <div class="col-sm-4 text-left">
                            <input type="date" id="inputinicio" name="inputinicio" class="form-control form-control-sm">
                        </div>
                        <div class="col-sm-2 text-right">Fin</div>
                        <div class="col-sm-4 text-left">
                            <input type="date" id="inputfin" name="inputfin" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                </form>
                <div class="card-footer">
<!--                     <div align="right" class="form-group form-group-sm" style="margin-bottom: 0px !important">
                        <a href="reportespdf_saqueria.php"> <i class="far fa-file-pdf" style="color: red"></i></a>
                    </div> -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaSaqueria">
                            <thead>
                                <tr>
                                    <th class="text-center">Tipo de movimiento</th>
                                    <th class="text-center">Clave</th>
                                    <th class="text-center">Concepto</th>
                                    <th class="text-center">Presentacion</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Fecha de movimiento</th>
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

    <!-- <script src="../../../includes/js/jquery351.min.js"></script> -->
    <script src="vista_saqueria.js"></script>

<?php include_once "../../inferior.php" ?>

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>
    
    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>



<script type="text/javascript">
    mostrar();
</script>

<script type="text/javascript">
function updateDateInputs() { 
    $('inputinicio').each(function() {
        var $date = $(this),
            date = $date.val().split('-'),
            format = ['year', 'month', 'day'];
        $.each(format, function(i, v) {
            $date.attr('data-' + v, +date[i]);
        });
    });
}
</script>
<!-- 
<script>
    $(document).ready(function(){
        var table;

        table = $("#tablaSaqueria").DataTable({
    "lengthMenu": [[15, 30, 45], [15, 30, 45]],
     "language": {
         "lengthMenu": "Mostrar _MENU_ registros por página.",
         "zeroRecords": "No se encontró registro.",
         "info": "  _START_ de _END_ (_TOTAL_ registros totales).",
         "infoEmpty": "0 de 0 de 0 registros",
         "infoFiltered": "(Encontrado de _MAX_ registros)",
         "search": "Buscar: ",
         "processing": "Procesando...",
                  "paginate": {
             "first": "Primero",
             "previous": "Anterior",
             "next": "Siguiente",
             "last": "Último"
         }

     }
        });
    })
</script>
 -->