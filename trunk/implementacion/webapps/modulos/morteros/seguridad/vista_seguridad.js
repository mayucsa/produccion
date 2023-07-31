function consultar(){
        var table;
        $(document).ready(function() {
        table = $('#tablaMPproducto').DataTable( {
            // "dom": 'Bfrtip',
            // "buttons": [
            //      {"extend": 'excel',"text": '<i class="far fa-file-excel"> Exportar en Excel</i>', "title": 'Producción Morteros'}, 
            //      {"extend": 'pdf', "text": '<i class="far fa-file-pdf"> Exportar en PDF</i>', "title": 'Producción Morteros'}, 
            //      {"extend": 'print', "text": '<i class="fas fa-print"> Imprimir</i>', "title": 'Producción Morteros'},
            //      "pageLength",
            // ],
            "processing": true,
            "serverSide": true,
            "ajax": "serverSidempproducto.php",
            "lengthMenu": [[25, 40, 50, 100], [25, 40, 50, 100]],
            "pageLength": 25,
            "order": [0, 'asc'],
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
                                "targets": 2,
                                "render": function(data, type, row, meta){
                                    // const primaryKey = data;
                                    // "data": 'cve_entrada',
                                    if (row[2] == 'VIG') {
                                        return '<span class= "badge badge-success">Activo</span>';
                                    }else{
                                        return '<span class= "badge badge-danger">Inactivo</span>';
                                    }
                                }
                            },
                            {
                                "targets": 3,
                                "render": function(data, type, row, meta){
                                    // const primaryKey = data;
                                    // "data": 'cve_entrada',
                                    return  '<span class= "btn btn-info" onclick= "obtenerDatos('+row[0]+')" title="Ver" data-toggle="modal" data-target="#modalVerMP" data-whatever="@getbootstrap"><i class="fas fa-eye"></i> </span>' + ' ' + 
                                            '<span class= "btn btn-warning" title="Materia Primas" data-toggle="modal" data-target="#modalDeleteProduccion" data-whatever="@getbootstrap"><i class="fas fa-pen-square"></i> </span>' + ' ' + 
                                            '<span class= "btn btn-danger" title="Dar de baja" data-toggle="modal" data-target="#modalDeleteProduccion" data-whatever="@getbootstrap"><i class="fas fa-trash-alt"></i> </span>';
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
        // $("#iptPresentacion").keyup(function(){
        //     table.column($(this).data('index')).search(this.value).draw();
        //     })
        // $("#iptFecha").keyup(function(){
        //     table.column($(this).data('index')).search(this.value).draw();
        //     })
}

function obtenerDatos(cve_producto) {
    jsShowWindowLoad('Obteniendo materia prima...');
    $.getJSON("modelo_seguridad.php?consultar="+cve_producto, function(registros){
        console.log(registros, cve_producto);
        $('#cve_productoEdit').val(cve_producto);

        // var txt = 'Materia Prima ->';
        // var input = $('#inputcantidad').val();

        $('#inputname').val(registros[0]['Producto']);
        // $('#comb_mat_primau').val(registros[0]['nombre']);
        // $('#comb_cantidadu').val(registros[0]['cantidad_entrada']);

        $("#tablaModal").html( '<thead> <tr>  <th class="text-center">Materia Prima</th>' +
                                                '<th class="text-center">Cantidad</th>'+
                                                '<th class="text-center">Acciones</th></tr>'+
                                    '</thead>');

        for (i = 0; i < registros.length; i++){
        // txt += $('#inputcantidad').val(registros[i]['Cantidad']);
        // $('#inputmp').text(registros[i]['MateriaPrima']) + $('#inputcantidad').val(registros[i]['Cantidad']);
         $("#tablaModal").append('<tr>' + 
            '<td style="dislay: none;">' + registros[i].MateriaPrima + '</td>'+
            '<td align="center" style="dislay: none;">'+
                '<input type="number" id="cantidad_'+i+'" value="'+ registros[i].Cantidad +'" step=".0001" class="form-control">'+
            '</td>'+
            '<td style="dislay: none; text-align:center; width:25%">'+
                '<input type="button" value="Editar" class="btn btn-warning mr-2" onclick="editarMPrima('+i+', \''+registros[i].cve_materia_prima+'\', \''+cve_producto+'\')">'+
                '<input type="button" value="Eliminar" class="btn btn-danger" onclick="eliminamPrima(\''+registros[i].cve_materia_prima+'\', \''+cve_producto+'\')">'
            +'</td></tr>');
        }
        jsRemoveWindowLoad();

    });
}
function eliminamPrima(cve_materia_prima, cve_producto){
    jsShowWindowLoad('Eliminando materia prima...');
    var url = "modelo_seguridad.php?eliminamPrima=delete";
    url += "&cve_materia_prima="+cve_materia_prima;
    url += "&cve_producto="+cve_producto;
    $.getJSON(url, function(respuesta){
        console.log('respuesta', respuesta);
        jsRemoveWindowLoad();
        if (respuesta == true) {
            Swal.fire(
                '¡Eliminado!',
                'Materia prima eliminada del producto',
                'success'
            )
        }else{
            Swal.fire(
                '¡Error!',
                'No se pudo eliminar',
                'error'
            )
        }
        obtenerDatos($('#cve_productoEdit').val());
    });
}
function editarMPrima(i, cve_materia_prima, cve_producto){
    const cantidad = $('#cantidad_'+i).val();
    jsShowWindowLoad('Actualizando...');
    var url = "modelo_seguridad.php?editarMPrima=update";
    url += "&cantidad="+cantidad;
    url += "&cve_materia_prima="+cve_materia_prima;
    url += "&cve_producto="+cve_producto;
    $.getJSON(url, function(respuesta){
        console.log('respuesta', respuesta);
        jsRemoveWindowLoad();
        if (respuesta == true) {
            Swal.fire(
                '¡Actualizado!',
                'Cantidad de materia prima actualizada',
                'success'
            )
        }else{
            Swal.fire(
                '¡Error!',
                'No se pudo actualizar',
                'error'
            )
        }
    });
}
function limpiarCampos() {
    $('#inputnameproducto').val("");
    $('#selectpresentacion').val("0");
    $('#selecttonelada').val("0");
    $('#selectcodsaco').val("0");
}

function validacionCampos() {
    var producto = $('#inputnameproducto').val();
    var presentacion = $('#selectpresentacion').val();
    var tonelada = $('#selecttonelada').val();
    var sacos = $('#selectcodsaco').val();
    var msj = "";
  
    if (producto == "") {
        msj += '<li>Nombre de Producto</li>';
    }
    if (presentacion == 0) {
        msj += '<li>Presentación</li>';
    }
    if (tonelada == 0) {
        msj += '<li>Tonelada</li>';
    }
    if (sacos == 0) {
        msj += '<li>Saco que utiliza</li>';
    }
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');

    } else{
        insertCaptura();
    }
}

function existenciaProducto(){
    var producto = $('#inputnameproducto').val();
    var msj = "";

    var datos   = new FormData();

    datos.append('producto', $('#inputnameproducto').val());

        $.ajax({
                type:"POST",
                url:"modelo_seguridad.php?accion=consultarProducto&producto=" + producto,
                data: producto,
                processData:false,
                contentType:false,
        success:function(data){

                    if (data == 'correcto') {
                        // validacionCampos();
                    insertCaptura();

                    }else{
                        Swal.fire({
                                        icon: 'info',
                                        // iconColor: '#FF0000',
                                        title: '¡Error!',
                                        text: 'El producto Existente',
                                        footer: 'Revisar el catalogo de productos',
                                        confirmButtonColor: '#1A4672'
                                    })
                        }
                    }


            })
}

function insertCaptura() {
    var datos   = new FormData();
    var mgs = "";
    var mgsp = "";
    var producto = $('#inputnameproducto').val();
    var presentacion = $('#selectpresentacion').val();
    var tonelada = $('#selecttonelada').val();
    var sacos = $('#selectcodsaco').val();

    datos.append('producto', $('#inputnameproducto').val());
    datos.append('presentacion', $('#selectpresentacion').val());
    datos.append('tonelada', $('#selecttonelada').val());
    datos.append('sacos', $('#selectcodsaco').val());
    datos.append('user',            $('#spanuser').text());

    console.log(datos.get('producto'));
    console.log(datos.get('presentacion'));
    console.log(datos.get('tonelada'));
    console.log(datos.get('sacos'));
    console.log(datos.get('user'));

    Swal.fire({
                title: '¿Los datos son correctos?',
                html:   'Producto: <b>' + datos.get('producto') + 
                        '</b><br> Presentacion: <b>' + datos.get('presentacion'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Agregar',
    }).then((result) => {

    if (result.isConfirmed) {    

        $.ajax({
                type:"POST",
                url:"modelo_seguridad.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){
            // $('#myLoading').modal('show');
                    // mostrar();
                    consultar();
                    limpiarCampos();
                    // consultarDatos();
                    // cerrarModal();
                    // $('#modalMatPrima').modal('hide');
                    Swal.fire(
                                '¡Agregado!',
                                'Usted ha ingresado un nuevo producto !!',
                                'success'
                            )
                    }

            })
        }
    });
    // }
}