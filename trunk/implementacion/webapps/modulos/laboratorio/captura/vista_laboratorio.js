function consultarQuimico(){
    $(document).ready(function() {
    $('#tablacaptura').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSidecapturaq.php",
        "lengthMenu": [[5, 10,], [5, 10,]],
        "order": [2, 'desc'],
        // "destroy": true,
        // "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": true,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [1, 2],
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

function consultarTrapaso(){
    $(document).ready(function() {
    $('#tablatraspaso').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSidetraspaso.php",
        "lengthMenu": [[10, 20,], [10, 20,]],
        "order": [2, 'desc'],
        // "destroy": true,
        // "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": false,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [1, 2],
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

function consultarDevolucion(){
    $(document).ready(function() {
    $('#tabladevolucion').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSidedevolucion.php",
        "lengthMenu": [[10, 20,], [10, 20,]],
        "order": [2, 'desc'],
        // "destroy": true,
        // "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": false,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [1, 2],
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

function consultarproduccion(){
    $(document).ready(function() {
    $('#tablaCapturap').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSideproduccion.php",
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

function limpiarCampos() {
    $('#selectconcentrado').val("0");
    $('#inputcantidad').val("");    
}
function limpiarCamposQ() {
    $('#comb_quimico').val("0");
    $('#comb_cantidadq').val("");
}
function limpiarModal() {
    $('#comb_concentrado').val("0");
    $('#comb_cantidadc').val("");    
}
function limpiarModalD() {
    $('#comb_concentradod').val("0");
    $('#comb_cantidadd').val("");    
}

function sinacceso(){

    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
}

function obtenerDatos(cve_entrada) {
    $.getJSON("modelo_insertq.php?consultar="+cve_entrada, function(registros){
        // console.log(registros);

        $('#comb_idu').val(registros[0]['cve_entrada']);
        $('#comb_mat_primau').val(registros[0]['nombre']);
        $('#comb_cantidadu').val(registros[0]['cantidad_entrada']);
    });
}
function mostrar(){
    $.ajax({
        type:"POST",
        url:"table_laboratorio.php",
        success:function(r){
            $('#tableconcentrado').html(r);
        }
    });
}
function mostrarkg(){
    $.ajax({
        type:"POST",
        url:"table_laboratoriokg.php",
        success:function(r){
            $('#tableconcentradokg').html(r);
        }
    });
}
function mostrarcaptura(){
    $.ajax({
        type:"POST",
        url:"table_captura.php",
        success:function(r){
            $('#tablecaptura').html(r);
        }
    });
}
function insertarCaptura(){
	var concentrado = $('#selectconcentrado').val();
	var cantidad = $('#inputcantidad').val();
    var msj = "";
  
  	if (concentrado == 0) {
  		msj += '<li>Seleccione un concentrado</li>';
  	}
    if (cantidad == "") {
        msj += '<li>Ingrese la cantidad a producir</li>';
    }
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');

    } else{
    	var datos   = new FormData();

    	datos.append('concentrado', $('#selectconcentrado').val());
    	datos.append('cantidad', $('#inputcantidad').val());

    	console.log(datos.get('concentrado'));
    	console.log(datos.get('cantidad'));
    Swal.fire({
                title: '¿Los datos son correctos?',
                html: 'Concentrado: <b>' +  datos.get('concentrado') + '</b><br> Cantidad: <b>' + datos.get('cantidad') + ' Pza </b>',
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
                url:"modelo_laboratorio.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){
            // $('#myLoading').modal('show');
                    mostrar();
                    mostrarkg();
                    consultarQuimico();
                    // mostrarcaptura();
                    limpiarCampos();
                    // consultarDatos();
                    // cerrarModal();
                    // $('#modalMatPrima').modal('hide');
                    Swal.fire(
                                '¡Agregado!',
                                'Concentrado agregado con Éxito !',
                                'success'
                            )
                    }

            })
        }
    });
    }

}

function inserttraspaso() {
    var concentrado = $('#comb_concentrado').val();
    var cantidad = $('#comb_cantidadc').val();
    var msj = "";

    if (concentrado == 0) {
        // console.log(select);
        msj += 'Concentrado <br>';
    }    
    if (cantidad == "") {
        // console.log(cantidad);
        msj += 'Cantidad <br>';
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
    datos.append('concentrado', $('#comb_concentrado').val());
    datos.append('cantidad', $('#comb_cantidadc').val());
    // console.log(datos.get('nombre_mat_prima'));
    // console.log(datos.get('cantidad'));

    Swal.fire({
                title: '¿Los datos son correctos?',
                html: 'Concentrado: <b>' +  datos.get('concentrado') + '<br></b> Cantidad: <b>' + datos.get('cantidad') + ' Pza </b>',
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
                url:"modelo_traspaso.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){
            // $('#myLoading').modal('show');
                    mostrar();
                    consultarTrapaso();
                    limpiarModal();
                    // cerrarModal();
                    // $('#myLoadingGral').modal('show');
                    Swal.fire(
                                'Traspaso!',
                                'Traspaso realizado con Exito !',
                                'success'
                            )
                    }

            })
        } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    // Swal.fire(
    //   'Traspaso Cancelado!',
    //   'El traspaso de concentrado no fue registrado',
    //   'error'
    // )
    
  }
    });
    }
}

function insertDevolucion() {
    var concentrado = $('#comb_concentradod').val();
    var cantidad = $('#comb_cantidadd').val();
    var msj = "";

    if (concentrado == 0) {
        // console.log(select);
        msj += 'Concentrado <br>';
    }    
    if (cantidad == "") {
        // console.log(cantidad);
        msj += 'Cantidad <br>';
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
    datos.append('concentrado', $('#comb_concentradod').val());
    datos.append('cantidad', $('#comb_cantidadd').val());
    // console.log(datos.get('nombre_mat_prima'));
    // console.log(datos.get('cantidad'));

    Swal.fire({
                title: '¿Los datos son correctos?',
                html: 'Concentrado: <b>' +  datos.get('concentrado') + '<br></b> Cantidad: <b>' + datos.get('cantidad') + ' Pza </b>',
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
                url:"modelo_devolucion.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){
            // $('#myLoading').modal('show');
                    mostrar();
                    consultarDevolucion();
                    limpiarModal();
                    // cerrarModal();
                    // $('#myLoadingGral').modal('show');
                    Swal.fire(
                                '¡Devolución!',
                                '¡Devolución realizado con Exito !',
                                'success'
                            )
                    }

            })
        } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) 
        {
    // Swal.fire(
    //   '¡Devolución Cancelado!',
    //   'La devolución de concentrado no fue registrada',
    //   'error'
    // )
  }
    });
    }
}

// function insertEntradasQ() {
//     var select = $('#comb_quimico').val();
//     var cantidad = $('#comb_cantidadq').val();
//     var msj = "";

//     if (select == 0) {
//     //     console.log("Selecciones una Materia Prima");
//     //     console.log(select);
//         msj += 'Seleccione un Quimico <br>';
//     }    
//     if (cantidad == "") {
//         // console.log("Ingrese Cantidad");
//         // console.log(cantidad);
//         msj += 'Ingrese una cantidad <br>';
//     }

//     if (msj.length != 0) {

//         Swal.fire({
//                 title: 'Los siguientes campos son obligatorios:',
//                 html: msj,
//                 icon: 'warning',
//                 iconColor: '#d33',
//                 showCancelButton: false,
//                 confirmButtonColor: '#3085d6',
//                 cancelButtonColor: '#d33',
//                 confirmButtonText: 'Ok!'
//                 }).then((result) => {
//                 if (result.isConfirmed) {

//                 }
//                 });
//     } else{

//     var datos   = new FormData();
//     datos.append('nombre', $('#comb_quimico').val());
//     datos.append('cantidad_entrada', $('#comb_cantidadq').val());
//     // console.log(datos.get('nombre_mat_prima'));
//     // console.log(datos.get(number('cantidad').toFixed(2)));
//     Swal.fire({
//                 title: '¿Los datos son correctos?',
//                 html: 'Químico: <b>' + datos.get('nombre') + '</b> <br>Cantidad: <b>' + datos.get('cantidad_entrada') + ' Kg </b>',
//                 icon: 'warning',
//                 showCancelButton: true,
//                 confirmButtonColor: '#3085d6',
//                 cancelButtonColor: '#d33',
//                 confirmButtonText: 'Si',
//                 cancelButtonText: 'No',
//     }).then((result) => {

//     if (result.isConfirmed) {

//         $.ajax({
//                 type:"POST",
//                 url:"modelo_insertq.php?accion=insertarq",
//                 data: datos,
//                 processData:false,
//                 contentType:false,
//         success:function(data){

//                     consultar();
//                     limpiarCamposQ();

//                     Swal.fire(
//                                 '¡Agregado!',
//                                 'Materia Prima Agregado con Exito !',
//                                 'success'
//                             )
//                     }

//             })
//         } else if (
//     /* Read more about handling dismissals below */
//     result.dismiss === Swal.DismissReason.cancel
//   ) {

//   }
//     });
//     }
// }