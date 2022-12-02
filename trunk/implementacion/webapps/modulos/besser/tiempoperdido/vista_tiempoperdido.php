<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        include_once"modelo_tiempoperdido.php";
        // include_once"enviar_mail.php";
?>
        <head>
            <title>Captura de Producci&oacute;n</title>
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<!--     <link rel="stylesheet" type="text/css" href="../../../includes/datapicker/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../../../includes/datapicker/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="../../../includes/timepicker/timepicker.css">
    <script type="text/javascript" src="../../../includes/timepicker/timepicker.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.38.0/js/tempusdominus-bootstrap-4.min.js" crossorigin="anonymous"></script> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.38.0/css/tempusdominus-bootstrap-4.min.css" crossorigin="anonymous" /> -->

            <style type="text/css">
                body{
                    background-color: #f7f6f6;
                }
                table thead{
                    background-color: #1A4672;
                    color:  white;
                }
/*.input-group-addon:last-child {
    border-left: 0;
}
.input-group-addon {
    padding: 6px 12px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.input-group-addon, .input-group-btn {
    width: 1%;
    white-space: nowrap;
    vertical-align: middle;
}
.input-group-addon, .input-group-btn, .input-group .form-control {
    display: table-cell;
}
.input-group {
    position: relative;
    display: table;
    border-collapse: separate;
}
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.glyphicon {
    position: relative;
    top: 1px;
    display: inline-block;
    font-family: 'Glyphicons Halflings';
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}*/
            </style>
            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
            <link rel="stylesheet" type="text/css" href="../../../includes/timepicker/bootstrap-clockpicker.min.css">
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
          <h1><i class="fas fa-clock"></i> Tiempo p&eacute;rdido Besser</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="vista_tiempoperdido.php"> Tiempo p&eacute;rdido</a></li>
        </ul>
      </div>

    <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card card-info">
                <div class="card-header">
                     <h3 class="card-title">CAPTURA DE DATOS</h3>
                     <div class="card-tools">
                         <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                         </button>
                     </div>
                </div>
                <div class="card-body">
                    <div class="row form-group form-group-sm">
                        <div class="col-lg-12 d-lg-flex">
                            <div style="width: 50%;" class="form-floating mx-1">
                                <select class="form-control form-group-md" id="selectmaquina" name="selectmaquina">
                                    <option selected="selected" value="0">[Seleccione una opción..]</option>
                                    <?php   
                                        $sql        = ModeloTiempoPerdido::showMaquina();

                                            foreach ($sql as $value) {
                                            echo '<option value="'.$value["cve_maq"].'">'.$value["cve_alterna"]." - ".$value["nombre_maq"].'</option>';
                                            }
                                        ?>
                                </select>
                                <label>Máquina</label>
                            </div>
                            <div style="width: 50%;" class="form-floating mx-1">
                                <select class="form-control form-group-md" id="selectfallo" name="selectfallo">
                                    <option selected="selected" value="0">[Seleccione una opción..]</option>
                                    <?php   
                                        $sql        = ModeloTiempoPerdido::showFallo();

                                            foreach ($sql as $value) {
                                            echo '<option value="'.$value["cve_fallo"].'">'.$value["cve_alterna"]." - ".$value["nombre_fallo"]." - ".$value["motivo_fallo"].'</option>';
                                            }
                                        ?>
                                </select>
                                <label>Fallo</label>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group form-group-sm">
                        <div class="col-lg-12 d-lg-flex">
                           <div style="width: 50%;" class="form-floating mx-1">
                                <input type="text" id="inputmotivo" name="inputmotivo" class="form-control form-control-md UpperCase">
                                <label>Motivo de fallo</label>
                            </div>
                            <div style="width: 25%;" class="form-floating mx-1"> 
                                <div class="input-group clockpicker" id="datetimepicker3" data-autoclose="true">
                                    <input type="text" class="form-control datetimepicker-input validanumericos" placeholder="Hora de inicio" id="inputhorainicio" name="inputhorainicio" onkeydown="noPuntoComa( event )">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div style="width: 25%;" class="form-floating mx-1">
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control datetimepicker-input validanumericos" placeholder="Hora Fin" id="inputhorafin" name="inputhorafin" onkeydown="noPuntoComa( event )">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-sm-2 text-left">
                            <span hidden  id="spanuser" name="spanuser" class="form-control form-control-sm" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
                        </div>
                        </div>
                    </div>

                    <div class="row form-group form-group-sm border-top">
                        <div class="col-sm-12" align="center">

                            <?php
                                 if ($captura_besser == 1) {
                            ?>
                                    <input type="submit" value="Guardar" href="#" onclick="validacion()" class="btn btn-primary" style="margin-bottom: -25px !important">
                            <?php
                                }else{
                             ?>
                                    <input type="submit" value="Guardar" href="#" onclick="sinacceso()" class="btn btn-primary" style="margin-bottom: -25px !important">
                            <?php
                                }
                            ?>

                            <!-- <input type="submit" value="Guardar" href="#" onclick="validacion()" class="btn btn-primary" style="margin-bottom: -25px !important"> -->
                            <input type="submit" value="Limpiar" href="#" onclick="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">REGISTRO DE CAPTURA</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover w-100 shadow" id="tablaTPBesser">
                                <thead>
                                    <tr>
                                        <th class="text-center">Máquina</th>
                                        <th class="text-center">Fallo</th>
                                        <th class="text-center">Hora inicio</th>
                                        <th class="text-center">Hora fin</th>
                                        <!-- <th class="text-center">Diferencia</th> -->
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Turno</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <!-- <td></td> -->
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
<!--                         <div class="col-lg-12 d-lg-flex" style="display: flex; justify-content: flex-end">
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
                            <div style="width: 20%;" class="form-floating mx-1">
                                <input 
                                        type="text" 
                                        id="iptFecha"
                                        class="form-control"
                                        data-index="5">
                                <label for="iptFecha">Fecha</label>
                            </div>
                        </div> -->
                    </div>
                </div> <!-- ./ end card-body -->
            </div> <!-- ./ end card-info -->

          </div>
        </div>
    </div> <!--FIN DE DIV ROW--->
      <?php include_once "../../footer.php" ?>
    </main>

    <script src="../../../includes/js/adminlte.min.js"></script>

    <script src="../../../includes/js/jquery351.min.js"></script>

    <script src="vista_tiempoperdido.js"></script>

<?php 
include_once "../../inferior.php";
include_once "modales.php";
?>

    <!-- <script src="vista_besser.js"></script> -->

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

    <script type="text/javascript" src="../../../includes/timepicker/bootstrap-clockpicker.min.js"></script>


<script type="text/javascript">
    $('.clockpicker').clockpicker()
        .find('input').change(function(){
            console.log(this.value);
        });
    var input = $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });

    $('.clockpicker-with-callbacks').clockpicker({
            donetext: 'Done',
            init: function() { 
                console.log("colorpicker initiated");
            },
            beforeShow: function() {
                console.log("before show");
            },
            afterShow: function() {
                console.log("after show");
            },
            beforeHide: function() {
                console.log("before hide");
            },
            afterHide: function() {
                console.log("after hide");
            },
            beforeHourSelect: function() {
                console.log("before hour selected");
            },
            afterHourSelect: function() {
                console.log("after hour selected");
            },
            beforeDone: function() {
                console.log("before done");
            },
            afterDone: function() {
                console.log("after done");
            }
        })
        .find('input').change(function(){
            console.log(this.value);
        });

    // Manually toggle to the minutes view
    $('#check-minutes').click(function(e){
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show')
                .clockpicker('toggleView', 'minutes');
    });
    if (/mobile/i.test(navigator.userAgent)) {
        $('input').prop('readOnly', true);
    }
</script>

    <!-- <script type="text/javascript" src="../../../includes/datapicker/jquery-ui.min.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script> -->



<script type="text/javascript">
    <?php
    if ($edit_besser == 1) {
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

<!-- NO PUNTOS EN INPUT -->
<script>
    function noPuntoComa( event ) {
      
        var e = event || window.event;
        var key = e.keyCode || e.which;

        if ( key === 110 || key === 190 || key === 188 ) {     
            
           e.preventDefault();     
        }
    }
</script>

