function consultar(){
    $(document).ready(function() {
    $('#tablaMPVibro').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "ServerSideEntradas.php",
        "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        "order": [2, 'desc'],
        // "destroy": true,
        "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": false,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [1, 2],
                            "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
                        },
                        {
                          "targets": 1,
                          // "data": 'creator',
                          "render": function ( data, type, row ) {
                          return row[1] +' '+ row[3] ;
                        }
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

function limpiarCampos() {
    $('#selectproducto').val("0");
    $('#inputcantidad').val("");
    $('#inputchofer').val("");
    $('#inputodc').val("");
    $('#inputsellos').val("");
    $('#inputtarjeta').val("");
    $('#inputpipa').val("");
}

function sinacceso(){

    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
}

function comprobacion() {
    var producto    = $('#selectproducto').val();
    var msj = "";
    if (producto == 1 || producto == 0) {
        validacionDatos();
    } else{
        validacion();
        $('#inputchofer').val("No aplica");
        $("#inputchofer").attr("disabled", true);
        $('#inputodc').val("No aplica");
        $("#inputodc").attr("disabled", true);
        $('#inputsellos').val("No aplica");
        $("#inputsellos").attr("disabled", true);
        $('#inputtarjeta').val("No aplica");
        $("#inputtarjeta").attr("disabled", true);
        $('#inputpipa').val("No aplica");
        $("#inputpipa").attr("disabled", true);
    }
}
 function validacion() {
    var producto    = $('#selectproducto').val();
    var cantidad    = $('#inputcantidad').val();
    var msj = "";

    if (producto == 0) {
        msj += '<li>Producto</li>';
    }   
    if (cantidad == "") {
        msj += '<li>Cantidad</li>';
    }   
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');

    } else{
        capturaEntradas();
    }
 }

function validacionDatos(){
    var producto    = $('#selectproducto').val();
    var cantidad    = $('#inputcantidad').val();
    var chofer      = $('#inputchofer').val();
    var odc         = $('#inputodc').val();
    var sellos      = $('#inputsellos').val();
    var tarjeta     = $('#inputtarjeta').val();
    var pipa        = $('#inputpipa').val();
    var msj = "";

    if (producto == 0) {
        msj += '<li>Producto</li>';
    }   
    if (cantidad == "") {
        msj += '<li>Cantidad</li>';
    } 
    if (chofer == 0) {
        msj += '<li>Chofer</li>';
    }   
    if (odc == "") {
        msj += '<li>Orden de compra</li>';
    } 
    if (sellos == 0) {
        msj += '<li>Sellos buenos</li>';
    }   
    if (tarjeta == "") {
        msj += '<li>Tarjeta</li>';
    }
    if (pipa == "") {
        msj += '<li>Pipa</li>';
    }   
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');

    } else{
        capturaEntradas();
    }
}

function capturaEntradas() {
    var datos = new FormData();
    var mgs = "";

    var producto    = $('#selectproducto').val();

    datos.append('producto',    $('#selectproducto').val());
    datos.append('cantidad',    $('#inputcantidad').val());
    datos.append('chofer',      $('#inputchofer').val());
    datos.append('odc',         $('#inputodc').val());
    datos.append('sellos',      $('#inputsellos').val());
    datos.append('tarjeta',     $('#inputtarjeta').val());
    datos.append('pipa',        $('#inputpipa').val());
    datos.append('user',        $('#spanuser').text());

    // console.log(datos.get('producto'));
    // console.log(datos.get('cantidad'));
    // console.log(datos.get('chofer'));
    // console.log(datos.get('odc'));
    // console.log(datos.get('sellos'));
    // console.log(datos.get('tarjeta'));
    // console.log(datos.get('pipa'));
    // console.log(datos.get('user'));

    if (producto == 1) {
        mgs += 'Cemento';
    } else {
        mgs += 'Aditivo';
    }


    Swal.fire({
                title: '¿Los datos son correctos?',
                html: 'Producto: <b>' +  mgs + 
                '</b><br> Cantidad: <b>' + datos.get('cantidad'),
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
                url:"modelo_entradas.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){

                    consultar();
                    limpiarCampos();
                    // cerrarModal();
                    // $('#myLoadingGral').modal('show');
                    Swal.fire(
                                'Entrada de Materia Prima!',
                                'Realizado con Exito !',
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