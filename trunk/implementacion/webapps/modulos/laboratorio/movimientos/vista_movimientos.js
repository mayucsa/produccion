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

function limpiarModal() {
    $('#comb_concentrado').val("[Selecciones un opción..]");
    $('#comb_cantidadc').val("");    
}
function limpiarModalD() {
    $('#comb_concentradod').val("[Selecciones un opción..]");
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
                    // mostrar();
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
                    // mostrar();
                    consultarDevolucion();
                    limpiarModalD();
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