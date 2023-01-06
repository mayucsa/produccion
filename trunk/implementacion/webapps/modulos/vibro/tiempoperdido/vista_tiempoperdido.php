<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        include_once"modelo_tiempoperdido.php";
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

<div ng-controller="VistaTPVibro">
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-clock"></i> Tiempo p&eacute;rdido VibroBlock</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="vista_tiempoperdido.php"> Tiempo p&eacute;rdido</a></li>
        </ul>
      </div>

    <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card card-info" ng-show="perfilUsu.tperdido_vibro_captura == 1">
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
                                    <option ng-repeat="(i, obj) in Maquinas" value="{{obj.cve_maq}}">{{obj.cve_alterna}} - {{obj.nombre_maq}}</option>
                                </select>
                                </select>
                                <label>Máquina</label>
                            </div>
                            <div style="width: 50%;" class="form-floating mx-1">
                                <select class="form-control form-group-md" id="selectfallo" name="selectfallo">
                                    <option selected="selected" value="0">[Seleccione una opción..]</option>
                                    <option ng-repeat="(i, obj) in Fallos" value="{{obj.cve_fallo}}">{{obj.cve_alterna}} - {{obj.nombre_fallo}} - {{obj.motivo_fallo}}</option>
                                </select>
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
<!--                             <div style="width: 25%;" class="form-floating mx-1"> 
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
                            </div> -->
                            <div style="width: 25%;" class="form-floating mx-1">
                                <input type="text" id="inputhorainicio" value="" name="inputhorainicio" class="form-control form-control-md" ng-keyup="checkTime('inputhorainicio');">
                                <label>Hora de inicio</label>
                            </div>
                            <div style="width: 25%;" class="form-floating mx-1">
                                <input type="text" id="inputhorafin" value="" name="inputhorafin" class="form-control form-control-md" ng-keyup="checkTime('inputhorafin');" ng-blur="getdiferencia();">
                                <label>Hora de fin</label>
                            </div>
                            <div style="widows: 25%;" class="form-floating mx-1">
                                <input type="text" id="diferencia" name="diferencia" class="form-control form-control-md" readonly>
                                <label>Diferencia</label>
                            </div>
                        <div class="col-sm-2 text-left">
                            <span hidden  id="spanuser" name="spanuser" class="form-control form-control-sm" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
                        </div>
                        </div>
                    </div>

                    <div class="row form-group form-group-sm border-top">
                        <div class="col-sm-12" align="center">
                            <input type="submit" value="Guardar" href="#" onclick="validacion()" class="btn btn-primary" style="margin-bottom: -25px !important">
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
                            <table class="table table-striped table-bordered table-hover w-100 shadow" id="">
                                <thead>
                                    <tr>
                                        <th class="text-center">Folio</th>
                                        <th class="text-center">Máquina</th>
                                        <th class="text-center">Fallo</th>
                                        <th class="text-center">Hora inicio</th>
                                        <th class="text-center">Hora fin</th>
                                        <th class="text-center">Diferencia</th>
                                        <th class="text-center">Fecha captura</th>
                                        <th class="text-center">Turno</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(i, obj) in tablaTPVibro track by i">
                                        <td>{{obj.cve_tp}}</td>
                                        <td>{{obj.nombre_maq}}</td>
                                        <td>{{obj.nombre_fallo}}</td>
                                        <td>{{obj.hora_inicio}}</td>
                                        <td>{{obj.hora_fin}}</td>
                                        <td>{{obj.Diferencia}}</td>
                                        <td>{{obj.fecha_registro}}</td>
                                        <td>
                                            <span class= "badge badge-success">
                                                {{obj.Turno}}
                                            </span>
                                        </td>
                                        <td nowrap="nowrap">
                                            <span class= "btn btn-warning" ng-click="obtenerDatosEdit(obj.cve_tp)" title="Editar" data-toggle="modal" data-target="#modalEditar" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> </span>
                                            <span class= "btn btn-danger" ng-click="obtenerDatosE(obj.cve_tp)" title="Eliminar" data-toggle="modal" data-target="#modalEliminar" data-whatever="@getbootstrap"><i class="fas fa-trash-alt"></i> </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

          </div>
        </div>
    </div> <!--FIN DE DIV ROW--->
      <?php include_once "../../footer.php"; include_once "modales.php"; ?>
    </main>
</div>

    <script src="../../../includes/js/adminlte.min.js"></script>

    <script src="../../../includes/js/jquery351.min.js"></script>

    <script src="vista_tiempoperdido.js"></script>
    <script src="vista_tiempoperdido_ajs.js"></script>

<?php 
include_once "../../inferior.php";

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

<!-- Funciones diferencias-->
<script type="text/javascript">
    function diferencia(id) {
        var datos   = new FormData();

        datos.append('inicio', $('#inputhorainicio').val());
        datos.append('fin', $('#inputhorafin').val());

        console.log(datos.get('inicio'));
        console.log(datos.get('fin'));

        var dif = ($('#inputhorafin').val() - $('#inputhorainicio').val());
        console.log(dif);
        $("#diferencia").html(dif);
    }
</script>

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
    consultar();
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

