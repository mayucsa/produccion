function consultar(){
    $(document).ready(function() {
    $('#tableSalida').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "json_busqueda.php",
        "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        "order": [4, 'desc'],
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
                            "targets": 5,
                            "render": function(data, type, row, meta){
                                return '<span class= "btn btn-warning"  onclick= "obtenerDatos('+row[5]+')" title="Editar" data-toggle="modal" data-target="#modalPFUpdate" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> </span>'
                                + 
                                ' <span class= "btn btn-info" onclick= "obtenerDatosDev('+row[5]+')" title="Devolucion" data-toggle="modal" data-target="#modalDevPF" data-whatever="@getbootstrap"><i class="fas fa-undo-alt"></i> </span>';
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
         // "LoadingRecords": "<img style='display: block;width:100px;margin:0 auto;' src='assets/img/loading.gif' />",
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
    $('#tableSalida').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "json_busqueda.php",
        "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        "order": [4, 'desc'],
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
                            "targets": 5,
                            "render": function(data, type, row, meta){
                                return '<span class= "btn btn-warning" onclick="sinacceso()" title="Editar"><i class="fas fa-edit"></i> </span>'
                                + 
                                ' <span class= "btn btn-info" onclick="sinacceso()" title="Devolucion"><i class="fas fa-undo-alt"></i> </span>';
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
         // "LoadingRecords": "<img style='display: block;width:100px;margin:0 auto;' src='assets/img/loading.gif' />",
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

function mostrar(){
    $.ajax({
        type:"POST",
        url:"ctrl_salidas.php",
        success:function(r){
            $('#tableSalidas').html(r);
        }
    });
}

function obtenerDatos(cve_salida) {
    $.getJSON("modelo_salidas.php?consultar="+cve_salida, function(registros){
        // console.log(registros);

        $('#comb_idu').val(registros[0]['cve_salida']);
        $('#comb_productou').val(registros[0]['nombre_salida']);
        $('#comb_presentup').val(registros[0]['presentacion_salida']);
        $('#comb_cantidadu').val(registros[0]['cantidad_salida']);
    });
}
function obtenerDatosDev(cve_salida) {
    $.getJSON("modelo_salidas.php?consultar="+cve_salida, function(registros){
        // console.log(registros);

        $('#comb_idd').val(registros[0]['cve_salida']);
        $('#comb_productod').val(registros[0]['nombre_salida']);
        $('#comb_presentd').val(registros[0]['presentacion_salida']);
        $('#comb_cantidadd').val(registros[0]['cantidad_salida']);
    });
}


function selectProducto(){
    var cve_producto = $("#salidaproducto").val();
    $.ajax({
        type: "POST",
        url: "selectoption.php",
        // method: "POST",
        data: {
            "cve_producto":cve_producto
        },
        success:function(r){
            // console.log(r);
            // $("#spantonelada").html(r);
            // selectTonelada();
            $("#selectpresentacion").attr("disabled", false);
            $("#selectpresentacion").html(r);

        }
    })

}

function limpiarCampos() {
    $('#salidaproducto').val("0");
    $('#selectpresentacion').val("0");
    $('#inputcantidad').val("");
    $('#salidamotivo').val("0");
}

function limpiarCamposMP() {
    $('#salidamp').val("0");
    $('#salidamotivomp').val("0");
    $('#inputcantidadmp').val("");
}

function limpiarCamposEdit() {
    $('#comb_productou').val("0");
    $('#comb_presentup').val("");
    $('#comb_cantidadu').val("");
}
function limpiarCamposDev() {
    $('#comb_productod').val("0");
    $('#comb_presentd').val("");
    $('#comb_cantidadd').val("");
    $('#comb_folio').val("");
    $('#comb_motivo').val("");
}

function sinacceso(){

    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
}

function darSalida(){
    var producto = $('#salidaproducto').val();
    var presentacion = $('#selectpresentacion').val();
    var cantidad = $('#inputcantidad').val();
    var motivo = $('#salidamotivo').val();
    var msj = "";

    if (producto == 0 ) {
        msj += '<li>Producto</li>'
    } 
    if (presentacion == 0 ) {
        msj += '<li>Presentación</li>'
    }
    if (motivo == 0) {
        msj += '<li>Motivo</li>'
    }    
    if (cantidad == "") {
        msj += '<li>Cantidad</li>'
    }    
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');
}else{
    var datos   = new FormData();
        datos.append('producto', $('#salidaproducto').val());
        datos.append('name', $('#salidaproducto').text());
        datos.append('presentacion', $('#selectpresentacion').val());
        datos.append('cantidad', $('#inputcantidad').val());
        datos.append('motivo', $('#salidamotivo').val());
    // console.log(datos.get('producto'));
    // console.log(datos.get('presentacion'));
    // console.log(datos.get('cantidad'));
    // console.log(datos.get('motivo'));

    Swal.fire({
                title: '¿Los datos son correctos?',
                html:   'Producto: <b>' + datos.get('producto') + 
                        '</b><br> Presentacion: <b>' + datos.get('presentacion') + 
                        '</b><br>Cantidad: <b>' + datos.get('cantidad'),
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
                url:"modelo_salidas.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){
            // $('#myLoading').modal('show');
                    // mostrar();
                    consultar();
                    limpiarCampos();
                    // cerrarModal();
                    // $('#modalMatPrima').modal('hide');
                    Swal.fire(
                                '¡Salida de Producto!',
                                'Usted ha realizado una salida a la producción de manera Exitosa !!',
                                'success'
                            )
                    }

            })
        }
    });

    }
}


function SalidaMP(){
    var materiaprima = $('#salidamp').val();
    var motivo = $('#salidamotivomp').val();
    var cantidad = $('#inputcantidadmp').val();
    var msj = "";

    if (materiaprima == 0 ) {
        msj += '<li>Materia Prima</li>'
    }
    if (motivo == 0) {
        msj += '<li>Motivo</li>'
    }  
    if (cantidad == "") {
        msj += '<li>Cantidad</li>'
    }
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');
}else{
    var datos   = new FormData();
        datos.append('materiaprima', $('#salidamp').val());
        datos.append('motivo', $('#salidamotivomp').val());
        datos.append('cantidad', $('#inputcantidadmp').val());
        console.log(datos.get('materiaprima'));
        console.log(datos.get('motivo'));
        console.log(datos.get('cantidad'));

    Swal.fire({
                title: '¿Los datos son correctos?',
                html:   'Materia Prima: <b>'    + datos.get('materiaprima') + 
                        '</b><br> Motivo: <b>'  + datos.get('motivo') + 
                        '</b><br>Cantidad: <b>' + datos.get('cantidad'),
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
                url:"modelo_salidasmp.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){
            // $('#myLoading').modal('show');
                    // mostrar();
                    consultar();
                    limpiarCamposMP();
                    // cerrarModal();
                    // $('#modalMatPrima').modal('hide');
                    Swal.fire(
                                '¡Salida de Materia Prima!',
                                'Usted ha realizado una salida a la producción de manera Exitosa !!',
                                'success'
                            )
                    }

            })
        }
    });

    }
}

function editarSalidas(cve_salida) {
    var cantidad = $('#comb_cantidadu').val();
    var msj = "";
   
    if (cantidad == "") {
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
    datos.append('cve_salida', $('#comb_idu').val());
    datos.append('nombre_salida', $('#comb_productou').val());
    datos.append('presentacion_salida', $('#comb_presentup').val());
    datos.append('cantidad_salida', $('#comb_cantidadu').val());
    // console.log(datos.get('cve_salida'));
    // console.log(datos.get('nombre_salida'));
    // console.log(datos.get('presentacion_salida'));
    // console.log(datos.get('cantidad_salida'));

        Swal.fire({
                title: '¿Los datos son correctos?',
                html: 'Producto: <b>' + datos.get('nombre_salida') + '</b> <br>Cantidad: <b>' + datos.get('cantidad_salida') + ' Kg </b>',
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
                url:"modelo_salidas.php?actualizar=1",
                data: datos,
                processData:false,
                contentType:false,
        success:function(r){

                    consultar();
                    limpiarCamposEdit();

                    Swal.fire(
                                '¡Modificación!',
                                'Producto Finalizado ha Modificado con Exito !',
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


function devolucionSalidas(cve_salida) {
    var cantidad    = $('#comb_cantidadd').val();
    var folio       = $('#comb_folio').val();
    var motivo      = $('#comb_motivo').val();
    var msj = "";
   
    if (cantidad == "") {
        msj += 'Ingrese una cantidad <br>';
    }
    if (folio == "") {
        msj += 'Ingrese un folio <br>';
    }
    if (motivo == "") {
        msj += 'Ingrese el motivo <br>';
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
    datos.append('cve_salida',              $('#comb_idd').val());
    datos.append('nombre_salida',           $('#comb_productod').val());
    datos.append('presentacion_salida',     $('#comb_presentd').val());
    datos.append('cantidad_salida',         $('#comb_cantidadd').val());
    datos.append('folio',                   $('#comb_folio').val());
    datos.append('motivo_devolucion',       $('#comb_motivo').val());
    console.log(datos.get('cve_salida'));
    console.log(datos.get('nombre_salida'));
    console.log(datos.get('presentacion_salida'));
    console.log(datos.get('cantidad_salida'));
    console.log(datos.get('folio'));
    console.log(datos.get('motivo_devolucion'));

        Swal.fire({
                title: '¿Los datos son correctos?',
                html:   'Producto: <b>' + datos.get('nombre_salida') +
                 '</b> <br>Cantidad: <b>' + datos.get('cantidad_salida') + ' Kg' +
                 '</b> <br>Folio: <b>' + datos.get('folio'),
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
                url:"modelo_salidasact.php?actualizar=1",
                data: datos,
                processData:false,
                contentType:false,
        success:function(r){

                    consultar();
                    limpiarCamposDev();

                    Swal.fire(
                                '¡Modificación!',
                                'Producto Finalizado ha Modificado con Exito !',
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