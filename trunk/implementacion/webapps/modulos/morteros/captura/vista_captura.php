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
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active border" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><strong>Producción</strong> </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link border" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><strong>Producción Especial</strong></a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link border" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><strong>Reproceso</strong></a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                            <!-- PANEL DE CAPTURA DE PRODUCCIÓN -->
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form novalidate id="tablaCaptura" onsubmit="return false" autocomplete="off" method="POST">
                                <div class="row form-group form-group-sm">
                                    <div class="col-lg-12 d-lg-flex">
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <select class="form-control form-group-md" id="selectproducto" name="selectproducto" onchange="selectProducto()">
                                                <option selected="selected" value="0">[Seleccione una opción..]</option>
                                                <?php   
                                                    $sql        = ModeloProducto::showProducto();
            
                                                        foreach ($sql as $value) {
                                                        echo '<option value="'.$value["cve_producto"].'">'.$value["nombre_producto"].'</option>';
                                                        }
                                                    ?>
                                            </select>
                                            <label>Producto</label>
                                        </div>
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <select class="form-control form-group-md" id="selectpresentacion" name="selectpresentacion" onchange="multiplicar();" disabled>
                                                <option selected="selected" value="0">[Seleccione una opción..]</option>
                                            </select>
                                            <label>Presentación</label>
                                        </div>
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <span id="spantonelada" name="spantonelada" class="form-control" style="background-color: #E9ECEF;" onchange="multiplicar();"></span>
                                            <label>Tonelada</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group form-group-sm">
                                    <div class="col-lg-12 d-lg-flex">
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <input type="text" id="inputbarcadas" name="inputbarcadas" class="form-control form-control-md validanumericos" onchange="multiplicar();">
                                            <label>Cantidad de Barcadas</label>
                                        </div>
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <input type="text" id="inputkgreal" name="inputkgreal" class="form-control form-control-md validanumericos" onchange="multiplicar();">
                                            <label>KG Real</label>
                                        </div>
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <input type="text" id="inputSacoRotos" name="inputSacoRotos" class="form-control form-control-md validanumericos" onchange="multiplicar();">
                                            <label>Sacos Rotos</label>
                                        </div>
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <!-- <input type="text" id="inputtarimas" name="inputtarimas" class="form-control form-control-md validanumericos" onchange="validacionTarimas();"> -->
                                            <input type="text" id="inputtarimas" name="inputtarimas" class="form-control form-control-md validanumericos">
                                            <label>Tarimas utilizadas</label>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row form-group form-group-sm">
                                    <div class="col-lg-12 d-lg-flex">
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <span id="spTotal" name="spTotal" class="form-control" style="background-color: #E9ECEF;"></span>
                                            <label>KG por Formula</label>
                                        </div>
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <span id="spDiferencia" name="spDiferencia" class="form-control" style="background-color: #E9ECEF;"></span>
                                            <label>Diferencia</label>
                                        </div>
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <span id="spSacosUsados" name="spSacosUsados" class="form-control" style="background-color: #E9ECEF;"></span>
                                            <label>Sacos Usados</label>
                                        </div>
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <span id="spSacoTotal" name="spSacoTotal" class="form-control" style="background-color: #E9ECEF;"></span>
                                            <label>Sacos Totales</label>
                                        </div>
                                        <span hidden  id="spanuser" name="spanuser" class="form-control form-control-sm" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
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
                                        <!-- <input type="submit" value="Guardar" href="#" onclick="insertCaptura()" class="btn btn-primary" style="margin-bottom: -25px !important"> -->
                                        <input type="submit" value="Limpiar" href="#" onclick="limpiarCampos()" class="btn btn-warning" style="margin-bottom: -25px !important">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"> -->
                                
                        <!-- </div> -->

                        <!-- PANEL DE CAPTURA DE REPROCESO -->
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <form novalidate id="tablaReproceso" onsubmit="return false" autocomplete="off" method="POST">
                                <div class="row form-group form-group-sm">
                                    <div class="col-lg-12 d-lg-flex">
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <select class="form-control form-group-sm" id="selectproduct" name="selectproduct" onchange="selectProduct()">
                                                <option selected="selected" value="0">[Seleccione una opción..]</option>
                                                    <?php
                                                            $sql        = ModeloProducto::showProducto();

                                                        foreach ($sql as $key =>$value) {
                                                        echo '<option value="'.$value["cve_producto"].'">'.$value["nombre_producto"].'</option>';
                                                        }
                                                    ?>
                                            </select>
                                            <label for="iptCategoria">Producto</label>
                                        </div>
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <select class="form-control form-group-sm" id="selectpresent" name="selectpresent" disabled>
                                                <option selected="selected" value="0">[Seleccione una opción..]</option>
                                            </select>
                                            <label for="iptCategoria">Presentación</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group form-group-sm">
                                    <div class="col-lg-12 d-lg-flex">
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <input type="text" id="inputingrer" name="inputingrer" class="form-control form-control-md validanumericos">
                                            <label for="iptCategoria">KG ingresado</label>
                                        </div>
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <input type="text" id="inputkgrealr" name="inputkgrealr" class="form-control form-control-md validanumericos" onchange="multiplicarrp();">
                                            <label for="iptCategoria">KG producido</label>
                                        </div>
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <input type="text" id="inputSacoRotosr" name="inputSacoRotosr" class="form-control form-control-md validanumericos" onchange="multiplicarrp();">
                                            <label for="iptCategoria">Rotura</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group form-group-sm">
                                    <div class="col-lg-12 d-lg-flex">
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <span id="spDiferenciar" name="spDiferenciar" class="form-control" style="background-color: #E9ECEF;"></span>
                                            <label for="iptCategoria">Diferencia</label>
                                        </div>
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <span id="spSacosUsadosr" name="spSacosUsadosr" class="form-control" style="background-color: #E9ECEF;"></span>
                                            <label for="iptCategoria">Sacos Usados</label>
                                        </div>
                                        <div style="width: 25%;" class="form-floating mx-1">
                                            <span id="spSacoTotalr" name="spSacoTotalr" class="form-control" style="background-color: #E9ECEF;"></span>
                                            <label for="iptCategoria">Sacos Totales</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group form-group-sm border-top">
                                    <div class="col-sm-12" align="center">
                                    <?php
                                        if ($captura_mortero == 1) {
                                    ?>
                                            <input type="submit" value="Guardar" href="#" onclick="insertReproceso()" class="btn btn-primary" style="margin-bottom: -25px !important">
                                    <?php
                                        }else{
                                    ?>
                                            <input type="submit" value="Guardar" href="#" onclick="sinacceso()" class="btn btn-primary" style="margin-bottom: -25px !important">
                                    <?php
                                        }
                                    ?>
                                        <!-- <input type="submit" value="Guardar" href="#" onclick="insertReproceso()" class="btn btn-primary" style="margin-bottom: -25px !important"> -->
                                        <input type="submit" value="Limpiar" href="#" onclick="limpiarCamposReproceso()" class="btn btn-warning" style="margin-bottom: -25px !important">
                                    </div>
                                </div>
                            </form>
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
<!--                             <div style="display: inline-flex;">
                                <input type="submit" value="Limpiar" href="#" onclick="limpiarCriterios()" class="btn btn-warning">
                            </div> -->
                        </div>
                    </div>
                </div> <!-- ./ end card-body -->
            </div> <!-- ./ end card-info -->

            <div class="card card-info">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover w-100 shadow" id="tablaCapturap">
                            <thead>
                                <tr>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Presentación</th>
                                    <th class="text-center">Cantidad de Barcadas</th>
                                    <th class="text-center">KG ingresado</th>
                                    <th class="text-center">Sacos utilizados</th>
                                    <th class="text-center">Fecha de captura</th>
                                    <th class="text-center">Eliminar</th>
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
                    </div>
                </div> <!-- ./ end card-body -->
            </div> <!-- ./ end card-info -->

          </div>
        </div>
    </div> <!--FIN DE DIV ROW--->
      <?php include_once "../../footer.php" ?>
    </main>



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

    <script src="vista_captura.js"></script>

<?php 
    include_once "../../inferior.php"; 
    include_once "modal_deleteproduccion.php"; 
?>

    <script src="vista_captura.js"></script>

    <script src="../../../includes/js/jquery331.min.js"></script>

    <script src="../../../includes/js/sweetalert2.min.js"></script>
    
    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>

    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../includes/css/datatables.min.css"/>

    <script type="text/javascript" src="../../../includes/js/datatables.min.js"></script>
    
<!--     <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script> -->


    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="../../../includes/js/data_tables_js/jquery.dataTables.min.js"></script>
    <script src="../../../includes/js/data_tables_js/dataTables.buttons.min.js"></script>
    <script src="../../../includes/js/data_tables_js/jszip.min.js"></script>
    <script src="../../../includes/js/data_tables_js/pdfmake.min.js"></script>
    <script src="../../../includes/js/data_tables_js/vfs_fonts.js"></script>
    <script src="../../../includes/js/data_tables_js/buttons.html5.min.js"></script>
    <script src="../../../includes/js/data_tables_js/buttons.print.min.js"></script>

    <script type="text/javascript">
    <?php
    if ($delete_mortero == 1) {
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