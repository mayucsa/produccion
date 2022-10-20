function consultar(){
    $(document).ready(function() {
    $('#tablaInvVibro').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSideDesalojo.php",
        "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        "order": [5, 'desc'],
        // "destroy": true,
        "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": false,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [1, 2, 3, 4, 5],
                            "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
                        }
                    ],

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

    } );
} );
}

function selectProducto(){
    var cve_pbloquera = $("#selectproducto").val();
    $.ajax({
        type: "POST",
        url: "selectproducto.php",
        // method: "POST",
        data: {
            "cve_pbloquera":cve_pbloquera
        },
        success:function(r){
            // console.log(r);
            // $("#spantonelada").html(r);
            // selectPiezas();
            $("#selectpresentacion").attr("disabled", false);
            $("#selectpresentacion").html(r);
        }
    })
}

function limpiarCampos() {
    $('#selectproducto').val("0");
    $('#selectpresentacion').val("0");
    $('#inputtotal').val("");
    $('#inputrotura').val("");
    $('#inputdespuntados').val("");
}

function sinacceso(){

    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
}

function validacionDatos(){
    var producto        = $('#selectproducto').val();
    var presentacion    = $('#selectpresentacion').val();
    var total           = $('#inputtotal').val();
    var rotura          = $('#inputrotura').val();
    var despuntados     = $('#inputdespuntados').val();
    var msj = "";

    if (producto == 0) {
        msj += '<li>Producto</li>';
    }   
    if (presentacion == "") {
        msj += '<li>Presentación</li>';
    }   
    if (total == "") {
        msj += '<li>Cantidad Total</li>';
    }   
    if (rotura == "") {
        msj += '<li>Cantidad Rotura</li>';
    }   
    if (despuntados == "") {
        msj += '<li>Cantidad despuntados</li>';
    }
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');

    } else{
        capturaProduccion();
    }
}

function capturaProduccion() {
    var datos = new FormData();
    var mgs = "";
    var mgsp = "";
    var producto    = $('#selectproducto').val();
    var presentacion    = $('#selectpresentacion').val();

    datos.append('producto',        $('#selectproducto').val());
    datos.append('presentacion',    $('#selectpresentacion').val());
    datos.append('total',           $('#inputtotal').val());
    datos.append('rotura',          $('#inputrotura').val());
    datos.append('despuntados',     $('#inputdespuntados').val());
    datos.append('user',            $('#spanuser').text());

    // console.log(datos.get('producto'));
    // console.log(datos.get('presentacion'));
    // console.log(datos.get('total'));
    // console.log(datos.get('rotura'));
    // console.log(datos.get('despuntados'));
    if (producto == 2) {
        mgs += 'Block';
    } else if (producto == 3) {
        mgs += 'Bovedilla';
    } else if (producto == 4){
        mgs += 'Tabique';
    }

    if (presentacion == 4){
        mgsp += '10 x 20 x 40';
    } else if (presentacion == 5){
        mgsp += '12 x 20 x 40';
    } else if (presentacion == 6){
        mgsp += '15 x 20 x 40';
    } else if (presentacion == 7){
        mgsp += '20 x 20 x 40';
    } else if (presentacion == 8){
        mgsp += '15 x 25 x 56';
    } else if (presentacion == 9){
        mgsp += '20 x 25 x 56';
    } else if (presentacion == 10){
        mgsp += '5 x 17 x 40';
    }

    Swal.fire({
                title: '¿Los datos son correctos?',
                html: 'Producto: <b>' +  mgs + 
                '</b><br> Presentacion: <b>' + mgsp +
                '</b><br> Cantidad total: <b>' + datos.get('total') +
                '</b><br> Despuntados: <b>' + datos.get('despuntados'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
    }).then((result) => {

    if (result.isConfirmed) {

        $.ajax({
                type:"POST",
                url:"modelo_desalojo.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){

                    consultar();
                    limpiarCampos();
                    // cerrarModal();
                    // $('#myLoadingGral').modal('show');
                    Swal.fire(
                                'Desalojo!',
                                'Desalojo realizado con Exito !',
                                'success'
                            )
                    }

            })
        } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    // Swal.fire(
    //   '¡Entrada Cancelada!',
    //   'El registro de entrada de Materia Prima no fue registrado',
    //   'error'
    // )
  }
    });

}