function consultar(){
    $(document).ready(function() {
    $('#tableQuimico').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSidequimico.php",
        "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        "order": [3, 'desc'],
        // "destroy": true,
        "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": false,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [1, 2, 3],
                            "className": 'dt-body-center', /*alineacion al centro th de tbody de la table*/
                            // "DefaultContent": '<span class= "btn btn-warning" data-toggle="modal" data-target="#modalMatPrimaUpdate" data-whatever="@getbootstrap"> </span>',
                            // "targets": [4]
                            // "targets": -1,
                            // "data": null,
                            // "defaultContent": '<span class= "btn btn-warning" data-toggle="modal" data-target="#modalMatPrimaUpdate" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> </span>'
                        },
                        {
                            "targets": 3,
                            "render": function(data, type, row, meta){
                                // const primaryKey = data;
                                // "data": 'cve_entrada',
                                return '<span class= "btn btn-warning" onclick= "obtenerDatos('+row[3]+')" data-toggle="modal" data-target="#modalMatPrimaUpdate" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> </span>';
                            }
                            // "data": null,
                            // "defaultContent": '<span class= "btn btn-warning" onclick= "obtenerDatos(".$value["cve_entrada"].")" data-toggle="modal" data-target="#modalMatPrimaUpdate" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> </span>'
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

function consult(){
    $(document).ready(function() {
    $('#tableQuimico').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSidequimico.php",
        "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        "order": [3, 'desc'],
        // "destroy": true,
        "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": false,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [1, 2, 3],
                            "className": 'dt-body-center', /*alineacion al centro th de tbody de la table*/
                            // "DefaultContent": '<span class= "btn btn-warning" data-toggle="modal" data-target="#modalMatPrimaUpdate" data-whatever="@getbootstrap"> </span>',
                            // "targets": [4]
                            // "targets": -1,
                            // "data": null,
                            // "defaultContent": '<span class= "btn btn-warning" data-toggle="modal" data-target="#modalMatPrimaUpdate" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> </span>'
                        },
                        {
                            "targets": 3,
                            "render": function(data, type, row, meta){
                                // const primaryKey = data;
                                // "data": 'cve_entrada',
                                return '<span class= "btn btn-warning" onclick="sinacceso()" title="Devolucion"><i class="fas fa-edit"></i> </span>';
                            }
                            // "data": null,
                            // "defaultContent": '<span class= "btn btn-warning" onclick= "obtenerDatos(".$value["cve_entrada"].")" data-toggle="modal" data-target="#modalMatPrimaUpdate" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> </span>'
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

function limpiarCamposQ() {
    $('#comb_quimico').val("0");
    $('#comb_cantidadq').val("");
}

function limpiarCamposReproceso() {
    $('#comb_mat_primau').val("0");
    $('#comb_cantidadu').val("");
}

function obtenerDatos(cve_entrada) {
    $.getJSON("modelo_insertq.php?consultar="+cve_entrada, function(registros){
        // console.log(registros);

        $('#comb_idu').val(registros[0]['cve_entrada']);
        $('#comb_mat_primau').val(registros[0]['nombre']);
        $('#comb_cantidadu').val(registros[0]['cantidad_entrada']);
    });
}

function sinacceso(){

    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
}

function insertEntradasQ() {
    var select = $('#comb_quimico').val();
    var cantidad = $('#comb_cantidadq').val();
    var msj = "";

    if (select == 0) {
    //     console.log("Selecciones una Materia Prima");
    //     console.log(select);
        msj += 'Seleccione un Quimico <br>';
    }    
    if (cantidad == "") {
        // console.log("Ingrese Cantidad");
        // console.log(cantidad);
        msj += 'Ingrese una cantidad <br>';
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
    datos.append('nombre', $('#comb_quimico').val());
    datos.append('cantidad_entrada', $('#comb_cantidadq').val());
    // console.log(datos.get('nombre_mat_prima'));
    // console.log(datos.get(number('cantidad').toFixed(2)));
    Swal.fire({
                title: '¿Los datos son correctos?',
                html: 'Químico: <b>' + datos.get('nombre') + '</b> <br>Cantidad: <b>' + datos.get('cantidad_entrada') + ' Kg </b>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
    }).then((result) => {

    if (result.isConfirmed) {

        $.ajax({
                type:"POST",
                url:"modelo_insertq.php?accion=insertarq",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){

                    consultar();
                    limpiarCamposQ();

                    Swal.fire(
                                '¡Agregado!',
                                'Materia Prima Agregado con Exito !',
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
function editarEntradas(cve_entrada) {
    // var select = $('#comb_quimico').val();
    var cantidad = $('#comb_cantidadu').val();
    var msj = "";

    // if (select == 0) {
    //     console.log("Selecciones una Materia Prima");
    //     console.log(select);
        // msj += 'Seleccione un Quimico <br>';
    // }    
    if (cantidad == "") {
        // console.log("Ingrese Cantidad");
        // console.log(cantidad);
        msj += 'Ingrese una cantidad <br>';
    }

    if (msj.length != 0) {
        // $('#encabezadoModal').html('Validación de datos');
        // $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        // $('#modalMensajes').modal('toggle');
        // Swal.fire('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>')
        // alert("Ingrese Cantidad")
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
                    // Swal.fire(
                    // 'Deleted!',
                    // 'Your file has been deleted.',
                    // 'success'
                    // )
                }
                });
    } else{
    var datos   = new FormData();
    datos.append('cve_entrada', $('#comb_idu').val());
    datos.append('nombre', $('#comb_mat_primau').val());
    datos.append('cantidad_entrada', $('#comb_cantidadu').val());
    // console.log(datos.get('nombre'));
    // console.log(datos.get('cantidad_entrada'));
        Swal.fire({
                title: '¿Los datos son correctos?',
                html: 'Químico: <b>' + datos.get('nombre') + '</b> <br>Cantidad: <b>' + datos.get('cantidad_entrada') + ' Kg </b>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
    }).then((result) => {

    if (result.isConfirmed) {
        $.ajax({
                type:"POST",
                url:"modelo_insertq.php?actualizar=1",
                data: datos,
                processData:false,
                contentType:false,
        success:function(r){
            // console.log(r);
            // mostrar();
            consultar();
            limpiarCamposReproceso();
            
                    Swal.fire(
                                '¡Modificación!',
                                'Materia Prima Modificado con Exito !',
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
    //   'El registro de entrada de Quimico no fue registrado',
    //   'error'
    // )
  }
    });
    }

}