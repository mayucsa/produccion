function consultarUsuario(){
    $(document).ready(function() {
    $('#tablausuario').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serversideUsuario.php",
        "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        // "order": [4, 'desc'],
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
                        },
                        {
                          "targets": 1,
                          // "data": 'creator',
                          "render": function ( data, type, row ) {
                          return row[1] +' '+ row[6] ;
                            }
                        },
                        {
                            "targets": 4,
                            "render": function(data, type, row, meta){
                                // const primaryKey = data;
                                // "data": 'cve_entrada',
                                if (row[4] == 'VIG') {
                                    return '<span class= "badge badge-success">Activo</span>';
                                }else{
                                    return '<span class= "badge badge-danger">Inactivo</span>';
                                }
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
         "searchPlaceholder": "Escribe aquí para buscar..",
         "LoadingRecords": "<img style='display: block;width:100px;margin:0 auto;' src='assets/img/loading.gif' />",
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

function limpiarCampos(){
    $('#inputusuario').val("");
    $('#inputpassword').val("");
    $('#inputnombre').val("");
    $('#inputapellido').val("");
    $('#inputpuesto').val("");
    $('#selectrol').val("0");
}

function insertUsuario(){
    var usuario     = $('#inputusuario').val();
    var contrasenia = $('#inputpassword').val();
    var nombre      = $('#inputnombre').val();
    var apellido    = $('#inputapellido').val();
    var puesto      = $('#inputpuesto').val();
    var cve_rol     = $('#selectrol').val();
    var msj = "";

    if (usuario == "") {
        msj += '<li>Usuario</li>';
    }
    if (contrasenia == "") {
        msj += '<li>Contraseña</li>';
    }
    if (nombre == "") {
        msj += '<li>Nombre</li>';
    }
    if (apellido == "") {
        msj += '<li>Apellido</li>';
    }
    if (puesto == "") {
        msj += '<li>Puesto</li>';
    }
    if (cve_rol == 0) {
        msj += '<li>Rol</li>';
    }
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');

    }else{
        var datos = new FormData();

        datos.append('usuario',     $('#inputusuario').val());
        datos.append('contrasenia', $('#inputpassword').val());
        datos.append('nombre',      $('#inputnombre').val());
        datos.append('apellido',    $('#inputapellido').val());
        datos.append('puesto',      $('#inputpuesto').val());
        datos.append('cve_rol',     $('#selectrol').val());

        // console.log(datos.get('usuario'));
        // console.log(datos.get('contrasenia'));
        // console.log(datos.get('nombre'));
        // console.log(datos.get('apellido'));
        // console.log(datos.get('puesto'));
        // console.log(datos.get('cve_rol'));

    Swal.fire({
                title: '¿Los datos son correctos?',
                html:   'Nombre: <b>' + datos.get('nombre') +
                        '</b><br> Apellido: <b>' + datos.get('apellido') +
                        '</b><br> Puesto: <b>' + datos.get('puesto'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Agregar',
    }).then((result) => {

    if (result.isConfirmed) {    

        $.ajax({
                type:"POST",
                url:"modelo_usuario.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){
            // $('#myLoading').modal('show');
                    // mostrar();
                    consultarUsuario();
                    limpiarCampos();
                    // consultarDatos();
                    // cerrarModal();
                    // $('#modalMatPrima').modal('hide');
                    Swal.fire(
                                '¡Agregado!',
                                'Usted ha agregado un usuario con éxito!!',
                                'success'
                            )
                    }

            })
        }
    });

    }
    
}