function consultarEstiba(){
    $(document).ready(function() {
    $('#tablaEstibas').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSideEstibas.php",
        "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        "order": [4, 'asc'],
        // "destroy": true,
        "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": false,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [1, 2, 3, 4, 5, 6],
                            "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
                        },
                        {
                            "targets": 6,
                            "render": function(data, type, row, meta){
                                // const primaryKey = data;
                                // "data": 'cve_entrada',
                                return '<span class= "btn btn-danger" onclick= "obtenerDatosEstiba('+row[7]+')" data-toggle="modal" data-target="#modalEstiba"><i class="fas fa-unlink"></i> </span>';
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

function consultar(){
    $(document).ready(function() {
    $('#tablaEstibas').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSideEstibas.php",
        "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        "order": [4, 'asc'],
        // "destroy": true,
        "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": false,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [1, 2, 3, 4, 5, 6],
                            "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
                        },
                        {
                            "targets": 6,
                            "render": function(data, type, row, meta){
                                // const primaryKey = data;
                                // "data": 'cve_entrada',
                                return '<span class= "btn btn-danger" onclick="sinacceso()"><i class="fas fa-unlink"></i> </span>';
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

function sinacceso(){

    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
}

function obtenerDatosEstiba(cve_estiba){
    $.getJSON("modelo_estiba.php?consultar="+cve_estiba, function(registros){
        // console.log(registros);

        $('#comb_ide').val(registros[0]['cve_estiba']);
        $('#comb_areae').val(registros[0]['area']);
        $('#comb_productoe').val(registros[0]['nombre_producto']);
        $('#comb_presente').val(registros[0]['presentacion']);
        $('#input_celdase').val(registros[0]['num_celdas']);
        $('#input_estibae').val(registros[0]['numero_estiba']);
        $('#input_cantidade').val(registros[0]['cantidad_estiba']);
        // $('#input_canttotalc').val(registros[0]['cantidad_total']);
        // $('#input_cantroturac').val(registros[0]['cantidad_rotura']);
        // $('#input_cantdespuntadosc').val(registros[0]['cantidad_despuntados']);
    });
}

function limpiarCamposEstiba() {
    $('#comb_areae').val("0");
    $('#comb_productoe').val("0");
    $('#comb_presente').val("0");
    $('#input_celdase').val("0");
    $('#input_estibae').val("");
    $('#input_cantidade').val("");
    $('#input_roturae').val("");
}


function RoturaDiaria(cve_estiba) {
    // var select = $('#comb_quimico').val();
    var rotura = $('#input_roturae').val();
    var msj = "";
  
    if (rotura == "") {
        msj += 'Rotura del día <br>';
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
                    // Swal.fire(
                    // 'Deleted!',
                    // 'Your file has been deleted.',
                    // 'success'
                    // )
                }
                });
    } else{
    var datos   = new FormData();
    datos.append('cve_estiba',      $('#comb_ide').val());
    datos.append('area',            $('#comb_areae').val());
    datos.append('nombre_producto', $('#comb_productoe').val());
    datos.append('presentacion',    $('#comb_presente').val());
    datos.append('celdas',          $('#input_celdase').val());
    datos.append('estiba',          $('#input_estibae').val());
    datos.append('cantidad',        $('#input_cantidade').val());
    datos.append('rotura',          $('#input_roturae').val());
    datos.append('user',            $('#spanuser').text());

    // console.log(datos.get('cve_estiba'));
    // console.log(datos.get('area'));
    // console.log(datos.get('nombre_producto'));
    // console.log(datos.get('presentacion'));
    // console.log(datos.get('celdas'));    
    // console.log(datos.get('estiba'));
    // console.log(datos.get('cantidad'));
    // console.log(datos.get('rotura'));
    // console.log(datos.get('user'));
        Swal.fire({
                title: '¿Los datos son correctos?',
                html: 'Estiba: <b>' + datos.get('estiba') +
                '</b><br> Cantidad de rotura: <b>' + datos.get('rotura'),
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
                url:"modelo_estiba.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(r){
            // console.log(r);
            // mostrar();
            // consultar();
            consultarEstiba();
            limpiarCamposEstiba();
            // limpiarCamposReproceso();
            
                    Swal.fire(
                                'Rotura díaria!',
                                'Rotura realizado con Exito !',
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