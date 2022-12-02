<?php   
    include_once "modulos/superior.php";
    include_once "dbconexion/conexion.php";
    // include_once "modelo_entradas.php";

?>        
        <head>
            <title>Dashboard</title>

            <style type="text/css">
                body{
                    background-color: #f7f6f6;
                }
                table thead{
                    background-color: #1A4672;
                    color:  white;
                }

            </style>
        <!-- MDB -->
<link href="includes/css/mdb.min.css" rel="stylesheet"/>
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
          <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
          <!-- <p>Start a beautiful journey here</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="vista_entradas.php">Dashboard</a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 text-center mt-5 mb-5">
                        <img class="rounded mx-auto d-block" src="../../../includes/imagenes/builder-blurbs-builder.jpg">
                    </div>
                    <div class="col-md-12 text-center mt-5 mb-5">
                        <h1> Estamos trabajando en esta Plataforma Web</h1>
                    </div>
                    <div class="col-md-12 text-center mt-5 mb-5">
                        <p>Disculpe las molestias, el área de Tecnologías de la Información esta trabajando sobre este módulo <strong>Dashboard</strong> para brindarle un mejor servicio. Si lo necesita siempre puede contactarnos de los contrario en los siguientes días podra visualizar el modulo <strong>Dashboard</strong></p>
                        <p>&mdash; Mayucsa / Mayamat &mdash;</p>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once "modulos/footer.php" ?>
    </main>


    <!-- <script src="vista_entradas.js"></script> -->

<?php include_once "modulos/inferior.php" ?>

    <!-- <script src="vista_entradas.js"></script> -->

    <script src="includes/js/jquery331.min.js"></script>

    <script src="includes/js/sweetalert2.min.js"></script>

    <script src="includes/bootstrap/js/bootstrap.js"></script>
    <script src="includes/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="includes/css/datatables.min.css"/>

    <script type="text/javascript" src="includes/js/datatables.min.js"></script>

    <!-- MDB -->
    <!-- <script type="text/javascript" src="../../../includes/js/mdb.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- 
<script type="text/javascript">

  const labels = [
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'My First dataset',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [0, 10, 5, 2, 20, 30, 45],
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {}
  };

</script>
<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script> -->