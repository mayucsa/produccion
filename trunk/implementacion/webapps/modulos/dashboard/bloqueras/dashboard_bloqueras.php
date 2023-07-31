<?php   include_once "../../superior.php";
        include_once "../../../dbconexion/conexion.php";
?>
        <head>
            <title>Dashboard Bloqueras</title>

            <link rel="stylesheet" type="text/css" href="../../../includes/css/adminlte.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="../../../includes/css/data_tables_css/buttons.dataTables.min.css">
            <link rel="stylesheet" type="text/css" href="../../../includes/datapicker/jquery-ui.css">
            <link rel="stylesheet" type="text/css" href="../../../includes/datapicker/jquery-ui.min.css">


            <style type="text/css">
                body{
                    background-color: #f7f6f6;
                }
                table thead{
                    background-color: #1A4672;
                    color:  white;
                }
                .dflex{
                        /*display: flex;*/  
                        justify-content: space-around;
                        /*align-items: center;*/
                        /*align-content: right;*/
                        text-align: right;
                        /*margin-center: auto;*/
                        /*float: right;*/
                    }
/*                .dflex{
                        justify-content: space-around;
                        align-items: center;
                        float: right;
                    }*/
/*                .ui-datepicker-calendar{
                    display: none;
                }*/
                .dflex input{
                    border: 1px solid #CCC;
                    padding: 4px;
                    border-radius: 6px;
                    margin-right: 5px;
                }
            </style>

        </head>
<div ng-controller="dashboardBloqueras">
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fas fa-chart-line"></i> Dashboard Bloqueras</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="dashboard_bloqueras.php"> Dashboard Bloqueras</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Producción bloqueras</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="tile">
                                        <div class="dflex">
                                            <input class="date-picker" name="fproducinicio" id="fproducinicio" placeholder="Fecha Inicio">
                                            <input class="date-picker" name="fproducfin" id="fproducfin" placeholder="Fecha Fin">
                                            <button type="button" class="btn btn-info btn-sm" ng-click="VCProduccion()"><i class="fas fa-search"></i></button>
                                        </div>
                                        <center>
                                            <div id="chartPieDashboard"></div>
                                        </center>
                                        <!-- <div id="produccionBloqueras" ng-model="produccionBloqueras" style="min-width: 310px; height: 400px; margin: 0 auto"></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Ventas bloqueras</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <?php include_once "../../footer.php" ?>
    </main>
</div>

    <script src="../../../includes/js/adminlte.min.js"></script>

<script src="../../../includes/js/jquery351.min.js"></script>

 <?php include_once "../../inferior.php" ?>

    <script src="dashboard_bloqueras_ajs.js"></script>

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
    <!-- HIGHCHARTS -->
    <script src="../../../includes/librerias/highcharts/highcharts.js"></script>
    <script src="../../../includes/librerias/highcharts/highcharts-3d.js"></script>
    <script src="../../../includes/librerias/highcharts/exporting.js"></script>
    <script src="../../../includes/librerias/highcharts/export-data.js"></script>
    <script src="../../../includes/librerias/highcharts/accessibility.js"></script>

    <script type="text/javascript" src="../../../includes/datapicker/jquery-ui.min.js"></script>

    <!-- DATAPICKER -->
    <script>
        $('.date-picker').datepicker({
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        // changeDay: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy-mm-dd',
        showDays: false,
    });
    </script>

<!-- GRAFICA DE PASTEL PRODUCCIÓN TOTAL DE BLOQUERAS ENERO-DICIEMBRE 2022 -->
<!-- <script>
        Highcharts.chart('produccionBloqueras', {
            lang: {
                    viewFullscreen:"Ver en pantalla completa",
                    printChart:"Imprimir Gráfica",

                    downloadPNG:"Descarga en formato PNG",
                    downloadJPEG:"Descarga en formato JPEG",
                    downloadPDF:"Descarga en formato PDF",
                    downloadSVG:"Descarga en formato SVG",

                    downloadCSV:"Descarga en formato CSV",
                    downloadXLS:"Descarga en formato XLS",
                    viewData:"Ver tabla",
                    hideData:"Ocultal tabla"
                },
            chart: {
                // plotBackgroundColor: null,
                // plotBorderWidth: null,
                // plotShadow: false,
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                }
            },
            title: {
                text: 'Venta Bloqueras 2022'
            },
            tooltip: {
                pointFormat: '{series.name}= <b>{point.y:,.0f}</b>',
                valueSuffix: ' Pzas'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    // colors: pieColors,
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>= {point.y:,.0f} Pzas'
                    }
                }
            },
            series: [{
                name: 'Cantidad total',
                colorByPoint: true,
                data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
            }],
            // colors: ['#00CD01', '#ACE600', '#FFFF00', '#FFF263', '#FFCC00', '#FF9900', '#FF6600', '#FF0000'],
            // colors: ['#1A4673', '#ACE600', '#FFFF00', '#FFF263', '#FFCC00', '#FF9900', '#FF6600', '#FF0000'],
            // exporting: true,
            credits: {
              enabled: false
            },
            // legend: {
            //   enabled: false
            // }
        });
</script> -->