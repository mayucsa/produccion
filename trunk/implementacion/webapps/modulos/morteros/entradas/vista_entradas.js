function consultar(){
        var table;
        $(document).ready(function() {
        table = $('#tableMatPrima').DataTable( {
            // "dom": 'Bfrtip',
            // "buttons": [
            //      {"extend": 'excel',"text": '<i class="far fa-file-excel"> Exportar en Excel</i>', "title": 'Producción Morteros'}, 
            //      {"extend": 'pdf', "text": '<i class="far fa-file-pdf"> Exportar en PDF</i>', "title": 'Producción Morteros'}, 
            //      {"extend": 'print', "text": '<i class="fas fa-print"> Imprimir</i>', "title": 'Producción Morteros'},
            //      "pageLength",
            // ],
            "processing": true,
            "serverSide": true,
            "ajax": "serverSideentradas.php",
            "lengthMenu": [[15, 30, 50, 100], [15, 30, 50, 100]],
            "pageLength": 15,
            "order": [3, 'desc'],
            // "destroy": true,
            "searching": true,
            // bSort: false,
            // "paging": false,
            // "searching": false,
            "bDestroy": true,
            "columnDefs":[
                            {
                                "targets": [0, 2, 3, 4],
                                "className": 'dt-body-center', /*alineacion al centro th de tbody de la table*/
                                // "DefaultContent": '<span class= "btn btn-warning" data-toggle="modal" data-target="#modalMatPrimaUpdate" data-whatever="@getbootstrap"> </span>',
                                // "targets": [4]
                                // "targets": -1,
                                // "data": null,
                                // "defaultContent": '<span class= "btn btn-warning" data-toggle="modal" data-target="#modalMatPrimaUpdate" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> </span>'
                            },
                            {
                                "targets": 4,
                                "render": function(data, type, row, meta){
                                    return  row[4]
                                }

                            }
                        ],

         "language": {
            "buttons": {
                        "pageLength": {
                            '_': "Mostrar %d registros por página.",
                        }
                    },
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

        /*===================================================================*/
        // EVENTOS PARA CRITERIOS DE BUSQUEDA (PRODUCTO Y PRESENTACIÓN)
        /*===================================================================*/

        $("#iptNombre").keyup(function(){
            table.column($(this).data('index')).search(this.value).draw();
            })
        $("#iptFecha").keyup(function(){
            table.column($(this).data('index')).search(this.value).draw();
            })
}

function consult(){
        var table;
        $(document).ready(function() {
        table = $('#tableMatPrima').DataTable( {
            "dom": 'Bfrtip',
            "buttons": [
                 {"extend": 'excel',"text": '<i class="far fa-file-excel"> Exportar en Excel</i>', "title": 'Producción Morteros'}, 
                 {"extend": 'pdf', "text": '<i class="far fa-file-pdf"> Exportar en PDF</i>', "title": 'Producción Morteros'}, 
                 {"extend": 'print', "text": '<i class="fas fa-print"> Imprimir</i>', "title": 'Producción Morteros'},
                 "pageLength",
            ],
            "processing": true,
            "serverSide": true,
            "ajax": "serverSideentradas.php",
            "lengthMenu": [[15, 30, 50, 100], [15, 30, 50, 100]],
            "pageLength": 15,
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
                                    return  '<span class= "btn btn-warning" onclick="sinacceso()" title="Editar"><i class="fas fa-edit"></i> </span>' + ' ' + 
                                            '<span class= "btn btn-danger" onclick="sinacceso()" title="Eliminar"><i class="fas fa-trash-alt"></i> </span>';
                                }
                                // "data": null,
                                // "defaultContent": '<span class= "btn btn-warning" onclick= "obtenerDatos(".$value["cve_entrada"].")" data-toggle="modal" data-target="#modalMatPrimaUpdate" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> </span>'
                            }
                        ],

         "language": {
            "buttons": {
                        "pageLength": {
                            '_': "Mostrar %d registros por página.",
                        }
                    },
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

        /*===================================================================*/
        // EVENTOS PARA CRITERIOS DE BUSQUEDA (PRODUCTO Y PRESENTACIÓN)
        /*===================================================================*/

        $("#iptNombre").keyup(function(){
            table.column($(this).data('index')).search(this.value).draw();
            })
        $("#iptFecha").keyup(function(){
            table.column($(this).data('index')).search(this.value).draw();
            })
}

function guardarEntrada(){
    var valida = validaEntrada();
    if (valida.length != 0) {
        Modal('form_captura','Validación de datos','Los siguientes campos son obligatorios:<ul>'+valida+'</ul>', 'danger');
    }else{
        Modal('form_captura','Confirmación','Realmente desea guardar los datos.', 'primary','procesaGuardaPersonal()');
    }
}

function procesaGuardaPersonal(){
  ajaxJson("modulos/morteros/entradas/ctrl_entradas.php",$('#form_captura').serialize(),function(data){
    if ( data.msg == false ) {
      var msj = "";
      msj = data.text_msg;
      Modal('form_captura','Validación de datos','<ul>'+msj+'</ul>', 'danger');
    } else {
          if (data.suceso === true) {
            if (data.accion === 'nuevo') {
                Modal('form_captura','Guardado correctamente','Los datos se guardaron correctamente, puede seguir capturando la información del colaborador de lo contrario de click en Regresar a busqueda.', 'success');
                 $('#cve_personal').val('');
                 // limpiar();
            } else {
                 Modal('form_captura','Guardado correctamente','Los datos se guardaron correctamente, puede seguir editando la compañia de lo contrario de click en Regresar a busqueda.', 'success');
            }

          } else {
                Modal('form_captura','Ups tenemos un problema','Intenta nuevamente, sí persiste comunicate con tu administrador de sistema.', 'danger');
          }
    }
  });
}

function validaEntrada(){
    var mat_entrada =   $('comb_mat_prima').val();
    var cantidad    =   $('comb_cantidad').val();
    var msj = "";

    if (mat_entrada == "") {
        msj += '<li>Selecciones una Materia Prima</li>';
    }
    if (cantidad == "") {
        msj += '<li>Ingrese una cantidad</li>';
    }
    
    return msj;
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');
    }
}

function mostrar(){
    $.ajax({
        type:"POST",
        url:"ctrl_entradas.php",
        success:function(r){
            $('#tablaMatPrima').html(r);
        }
    });
}

function obtenerDatos(cve_entrada) {
    $.getJSON("modelo_entradas.php?consultar="+cve_entrada, function(registros){
        console.log(registros);

        $('#comb_idu').val(registros[0]['cve_entrada']);
        $('#comb_mat_primau').val(registros[0]['nombre']);
        $('#comb_cantidadu').val(registros[0]['cantidad_entrada']);
    });
}

function limpiarCampos() {
    $('#comb_mat_prima').val("0");
    $('#comb_cantidad').val("");
}

function limpiarCamposQ() {
    $('#comb_quimico').val("0");
    $('#comb_cantidadq').val("");
}

function limpiarCamposReproceso() {
    $('#comb_mat_primau').val("0");
    $('#comb_cantidadu').val("");
}

function cerrarModal(){
    $('#modalMatPrima').modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
}

function cerrarModalEditar(){
    $('#modalMatPrimaUpdate').modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
}
function cerrarModalEliminar(){
    $('#modalDeleteMP').modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
}

function sinacceso(){

    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });

}

function validacionCampos(){
    var select = $('#comb_mat_prima').val();
    var cantidad = $('#comb_cantidad').val();
    var msj = "";

    if (select == 0) {
        // console.log(select);
        msj += '<li>Materia Prima</li>';
    }    
    if (cantidad == "") {
        // console.log(cantidad);
        msj += '<li>Cantidad</li>';
    }
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');

    } else{
        insertEntradas();
    }
}

function insertEntradas() {
    var datos   = new FormData();
    datos.append('nombre', $('#comb_mat_prima').val());
    datos.append('cantidad_entrada', $('#comb_cantidad').val());
    datos.append('user', $('#spanuser').text());
    console.log(datos.get('nombre'));
    console.log(datos.get('cantidad_entrada'));
    console.log(datos.get('user'));

    Swal.fire({
                title: '¿Los datos son correctos?',
                html: 'Materia Prima: <b>' +  datos.get('nombre') + '</b><br> Cantidad: <b>' + datos.get('cantidad_entrada') + ' Kg </b>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
    }).then((result) => {

    if (result.isConfirmed) {
    jsShowWindowLoad('Generando entrada de materia prima...');
        $.ajax({
                type:"POST",
                url:"modelo_entradas.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){
            // $('#myLoading').modal('show');
                    // mostrar();
                    // consultar();
                    // location.reload();
                    // limpiarCampos();
                    jsRemoveWindowLoad();
                    cerrarModal();
                    // $('#myLoadingGral').modal('show');
                        Swal.fire({
                          title: '¡Éxito!',
                          html: 'Se capturo de manera exitosa la entrada de materia prima',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: 'green',
                          confirmButtonText: 'Aceptar'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            location.reload();
                          }else{
                            location.reload();
                          }
                        });
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
    // }
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
                url:"modelo_entradas2.php?accion=insertarq",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){
                    // mostrar();
                    consultar();
                    limpiarCamposQ();
                    // cerrarModal();
                    // $('#modalMatPrima').modal('hide');
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
    // Swal.fire(
    //   '¡Entrada Cancelada!',
    //   'El registro de entrada de Quimico no fue registrado',
    //   'error'
    // )
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
                html: 'Materia Prima: <b>' + datos.get('nombre') + '</b> <br>Cantidad: <b>' + datos.get('cantidad_entrada') + ' Kg </b>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
    }).then((result) => {

    if (result.isConfirmed) {
        jsShowWindowLoad('Editando entrada de materia prima...');
        $.ajax({
                type:"POST",
                url:"modelo_entradas.php?actualizar=1",
                data: datos,
                processData:false,
                contentType:false,
        success:function(r){
            // console.log(r);
            // mostrar();
            jsRemoveWindowLoad();
            consultar();
            limpiarCamposReproceso();
            cerrarModalEditar();
            
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

function Eliminar(cve_entrada){
    $.getJSON("modelo_entradas.php?consultar="+cve_entrada, function(registros){
        console.log(registros);

        $('#folio').val(registros[0]['cve_entrada']);
        $('#nombre').val(registros[0]['nombre']);
        $('#cantidad').val(registros[0]['cantidad_entrada']);
    });
}

function eliminarEntrada(cve_entrada){
        var datos   = new FormData();
        datos.append('folio', $('#folio').val());
        datos.append('nombre', $('#nombre').val());
        datos.append('cantidad', $('#cantidad').val());
        datos.append('user', $('#spanuser').text());
        console.log(datos.get('folio'));
        console.log(datos.get('nombre'));
        console.log(datos.get('cantidad'));
        console.log(datos.get('user'));

        Swal.fire({
                title: '¿Los datos son correctos?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Eliminar',
        }).then((result) => {
            if (result.isConfirmed) {
                jsShowWindowLoad('Eliminando entrada...');
                $.ajax({
                    type:"POST",
                    url:"modelo_entradas.php?accion=eliminar",
                    data: datos,
                    processData:false,
                    contentType:false,
                    success:function(data){
                        jsRemoveWindowLoad();
                        consultar();
                        // cerrarModal();
                        Swal.fire({
                           title: '¡Éxito!',
                           html: 'Se elimino la produccion',
                           icon: 'success',
                           showCancelButton: false,
                           confirmButtonColor: 'green',
                           confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                cerrarModalEliminar();
                            }else{
                                cerrarModalEliminar();
                            }
                        })
                    }
                })
            }
        });

}