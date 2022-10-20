function consultarrol(){
    $(document).ready(function() {
    $('#tablarol').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serversideRol.php",
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
                            "targets": [1, 2, 3],
                            "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
                        },
                        {
                            "targets": 3,
                            "render": function(data, type, row, meta){
                                // const primaryKey = data;
                                // "data": 'cve_entrada',
                                if (row[3] == 'VIG') {
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

// function consultarmodulo(){
//     $(document).ready(function() {
//     $('#tablamodulo').DataTable( {
//         "processing": true,
//         "ajax": "serversideModal.php",
//         "columnDefs":[
//                         {
//                             "targets": [1,2,3,4,5],
//                             "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
//                         },
//                         {
//                             "targets": 2,
//                             "render": function(data, type, row, meta){
//                                 return '<div class="toggle-flip"> <label> <input type="checkbox"><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span> </label> </div>';
//                             }
//                         },
//                         {
//                             "targets": 3,
//                             "render": function(data, type, row, meta){
//                                 return '<div class="toggle-flip"> <label> <input type="checkbox"><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span> </label> </div>';
//                             }
//                         },
//                         {
//                             "targets": 4,
//                             "render": function(data, type, row, meta){
//                                 return '<div class="toggle-flip"> <label> <input type="checkbox"><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span> </label> </div>';
//                             }
//                         },
//                         {
//                             "targets": 5,
//                             "render": function(data, type, row, meta){
//                                 return '<div class="toggle-flip"> <label> <input type="checkbox"><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span> </label> </div>';
//                             }
//                         }
//                     ],

//      "language": {
//          "lengthMenu": "Mostrar _MENU_ registros por página.",
//          "zeroRecords": "No se encontró registro.",
//          "info": "  _START_ de _END_ (_TOTAL_ registros totales).",
//          "infoEmpty": "0 de 0 de 0 registros",
//          "infoFiltered": "(Encontrado de _MAX_ registros)",
//          "search": "Buscar: ",
//          "searchPlaceholder": "Escribe aquí para buscar..",
//          "processing": "Procesando...",
//                   "paginate": {
//              "first": "Primero",
//              "previous": "Anterior",
//              "next": "Siguiente",
//              "last": "Último"
//          }

//      }

//     } );
// } );
// }

function limpiarCamposnuevo(){
    $('#txtname').val("");
    $('#txtdescripcion').val("");
    $('#selectStatus').val("1");
}

function insertRol() {
    var name            = $('#txtname').val();
    var descripcion     = $('#txtdescripcion').val();
    var status          = $('#selectStatus').val();
    var msj = "";

    if (name == "") {
        // console.log(select);
        msj += 'Nombre del rol <br>';
    }    
    if (descripcion == "") {
        // console.log(cantidad);
        msj += 'Descripcion del rol <br>';
    }
    if (status == 0) {
        // console.log(cantidad);
        msj += 'Ingrese estatus del rol<br>';
    }
    if (msj.length != 0) {
        Swal.fire({
                title: 'Los siguientes campos son obligatorios:',
                html: msj,
                icon: 'warning',
                iconColor: '#d33',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok!'
                }).then((result) => {
                if (result.isConfirmed) {

                }
                });
    } else{

    var datos   = new FormData();
    datos.append('nombre',      $('#txtname').val());
    datos.append('descripcion', $('#txtdescripcion').val());
    datos.append('estatus',     $('#selectStatus').val());
    // console.log(datos.get('nombre'));
    // console.log(datos.get('descripcion'));
    // console.log(datos.get('estatus'));

    Swal.fire({
                title: '¿Los datos son correctos?',
                html:   'Nombre del Rol: <b>' +  datos.get('nombre') +
                        '</b><br> Estatus: <b>' + datos.get('estatus') + ' </b>',
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
                url:"modelo_rol.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){
            // $('#myLoading').modal('show');
                    // mostrar();
                    consultarrol();
                    limpiarCamposnuevo();
                    // cerrarModal();
                    // $('#modalrol').each(function(){
                    //     $(this).modal('hide');
                    // });
                    Swal.fire(
                                '¡Agregado!',
                                'Rol Agregado con Exito !',
                                'success'
                            )
                    }

            })
        } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {

  }
    });
    }
}