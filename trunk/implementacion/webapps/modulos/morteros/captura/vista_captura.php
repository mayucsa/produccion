<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        include_once"modelo_captura.php";
        // include_once"enviar_mail.php";
?>
        <head>
            <title>Captura de Producci&oacute;n</title>
            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
            <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css"> -->
        </head>
<div ng-controller="vistaProduccionMorteros">
            <!-- MODAL VER MATERIA PRIMA QUE UTILIZO -->
            <div class="row" style="position: fixed; z-index: 9; background-color: white; width: 70%; margin-left: 20%;  border-radius: 15px; padding: 5vH; border: solid;" ng-show="modaMisMp == true">
                <div class="col-lg-12 col-md-12" style="max-height: 50vH; overflow-y: auto;">
                    <h3>Cantidad de materia prima</h3>
                    <div class="row form-group form-group-sm">
                        <div class="col-lg-12 d-lg-flex">
                            <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" ng-model="tproducto" id="tproducto" name="tproducto" class="form-control form-control-md validanumericos" disabled>
                                <label>Producto</label>
                            </div>
                            <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" ng-model="tfecha" id="tfecha" name="tfecha" class="form-control form-control-md validanumericos" disabled>
                                <label>Fecha de produccion</label>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover w-100 shadow" id="tablaModalEstiba">
                            <thead>
                                <tr>
                                    <th class="text-center">Materia prima</th>
                                    <th class="text-center">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="(i, obj) in tmpproducto track by i">
                                    <td class="text-center">{{obj.nombre_materiaprima}}</td>
                                    <td class="text-center">{{obj.cantidad}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 text-right">
                    <!-- <button class="btn btn-success" ng-click="verificar()">Confirmar salida</button> -->
                    <button class="btn btn-danger" ng-click="getModalMP()">Cerrar</button>
                </div>
            </div>


    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fas fa-tasks"></i> Producci&oacute;n Morteros</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="vista_captura.php"> Producci&oacute;n Morteros</a></li>
            </ul>
        </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="card card-info" ng-show="perfilUsu.produccion_morteros_captura == 1">
                    <div class="card-header">
                        <h3 class="card-title">CAPTURA DE PRODUCCI&Oacute;N</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row form-group form-group-sm">
                            <div class="col-lg-12 d-lg-flex">
                                <div style="width: 100%;" class="form-floating mx-1">
                                    <select class="form-control form-group-md" ng-model="producto" ng-blur="habilitarinput()">
                                        <option selected="selected" value="" disabled>[Seleccione una opción..]</option>
                                        <option ng-repeat="(i, obj) in prod" value="{{obj.cve_mortero}}">{{obj.cod_producto}} - {{obj.nombre_producto}}</option>
                                    </select>
                                    <label>Producto</label>
                                </div>
                                <div style="width: 100%;" class="form-floating mx-1">
                                    <input class="date-picker form-control validanumericos" ng-model="tonelada" id="tonelada" autocomplete="off" disabled>
                                    <label>Tonelada</label>
                                </div>
                                <div style="width: 100%;" class="form-floating mx-1">
                                    <input class="date-picker form-control validanumericos" ng-model="presentacion" id="presentacion" autocomplete="off" disabled>
                                    <label>presentacion</label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group form-group-sm">
                            <div class="col-lg-12 d-lg-flex">
                                <div style="width: 100%;" class="form-floating mx-1">
                                    <!-- <input class="date-picker form-control validanumericos" ng-model="cantidad" id="cantidad" autocomplete="off" ng-disabled="true" ng-blur="toneladaporbarcada(tonelada, cantidad)"> -->
                                    <input class="date-picker form-control validanumericos" ng-model="cantidad" id="cantidad" autocomplete="off" ng-disabled="true" ng-blur="validaExistenciaMP(producto, cantidad, tonelada)">
                                    <label>Cantidad de barcadas</label>
                                </div>
                                <div style="width: 100%;" class="form-floating mx-1">
                                    <input class="date-picker form-control validanumericos" ng-model="kgreal" id="kgreal" autocomplete="off" ng-disabled="true" ng-blur="realmenosformula(kgreal, kgformula, presentacion)">
                                    <label>KG Real</label>
                                </div>
                                <div style="width: 100%;" class="form-floating mx-1">
                                    <input class="date-picker form-control validanumericos" ng-model="sacosrotos" id="sacosrotos" autocomplete="off" ng-disabled="true" ng-blur="sacosusadosmasrotos(sacosproduccion, sacosrotos)">
                                    <label>Sacos Rotos</label>
                                </div>
                                <div style="width: 100%;" class="form-floating mx-1">
                                    <input class="date-picker form-control validanumericos" ng-model="tarimas" id="tarimas" autocomplete="off" ng-disabled="true" ng-blur="existenciatarimas(tarimas)">
                                    <label>Tarimas en producción</label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group form-group-sm">
                            <div class="col-lg-12 d-lg-flex">
                                <div style="width: 100%;" class="form-floating mx-1">
                                    <input class="date-picker form-control validanumericos" ng-model="kgformula" id="kgformula" autocomplete="off" ng-disabled="true">
                                    <label>KG por fórmula</label>
                                </div>
                                <div style="width: 100%;" class="form-floating mx-1">
                                    <input class="date-picker form-control validanumericos" ng-model="diferencia" id="diferencia" autocomplete="off" ng-disabled="true">
                                    <label>Diferencia de KG</label>
                                </div>
                                <div style="width: 100%;" class="form-floating mx-1">
                                    <input class="date-picker form-control validanumericos" ng-model="sacosproduccion" id="sacosproduccion" autocomplete="off" ng-disabled="true">
                                    <label>Sacos en producción</label>
                                </div>
                                <div style="width: 100%;" class="form-floating mx-1">
                                    <input class="date-picker form-control validanumericos" ng-model="sacostotales" id="sacostotales" autocomplete="off" ng-disabled="true">
                                    <label>Sacos totales usados</label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group form-group-sm border-top">
                            <div class="col-sm-12" align="center">
                                <input type="submit" value="Guardar producción" href="#" ng-click="validacionCampos()" class="btn btn-primary" style="margin-bottom: -25px !important">
                                <input type="submit" value="Limpiar" href="#" ng-click="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important">
                                <input type="submit" value="Enviar correo" href="#" ng-click="envioCorreo()" class="btn btn-info" style="margin-bottom: -25px !important">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">PRODUCCIONES MORTEROS</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%;" id="tablaProduccion">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Producto</th>
                                        <th>Cantidad barcadas</th>
                                        <th>KG producido</th>
                                        <th>Sacos usados</th>
                                        <th>Fecha de captura</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(i, obj) in ssProduccionMorteros track by i">
                                        <td class="text-center">{{obj.cve_captura}}</td>
                                        <td>{{obj.nombre_producto}}</td>
                                        <td class="text-center">{{obj.cantidad_barcadas}}</td>
                                        <td class="text-center">{{obj.kg_real}}</td>
                                        <td class="text-center">{{obj.sacos_total}}</td>
                                        <td class="text-center">{{obj.fecha_registro}}</td>
                                        <td class="text-center">
                                            <span class= "btn btn-info btn-sm" ng-click="getModalMP(obj.cve_captura)" title="Ver datos"><i class="fas fa-eye"></i> </span>
                                            <span class= "btn btn-warning btn-sm" ng-show="perfilUsu.produccion_morteros_edit == 1" ng-click="sinacceso()" title="Editar fecha"><i class="fas fa-calendar"></i> </span>
                                            <span class= "btn btn-danger btn-sm" title="Descargar PDF"><i class="fas fa-download"></i> </span>
                                            <span class= "btn btn-danger btn-sm" ng-show="perfilUsu.produccion_morteros_edit == 1" ng-click="eliminar(obj.cve_captura, obj.cve_mortero, obj.kg_real, obj.cantidad_barcadas, obj.tarimas_enproduccion)" title="Eliminar"><i class="fas fa-window-close"></i> </span>
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
      <?php include_once "../../footer.php" ?>
    </main>
</div>


<!-- <script src="vista_captura.js"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script> -->
<script src="../../../includes/js/adminlte.min.js"></script>


<!-- FUNCIONES OPERACIONES DE CAPTURA DE PRODUCCION -->
<script type="text/javascript">
    function multiplicar(id) {
        var datos   = new FormData();

        datos.append('tonelada', $('#spantonelada').text());
        datos.append('presentacion', $('#selectpresentacion').val());
        datos.append('numbarcadas', $('#inputbarcadas').val());
        datos.append('kgreal', $('#inputkgreal').val());
        datos.append('SacoRotos', $('#inputSacoRotos').val());

        // console.log(datos.get('tonelada'));
        // // console.log(datos.get('numbarcadas'));
        // console.log(datos.get('presentacion'));
        // console.log(datos.get('kgreal'));
        // console.log(datos.get('SacoRotos'));

        var r = ($('#spantonelada').text() * $('#inputbarcadas').val() * 1000);
        // console.log(r);
        $("#spTotal").html(r);

        var t = ($('#inputkgreal').val() - $("#spTotal").text());
        // console.log(t);
        $("#spDiferencia").html(t);

        var q = ($('#inputkgreal').val() / $('#selectpresentacion').val());
        // console.log(q);
        $("#spSacosUsados").html(q);

        var sp =  $("#spSacosUsados").text();

        // var w = (parseFloat(sp));
        var w = (parseInt(sp) + parseInt($('#inputSacoRotos').val()));
        // var w = ($("#spSacosUsados").val() + $('#inputSacoRotos').val());
        // console.log(w);
        $("#spSacoTotal").html(w);

    }
</script>

<!-- FUNCIONES OPERACIONES DE CAPTURA DE REPROCESO -->
<script type="text/javascript">
    function multiplicarrp(id) {
        var datos   = new FormData();

        // datos.append('tonelada', $('#spantonelada').text());
        datos.append('present', $('#selectpresent').val());
        // datos.append('numbarcadas', $('#inputbarcadas').val());
        datos.append('kgingrer', $('#inputingrer').val());
        datos.append('kgrealr', $('#inputkgrealr').val());
        datos.append('SacoRotosr', $('#inputSacoRotosr').val());

        // console.log(datos.get('tonelada'));
        // // console.log(datos.get('numbarcadas'));
        // console.log(datos.get('presentacion'));
        // console.log(datos.get('kgreal'));
        // console.log(datos.get('SacoRotos'));

        var t = ($('#inputingrer').val() - $("#inputkgrealr").val());
        // console.log(t);
        $("#spDiferenciar").html(t);

        var q = ($('#inputkgrealr').val() / $('#selectpresent').val());
        // console.log(q);
        $("#spSacosUsadosr").html(q);

        var sp =  $("#spSacosUsadosr").text();

        // var w = (parseFloat(sp));
        var w = (parseInt(sp) + parseInt($('#inputSacoRotosr').val()));
        // var w = ($("#spSacosUsados").val() + $('#inputSacoRotos').val());
        // console.log(w);
        $("#spSacoTotalr").html(w);

    }
</script>

    <script src="../../../includes/js/jquery351.min.js"></script>

    <!-- <script src="vista_captura.js"></script> -->

<?php 
    include_once "../../inferior.php"; 
    include_once "modal_deleteproduccion.php"; 
?>
    <script src="vista_captura_ajs.js"></script>

    <script src="vista_captura.js"></script>

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


    <script type="text/javascript">
            consultar();
    </script>

    <script>
        /*===================================================================*/
        // EVENTOS PARA CRITERIOS DE BUSQUEDA (CODIGO, CATEGORIA Y PRODUCTO)
        /*===================================================================*/
        // $("#iptNombre").keyup(function(){
        //     table.column($(this).data('index')).search(this.value).draw();
        // })
        // $("#iptPresentacion").keyup(function(){
        //     table.column($(this).data('index')).search(this.value).draw();
        // })
        // $("#iptProducto").keyup(function(){
        //     table.column($(this).data('index')).search(this.value).draw();
        // })
        // $("#iptPrecioVentaDesde, #iptPrecioVentaHasta").keyup(function(){
        //     table.draw();
        // })
        // $.fn.dataTable.ext.search.push(
        //     function(settings, data, dataIndex){
        //         var precioDesde = parseFloat($("#iptPrecioVentaDesde").val());
        //         var precioHasta = parseFloat($("#iptPrecioVentaHasta").val());
        //         var col_venta = parseFloat(data[7]);
        //         if((isNaN(precioDesde) && isNaN(precioHasta)) ||
        //             (isNaN(precioDesde) && col_venta <=  precioHasta) ||
        //             (precioDesde <= col_venta && isNaN(precioHasta)) ||
        //             (precioDesde <= col_venta && col_venta <= precioHasta)){
        //                 return true;
        //         }
        //         return false;
        //     }
        // )
    </script>