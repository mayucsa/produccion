<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
        // include_once"modelo_entradas.php";
        // include_once"enviar_mail.php";
?>
        <head>
            <title>Captura de Producci&oacute;n</title>
                <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">

                <link rel="stylesheet" type="text/css" href="../../../includes/datapicker/jquery-ui.css">
                <link rel="stylesheet" type="text/css" href="../../../includes/datapicker/jquery-ui.min.css">
        </head>

<div ng-controller="vistaReportesVentas">
    <main class="app-content">
        <div class="app-title">
            <div>
              <h1><i class="fa fa-box-open"></i> Reporte ventas</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="vista_ventas.php"> Reporte ventas</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card">
                        <div class="card card-info">
                            <div class="card-header">
                                 <h3 class="card-title">REPORTE DE VENTAS</h3>
                                 <div class="card-tools">
                                     <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                     </button>
                                 </div>
                            </div>
                            <div class="card-body">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    Reportes ventas
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalBloqueras" data-whatever="@getbootstrap">Ventas Bloquera</a>
                                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalTrituradora" data-whatever="@getbootstrap">Ventas Trituradora</a>
                                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modalMorteros" data-whatever="@getbootstrap">Ventas Morteros</a>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once "../../footer.php"; ?>
    </main>
        <?php include "modales.php"; ?>
        <?php include "reporteVentas.html"; ?>
</div>

<script src="../../../includes/js/adminlte.min.js"></script>

<script src="../../../includes/js/jquery351.min.js"></script>

<script src="vista_ventas_ajs.js"></script>

<?php   include_once "../../inferior.php" ?>

    <!-- <script src="vista_vibro.js"></script> -->

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
    <script type="text/javascript" src="../../../includes/datapicker/jquery-ui.min.js"></script>

    <script>
        const tomorrow = new Date()
        tomorrow.setDate(tomorrow.getDate() + 1)
        $('.date-picker').datepicker({
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            // minDate: tomorrow,
            // changeDay: true,
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy-mm-dd',
            showDays: false,
        });
    </script>