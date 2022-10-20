    $(document).ready(function(){
        var table;

        table = $("#tablaSaqueria").DataTable({
        //     dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],


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

function validacionFechas() {
    var fecha_inicio = $("#inputinicio").val();
    var fecha_fin = $("#inputfin").val();

    var msj = "";

    if (fecha_inicio == 0) {
        msj += "<li>Fecha inicio</li>"
    }
    if (fecha_fin == 0) {
        msj += "<li>Fecha fin</li>"
    }
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');
    }else{
        validacionFechasdos();
    }
}

function validacionFechasdos() {
    var fecha_inicio = $("#inputinicio").val();
    var fecha_fin = $("#inputfin").val();

    var msg = "";

    if (fecha_inicio > fecha_fin) {
        msg += "<li>Fecha inicio debe ser menor a la Fecha final</li>"
    }
    if (msg.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos no son correctos:<ul>'+msg+'</ul>');
        $('#modalMensajes').modal('toggle');
    }else{
        mostrar();
    }
}

function mostrar(){
    var datos = new FormData();
    // var dateValInnicio = new Date();
    // var dateValFin = new Date();

    var fecha_inicio = $("#inputinicio").val();
    var fecha_fin = $("#inputfin").val();

    fecha_inicio = fecha_inicio.replace(/-/g, "");
    fecha_fin = fecha_fin.replace(/-/g, "");
    // alert(fecha_inicio);

    datos.append('inicio',  $('#inputinicio').val());
    datos.append('fin',     $('#inputfin').val());

    console.log(datos.get('inicio'));
    console.log(datos.get('fin'));

    $.ajax({
        type:"POST",
        url:"ctrl_saqueria.php",
        data: {
            "fecha_inicio":fecha_inicio,
            "fecha_fin":fecha_fin
        },
        success:function(r){
            $('#tablaSaqueria').html(r);
        }
    });
}

// DESGARDA DE PDF
function validacionPDF() {
    var fecha_inicio = $("#inputinicio").val();
    var fecha_fin = $("#inputfin").val();

    var msj = "";

    if (fecha_inicio == 0) {
        msj += "<li>Fecha inicio</li>"
    }
    if (fecha_fin == 0) {
        msj += "<li>Fecha fin</li>"
    }
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');
    }else{
        validacionPDFdos();
    }
}

function validacionPDFdos() {
    var fecha_inicio = $("#inputinicio").val();
    var fecha_fin = $("#inputfin").val();

    var msg = "";

    if (fecha_inicio > fecha_fin) {
        msg += "<li>Fecha inicio debe ser menor a la Fecha final</li>"
    }
    if (msg.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos no son correctos:<ul>'+msg+'</ul>');
        $('#modalMensajes').modal('toggle');
    }else{
        descargaPDF();
    }
}

function descargaPDF(){
    var datos = new FormData();
    // var dateValInnicio = new Date();
    // var dateValFin = new Date();

    var fecha_inicio = $("#inputinicio").val();
    var fecha_fin = $("#inputfin").val();

    fecha_inicio = fecha_inicio.replace(/-/g, "");
    fecha_fin = fecha_fin.replace(/-/g, "");

    window.open('reporte_pdf.php?fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin);
}

function descPDF(){
    var datos = new FormData();
    // var dateValInnicio = new Date();
    // var dateValFin = new Date();

    var fecha_inicio = $("#inputinicio").val();
    var fecha_fin = $("#inputfin").val();

    fecha_inicio = fecha_inicio.replace(/-/g, "");
    fecha_fin = fecha_fin.replace(/-/g, "");
    // alert(fecha_inicio);

    datos.append('inicio',  $('#inputinicio').val());
    datos.append('fin',     $('#inputfin').val());

    // console.log(datos.get('inicio'));
    // console.log(datos.get('fin'));
    window.open('reporte_pdf.php?fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin);

    // $.ajax({
    //     type:"POST",
    //     url:"reporte_pdf.php",
    //     data: {
    //         "fecha_inicio":fecha_inicio,
    //         "fecha_fin":fecha_fin
    //     },
    //     success:function(r){
    //         window.open('reporte_pdf.php');
    //     }
    // });
}


// DESGARDA DE EXCEL
function validacionExcel() {
    var fecha_inicio = $("#inputinicio").val();
    var fecha_fin = $("#inputfin").val();

    var msj = "";

    if (fecha_inicio == 0) {
        msj += "<li>Fecha inicio</li>"
    }
    if (fecha_fin == 0) {
        msj += "<li>Fecha fin</li>"
    }
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');
    }else{
        validacionExceldos();
    }
}

function validacionExceldos() {
    var fecha_inicio = $("#inputinicio").val();
    var fecha_fin = $("#inputfin").val();

    var msg = "";

    if (fecha_inicio > fecha_fin) {
        msg += "<li>Fecha inicio debe ser menor a la Fecha final</li>"
    }
    if (msg.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos no son correctoS:<ul>'+msg+'</ul>');
        $('#modalMensajes').modal('toggle');
    }else{
        descargaExcel();
    }
}

function descargaExcel(){
    var datos = new FormData();

    var fecha_inicio = $("#inputinicio").val();
    var fecha_fin = $("#inputfin").val();

    fecha_inicio = fecha_inicio.replace(/-/g, "");
    fecha_fin = fecha_fin.replace(/-/g, "");

    datos.append('inicio',  $('#inputinicio').val());
    datos.append('fin',     $('#inputfin').val());
    // console.log(datos.get('inicio'));
    // console.log(datos.get('fin'));

    window.open('reportesexcel_saqueria.php?fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin);

    // var page='reportesexcel_saqueria.php';

    // $.ajax({
    //     type: 'POST',
    //     url:"reportesexcel_saqueria.php",
    //     data: {
    //         "fecha_inicio":fecha_inicio,
    //         "fecha_fin":fecha_fin
    //     },
    // success: function() {
    //     window.location = page;// you can use window.open also
    // }
    // });
}

// function dExcel(){
//     var page='reportesexcel_saqueria.php';
//     $.ajax({
//         type: 'POST',
//         url:"reportesexcel_saqueria.php",
//     success: function() {
//         window.location = page;// you can use window.open also
//     }
//     });
// }