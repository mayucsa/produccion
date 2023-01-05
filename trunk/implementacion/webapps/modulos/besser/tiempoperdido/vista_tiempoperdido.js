function consultar(){
        var table;
        $(document).ready(function() {
        table = $('#tablaTPBesser').DataTable( {
            // "dom": 'Bfrtip',
            // "buttons": [
            //      {"extend": 'excel',"text": '<i class="far fa-file-excel"> Exportar en Excel</i>', "title": 'Producción Morteros'}, 
            //      {"extend": 'pdf', "text": '<i class="far fa-file-pdf"> Exportar en PDF</i>', "title": 'Producción Morteros'}, 
            //      {"extend": 'print', "text": '<i class="fas fa-print"> Imprimir</i>', "title": 'Producción Morteros'},
            //      "pageLength",
            // ],
            "processing": true,
            "serverSide": true,
            "ajax": "serverSideTPBesser.php",
            "lengthMenu": [[15, 30, 50, 100], [15, 30, 50, 100]],
            "pageLength": 15,
            "order": [0, 'desc'],
            // "destroy": true,
            "searching": true,
            // bSort: false,
            // "paging": false,
            // "searching": false,
            "bDestroy": true,
            "columnDefs":[
                            {
                                "targets": [1, 2, 3, 4, 5, 6, 7, 8],
                                "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
                            },
                            // {
                            //     "targets": 0,
                            //     "render": function (data, type, row, meta) {
                            //         return row[7];
                            //     }
                            // },
                            // {
                            //     "targets": 1,
                            //     "render": function (data, type, row, meta) {
                            //         return row[8];
                            //     }
                            // },
                            {
                                "targets": 7,
                                "render": function(data, type, row, meta){
                                    // const primaryKey = data;
                                    // "data": 'cve_entrada',
                                    // if (row[8] >=  '05:00:00' + 'AND' + row[8] <= '07:00:00') {
                                    if (row[7] >=  '01:00:00', row[7] <= '09:00:00'){
                                        return '<span class= "badge badge-success">3er Turno</span>';
                                        // return row[4] - 1;
                                    } if (row[7] >=  '09:00:01', row[7] <= '18:00:00'){
                                        return '<span class= "badge badge-success">1er Turno</span>';
                                    } if (row[7] >=  '18:00:01', row[7] <= '23:59:59'){
                                         return '<span class= "badge badge-success">2do Turno</span>';
                                    }
                                }
                            },
                            // {
                            //     "targets": 7,
                            //     "render": function(data, type, row, meta){
                            //         return  '<span class= "btn btn-warning" onclick= "obtenerDatosEdit('+row[0]+')" title="Editar" data-toggle="modal" data-target="#modalEditar" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> </span>' + ' ' + 
                            //                 '<span class= "btn btn-danger" onclick= "obtenerDatosE('+row[0]+')" title="Eliminar" data-toggle="modal" data-target="#modalEliminar" data-whatever="@getbootstrap"><i class="fas fa-trash-alt"></i> </span>';
                            //     }
                            // }
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
}

function consult(){
        var table;
        $(document).ready(function() {
        table = $('#tablaTPBesser').DataTable( {
            // "dom": 'Bfrtip',
            // "buttons": [
            //      {"extend": 'excel',"text": '<i class="far fa-file-excel"> Exportar en Excel</i>', "title": 'Producción Morteros'}, 
            //      {"extend": 'pdf', "text": '<i class="far fa-file-pdf"> Exportar en PDF</i>', "title": 'Producción Morteros'}, 
            //      {"extend": 'print', "text": '<i class="fas fa-print"> Imprimir</i>', "title": 'Producción Morteros'},
            //      "pageLength",
            // ],
            "processing": true,
            "serverSide": true,
            "ajax": "serverSideTPBesser.php",
            "lengthMenu": [[15, 30, 50, 100], [15, 30, 50, 100]],
            "pageLength": 15,
            "order": [4, 'desc'],
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
                                "targets": 0,
                                "render": function (data, type, row, meta) {
                                    return row[7];
                                }
                            },
                            {
                                "targets": 1,
                                "render": function (data, type, row, meta) {
                                    return row[8];
                                }
                            },
                            {
                                "targets": 5,
                                "render": function(data, type, row, meta){
                                    // const primaryKey = data;
                                    // "data": 'cve_entrada',
                                    // if (row[8] >=  '05:00:00' + 'AND' + row[8] <= '07:00:00') {
                                    if (row[6] >=  '01:00:00', row[6] <= '09:00:00'){
                                        return '<span class= "badge badge-success">3er Turno</span>';
                                        // return row[4] - 1;
                                    } if (row[6] >=  '09:00:01', row[6] <= '18:00:00'){
                                        return '<span class= "badge badge-success">1er Turno</span>';
                                    } if (row[6] >=  '18:00:01', row[6] <= '23:59:59'){
                                         return '<span class= "badge badge-success">2do Turno</span>';
                                    }
                                }
                            },
                            {
                                "targets": 6,
                                "render": function(data, type, row, meta){
                                    // const primaryKey = data;
                                    // "data": 'cve_entrada',
                                    return  '<span class= "btn btn-warning" onclick= "sinacceso()" title="Editar"><i class="fas fa-edit"></i> </span>' + ' ' + 
                                            '<span class= "btn btn-danger" onclick= "sinacceso()" title="Baja de máquina"><i class="fas fa-arrow-circle-down"></i> </span>';
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
        $("#iptPresentacion").keyup(function(){
            table.column($(this).data('index')).search(this.value).draw();
            })
        $("#iptFecha").keyup(function(){
            table.column($(this).data('index')).search(this.value).draw();
            })
}

function obtenerDatosEdit(cve_tp) {
    $.getJSON("modelo_tiempoperdido.php?consultar="+cve_tp, function(registros){
        // console.log(registros);

        $('#inputidedit').val(registros[0]['cve_tp']);
        $('#selectmaquinaedit').val(registros[0]['cve_maq']);
        $('#selectfalloedit').val(registros[0]['cve_fallo']);
        $('#inputmotivoedit').val(registros[0]['motivo_fallo']);
        $('#inputhorainicioedit').val(registros[0]['hora_inicio']);
        $('#inputhorafinedit').val(registros[0]['hora_fin']);
    });
}

function obtenerDatosE(cve_tp) {
    $.getJSON("modelo_tiempoperdido.php?consultarDelete="+cve_tp, function(registros){
        console.log(registros);

        $('#inputide').val(registros[0]['cve']);
        $('#inputmaqe').val(registros[0]['maquina']);
        $('#inputfalloe').val(registros[0]['fallo']);
    });
}

function limpiarCampos() {
    $('#selectmaquina').val("0");
    $('#selectfallo').val("0");
    $('#inputmotivo').val("");
    $('#inputhorainicio').val("");
    $('#inputhorafin').val("");
}

function sinacceso(){

    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
}

function validacion() {
    var maquina    = $('#selectmaquina').val();
    var fallo    = $('#selectfallo').val();
    var motivo    = $('#inputmotivo').val();
    var inicio    = $('#inputhorainicio').val();
    var fin    = $('#inputhorafin').val();
    var msj = "";

    if (maquina == 0) {
        msj += '<li>Máquina</li>';
    }   
    if (fallo == 0) {
        msj += '<li>Fallo</li>';
    }   
    if (motivo == "") {
        msj += '<li>Motivo de fallo</li>';
    }   
    if (inicio == "") {
        msj += '<li>Hora de inicio</li>';
    }   
    if (fin == "") {
        msj += '<li>Hora fin</li>';
    }   
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');

    } else{
        capturaTiempoPerdido();
    }
}

function capturaTiempoPerdido(){
    var datos = new FormData();
    var textmaquina    = $('#selectmaquina').find('option:selected').text()
    var textfallo    = $('#selectfallo').find('option:selected').text()

    datos.append('maquina',     $('#selectmaquina').val());
    datos.append('fallo',       $('#selectfallo').val());
    datos.append('motivo',      $('#inputmotivo').val());
    datos.append('horainicio',  $('#inputhorainicio').val());
    datos.append('horafin',     $('#inputhorafin').val());

    datos.append('usuario',         $('#spanuser').text());

    console.log(datos.get('maquina'));
    console.log(datos.get('fallo'));
    console.log(datos.get('motivo'));
    console.log(datos.get('horainicio'));
    console.log(datos.get('horafin'));

    console.log(datos.get('usuario'));


    Swal.fire({
                title: '¿Los datos son correctos?',
                html: 'Maquina: <b>' +  textmaquina + 
                '</b><br> Fallo: <b>' + textfallo,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
    }).then((result) => {

    if (result.isConfirmed) {
        jsShowWindowLoad('Capturando tiempo perdido...');
        $.ajax({
                type:"POST",
                url:"modelo_tiempoperdido.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){

                    consultar();
                    limpiarCampos();
                    jsRemoveWindowLoad();
                    // cerrarModal();
                    // $('#myLoadingGral').modal('show');
                    Swal.fire(
                                '¡Tiempo pérdido!',
                                'Se ha capturado el tiempo pérdido exitosamente !',
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

function cerrarModalEliminar(){
    $('#modalEliminar').modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
}

function cerrarModalEditar(){
    $('#modalEditar').modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
}

function editarTP(){
    var maquina         = $('#selectmaquinaedit').val();
    var fallo    = $('#selectfalloedit').val();  
    var motivo      = $('#inputmotivoedit').val();
    var horainicio          = $('#inputhorainicioedit').val(); 
    var horafin    = $('#inputhorafinedit').val();

    var msj = "";
   
    if (maquina == 0) {
        // console.log(cantidad);
        msj += 'Máquina <br>';
    }
    if (fallo == 0) {
        // console.log(cantidad);
        msj += 'Fallo <br>';
    }
    if (motivo == "") {
        // console.log(cantidad);
        msj += 'Motivo <br>';
    }
    if (horainicio == "") {
        // console.log(cantidad);
        msj += 'Hora inicio <br>';
    }
    if (horafin == "") {
        // console.log(cantidad);
        msj += 'Hora fin <br>';
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
    datos.append('cve_tp',      $('#inputidedit').val());
    datos.append('maquina',     $('#selectmaquinaedit').val());
    datos.append('fallo',       $('#selectfalloedit').val());
    datos.append('motivo',      $('#inputmotivoedit').val());
    datos.append('horainicio',  $('#inputhorainicioedit').val());
    datos.append('horafin',     $('#inputhorafinedit').val());

    datos.append('usuario',     $('#spanusuario').text());

    console.log(datos.get('cve_tp'));
    console.log(datos.get('maquina'));
    console.log(datos.get('fallo'));
    console.log(datos.get('motivo'));
    console.log(datos.get('horainicio'));
    console.log(datos.get('horafin'));
    console.log(datos.get('usuario'));


        Swal.fire({
                title: '¿Estas seguro de editar el folio #'+ datos.get('cve_tp')+ '?',
                // html: 'Nombre: <b>' + datos.get('nombre_articulo'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
    }).then((result) => {

    if (result.isConfirmed) {
        jsShowWindowLoad('Editando tiempo perdido...');
        $.ajax({
                type:"POST",
                url:"modelo_tiempoperdido.php?actualizar=1",
                data: datos,
                processData:false,
                contentType:false,
        success:function(r){
            // console.log(r);
            consultar();
            cerrarModalEditar();
            jsRemoveWindowLoad();
                    Swal.fire(
                                '¡Edición!',
                                'Se ha editado el tiempo pérdido exitosamente',
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

function eliminarTP(){
    var datos   = new FormData();
    datos.append('cve_tpe',     $('#inputide').val());
    datos.append('maquinae',    $('#inputmaqe').val());
    datos.append('falloe',      $('#inputfalloe').val());
    datos.append('usuarioe',    $('#spanusuarioe').text());
    console.log(datos.get('cve_tpe'));
    console.log(datos.get('maquinae'));
    console.log(datos.get('falloe'));
    console.log(datos.get('usuarioe'));
        Swal.fire({
                title: '¿Estas seguro de eliminar el folio #'+ datos.get('cve_tpe')+'?',
                // html: 'Folio: <b>' + datos.get('cve_tpe'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
    }).then((result) => {

    if (result.isConfirmed) {
        jsShowWindowLoad('Eliminando tiempo perdido...');
        $.ajax({
                type:"POST",
                url:"modelo_tiempoperdido.php?eliminar=1",
                data: datos,
                processData:false,
                contentType:false,
        success:function(r){
            // console.log(r);
            consultar();
            cerrarModalEliminar();
            jsRemoveWindowLoad();
                    Swal.fire(
                                '¡Eliminación!',
                                'Se ha elimnado el tiempo pérdido exitosamente',
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
    // }
}