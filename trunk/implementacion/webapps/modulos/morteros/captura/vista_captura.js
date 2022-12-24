function consultar(){
        var table;
        $(document).ready(function() {
        table = $('#tablaCapturap').DataTable( {
            // "dom": 'Bfrtip',
            // "buttons": [
            //      {"extend": 'excel',"text": '<i class="far fa-file-excel"> Exportar en Excel</i>', "title": 'Producción Morteros'}, 
            //      {"extend": 'pdf', "text": '<i class="far fa-file-pdf"> Exportar en PDF</i>', "title": 'Producción Morteros'}, 
            //      {"extend": 'print', "text": '<i class="fas fa-print"> Imprimir</i>', "title": 'Producción Morteros'},
            //      "pageLength",
            // ],
            "processing": true,
            "serverSide": true,
            "ajax": "serverSideproduccion.php",
            "lengthMenu": [[15, 30, 50, 100], [15, 30, 50, 100]],
            "pageLength": 15,
            "order": [5, 'desc'],
            // "destroy": true,
            "searching": true,
            // bSort: false,
            // "paging": true,
            // "searching": false,
            "bDestroy": true,
            "columnDefs":[
                            {
                                "targets": [1, 2, 3, 4, 5, 6],
                                "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
                            },
                            {
                                "targets": 1,
                                "render": function (data, type, row, meta) {
                                    return row[1] + ' - ' + row[6] + 'KG';
                                }
                            },
                            {
                                "targets": 6,
                                "render": function(data, type, row, meta){

                                    return row[7];
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
        $("#iptPresentacion").keyup(function(){
            table.column($(this).data('index')).search(this.value).draw();
            })
        $("#iptFecha").keyup(function(){
            table.column($(this).data('index')).search(this.value).draw();
            })
}

function consult(){
        var table;
        $(document).ready(function() {
        table = $('#tablaCapturap').DataTable( {
            "dom": 'Bfrtip',
            "buttons": [
                 {"extend": 'excel',"text": '<i class="far fa-file-excel"> Exportar en Excel</i>', "title": 'Producción Morteros'}, 
                 {"extend": 'pdf', "text": '<i class="far fa-file-pdf"> Exportar en PDF</i>', "title": 'Producción Morteros'}, 
                 {"extend": 'print', "text": '<i class="fas fa-print"> Imprimir</i>', "title": 'Producción Morteros'},
                 "pageLength",
            ],
            "processing": true,
            "serverSide": true,
            "ajax": "serverSideproduccion.php",
            "lengthMenu": [[15, 30, 50, 100], [15, 30, 50, 100]],
            "pageLength": 15,
            "order": [5, 'desc'],
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

                                    return '<span class= "btn btn-danger" onclick="sinacceso()" title="Eliminar"><i class="fas fa-trash-alt"></i> </span>';
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
        $("#iptPresentacion").keyup(function(){
            table.column($(this).data('index')).search(this.value).draw();
            })
        $("#iptFecha").keyup(function(){
            table.column($(this).data('index')).search(this.value).draw();
            })
}

function obtenerDatos(cve_captura) {
    $.getJSON("modelo_captura.php?obtenerDatos="+cve_captura, function(registros){
        console.log(registros);

        $('#comb_id').val(registros[0]['cve_captura']);
        $('#comb_nombre').val(registros[0]['cve_producto']);
        $('#comb_presentacion').val(registros[0]['valor_presentacion']);
        $('#comb_kg').val(registros[0]['kg_real']);
        $('#comb_sacos').val(registros[0]['sacos_totales']);
    });
}

function cerrarModal(){
    $('#modalDeleteProduccion').modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
}

function eliminarCaptura(){
    var datos   = new FormData();
    var mgs = "";
    var producto        = $('#comb_nombre').val();
    var presentacion    = $('#comb_presentacion').val();
    var cantidad        = $('#comb_kg').val();
    // var cantidad    = $('#selectproducto').find('option:selected').text()

    datos.append('producto', $('#comb_id').val());
    datos.append('user',    $('#spanuser').text());

    console.log(datos.get('producto'));
    console.log(datos.get('user'));
    // console.log($(this).data(nombre));
    // console.log(datos.get('tonelada'));
    // console.log(datos.get('presentacion'));
    // console.log(datos.get('numbarcada'));
    // console.log(datos.get('kgformula'));
    // console.log(datos.get('kgreal'));
    // console.log(datos.get('diferencia'));
    // console.log(datos.get('sacousado'));
    // console.log(datos.get('sacoroto'));
    // console.log(datos.get('sacototal'));

    Swal.fire({
                title: '¿Los datos son correctos?',
                html:   'Producto: <b>' + producto + 
                        '</b><br> Presentación: <b>' + presentacion +
                        '</b><br> Cantidad: <b>' + cantidad,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Eliminar',
    }).then((result) => {

    if (result.isConfirmed) {    
        jsShowWindowLoad('Capturando producción...');
        $.ajax({
                type:"POST",
                url:"modelo_captura.php?accion=eliminarCaptura",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){
            // $('#myLoading').modal('show');
                    // mostrar();
            // console.log(datos);
                    jsRemoveWindowLoad();
                    // location.reload();
                    consultar();
                    // limpiarCampos();
                    // consultarDatos();
                    cerrarModal();
                    Swal.fire({
                                    icon: 'info',
                                    iconColor: '#FF0000',
                                    title: '¡Éxito!',
                                    text: 'Usted ha eliminado la producción',
                                    // footer: 'Revisar las existencias de Tarimas',
                                    confirmButtonColor: '#1A4672'
                                })

                    }

            })
        }
    });

}
function eliminarCap(cve_captura){
        $.getJSON("modelo_captura.php?obtenerDatos="+cve_captura, function(registros){
            console.log(registros);

            cve_producto = registros[0]['cve_producto'];
            console.log(cve_producto);

        });

        Swal.fire({
          title: 'Eliminar Produccion',
          html: '¿Realmente deseas eliminar la produccion con folio: <b>'+cve_captura+'</b>?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Eliminar',
          cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            jsShowWindowLoad('Eliminando producción...');
            $.ajax({
                type:"POST",
                url:"modelo_captura.php?accion=eliminarCaptura",
                data: cve_captura,
                processData:false,
                contentType:false,
                success:function(data){
                    jsRemoveWindowLoad();
                    consultar();
                    Swal.fire(
                        '¡Éxito!',
                        'Se elimino la produccion',
                        'success'
                    )
                }
            })
        }
      });
}

function selectTonelada(){
	var cve_producto = $("#selectproducto").val();
	$.ajax({
		type: "POST",
		url: "selectoption2.php",
		// method: "POST",
		data: {
			"cve_producto":cve_producto
		},
		success:function(r){
			// console.log(r);
			// $("#spantonelada").html(r);
			$("#spantonelada").attr("disabled", true);
			$("#spantonelada").html(r);
			
		}
	})

}
function selectProducto(){
	var cve_producto = $("#selectproducto").val();
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
			selectTonelada();
			$("#selectpresentacion").attr("disabled", false);
			$("#selectpresentacion").html(r);

		}
	})

}
function selectProduct(){
    var cve_producto = $("#selectproduct").val();
    $.ajax({
        type: "POST",
        url: "selectopt.php",
        // method: "POST",
        data: {
            "cve_producto":cve_producto
        },
        success:function(r){
            // console.log(r);
            // $("#spantonelada").html(r);
            selectTonelada();
            $("#selectpresent").attr("disabled", false);
            $("#selectpresent").html(r);

        }
    })

}
function limpiarCampos() {
    $('#selectproducto').val("0");
    $('#spantonelada').text("");
    $("#selectpresentacion").attr("disabled", true);
    $('#selectpresentacion').val("0");
    $('#inputtarimas').val("");
    $('#inputbarcadas').val("");
    $('#spTotal').text("");
    $('#inputkgreal').val("");
    $('#spDiferencia').text("");
    $('#spSacosUsados').text("");
    $('#inputSacoRotos').val("");
    $('#spSacoTotal').text("");
    
}

function limpiarCamposReproceso() {
    $('#selectproduct').val("0");
    $("#selectpresent").attr("disabled", true);
    $('#selectpresent').val("0");
    $('#inputingrer').val("");
    $('#inputkgrealr').val("");
    $('#inputSacoRotosr').val("");
    $('#spDiferenciar').text("");
    $('#spSacosUsadosr').text("");
    $('#spSacoTotalr').text("");  
    
}

function limpiarCriterios(){
    $('#iptNombre').val("");
    $('#iptPresentacion').val("");
}

function sinacceso(){

    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
}

function validacionCampos() {
    var producto = $('#selectproducto').val();
    var tarimas = $('#inputtarimas').val();
    var barcadas = $('#inputbarcadas').val();
    var kgreal = $('#inputkgreal').val();
    var sacoroto = $('#inputSacoRotos').val();
    var msj = "";
  
    if (producto == 0) {
        msj += '<li>Producto</li>';
    }
    if (barcadas == "") {
        msj += '<li>Número de barcadas</li>';
    }
    if (kgreal == "") {
        msj += '<li>KG Real</li>';
    }
    if (sacoroto == "") {
        msj += '<li>Cantidad de Sacos Rotos</li>';
    }
    if (tarimas == "") {
        msj += '<li>Tarimas</li>';
    }
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');

    } else{
        existenciaTarimas();
    }
}

function existenciaTarimas(){
    var tarimas = $('#inputtarimas').val();
    var msj = "";

    var datos   = new FormData();

    datos.append('tarimas', $('#inputtarimas').val());

        $.ajax({
                type:"POST",
                url:"modelo_captura.php?accion=consultar&tarimas=" + tarimas,
                data: tarimas,
                processData:false,
                contentType:false,
        success:function(data){

                    // console.log(data);
                    // $('#myLoading').modal('show');
                    // mostrar();
                    // consultar();
                    // limpiarCampos();
                    // consultarDatos();
                    // cerrarModal();
                    // $('#modalMatPrima').modal('hide');
                    if (data == 'correcto') {
                        // validacionCampos();
                    insertCaptura();

                    }else{
                        Swal.fire({
                                        icon: 'info',
                                        // iconColor: '#FF0000',
                                        title: '¡Error!',
                                        text: 'Sin existencia de tarimas',
                                        footer: 'Revisar las existencias de Tarimas',
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
    var producto        = $('#selectproducto').val();
    var presentacion    = $('#selectpresentacion').val();
    var textproducto    = $('#selectproducto').find('option:selected').text()

    datos.append('producto', $('#selectproducto').val());
    datos.append('tonelada', $('#spantonelada').text());
    datos.append('presentacion', $('#selectpresentacion').val());
	datos.append('numtarima', $('#inputtarimas').val());
    datos.append('numbarcada', $('#inputbarcadas').val());
    datos.append('kgformula', $('#spTotal').text());
    datos.append('kgreal', $('#inputkgreal').val());
    datos.append('diferencia', $('#spDiferencia').text());
    datos.append('sacousado', $('#spSacosUsados').text());
    datos.append('sacoroto', $('#inputSacoRotos').val());
    datos.append('sacototal', $('#spSacoTotal').text());

    datos.append('user',            $('#spanuser').text());

    // console.log(datos.get('producto'));
    // console.log($(this).data(nombre));
    // console.log(datos.get('tonelada'));
    // console.log(datos.get('presentacion'));
    // console.log(datos.get('numbarcada'));
    // console.log(datos.get('kgformula'));
    // console.log(datos.get('kgreal'));
    // console.log(datos.get('diferencia'));
    // console.log(datos.get('sacousado'));
    // console.log(datos.get('sacoroto'));
    // console.log(datos.get('sacototal'));

    Swal.fire({
                title: '¿Los datos son correctos?',
                html:   'Producto: <b>' + textproducto + 
                        '</b><br> Presentación: <b>' + datos.get('presentacion') +
                        '</b><br> Cantidad: <b>' + datos.get('kgreal'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Agregar',
    }).then((result) => {

    if (result.isConfirmed) {    
        jsShowWindowLoad('Capturando producción...');
        $.ajax({
                type:"POST",
                url:"modelo_captura.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){
            // $('#myLoading').modal('show');
                    // mostrar();
                    consultar();
                    limpiarCampos();
                    jsRemoveWindowLoad();
                    // location.reload();
                    // consultarDatos();
                    // cerrarModal();
                    // $('#modalMatPrima').modal('hide');
                    Swal.fire(
                                '¡Agregado!',
                                'Usted ha capturado su producción de manera Exitosa !!',
                                'success'
                            )
                    }

            })
        }
    });
    // }
}
function insertCapturaJS() {
   
        jsShowWindowLoad('Capturando producción...');

}

function insertReproceso() {
    var producto = $('#selectproduct').val();
    var textproducto    = $('#selectproducto').find('option:selected').text()
    var kgingre = $('#inputingrer').val();
    // var barcadas = $('#inputbarcadas').val();
    // var kgingre = $('#inputingrer').val();
    var kgreal = $('#inputkgrealr').val();
    var sacoroto = $('#inputSacoRotosr').val();
    var msj = "";
  
    if (producto == 0) {
        msj += '<li>Producto</li>';
    }
    if (kgingre == "") {
        msj += '<li>KG Ingresado</li>';
    }
    if (kgreal == "") {
        msj += '<li>KG Producido</li>';
    }
    if (sacoroto == "") {
        msj += '<li>Cantidad de Sacos Rotos</li>';
    }


    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');

    } else{

    var datos   = new FormData();
    var mgs = "";

    datos.append('productor', $('#selectproduct').val());
    datos.append('presentacionr', $('#selectpresent').val());
    datos.append('kgingrer', $('#inputingrer').val());
    datos.append('kgrealr', $('#inputkgrealr').val());
    datos.append('diferenciar', $('#spDiferenciar').text());
    datos.append('sacousador', $('#spSacosUsadosr').text());
    datos.append('sacorotor', $('#inputSacoRotosr').val());
    datos.append('sacototalr', $('#spSacoTotalr').text());

    // console.log(datos.get('productor'));
    // console.log(datos.get('presentacionr'));
    // console.log(datos.get('kgingrer'));
    // console.log(datos.get('kgrealr'));
    // console.log(datos.get('diferenciar'));
    // console.log(datos.get('sacousador'));
    // console.log(datos.get('sacorotor'));
    // console.log(datos.get('sacototalr'));

    Swal.fire({
                title: '¡Agregar Captura!',
                html:   'Producto: <b>' + textproducto + 
                        '</b><br> Presentación: <b>' + datos.get('presentacionr'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Agregar',
    }).then((result) => {

    if (result.isConfirmed) {    

        $.ajax({
                type:"POST",
                url:"modelo_reproceso.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){
            // $('#myLoading').modal('show');
                    // mostrar();
                    consultar();
                    limpiarCamposReproceso();
                    // consultarDatos();
                    // cerrarModal();
                    // $('#modalMatPrima').modal('hide');
                    Swal.fire(
                                '¡Agregado!',
                                'Usted ha capturado su producción de manera Exitosa !!',
                                'success'
                            )
                    }

            })
        }
    });
    }
}

function nuevoAjax(){
    var xmlhttp=false;
    try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }catch(e){
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }catch(E){
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}
function enviarMail(){
       c = document.getElementById('resultado_mensaje');
       //variable=documenet.nombre_del_form.nombre_del_control.value
       emis=document.enviar_email.emisor.value;
       dest=document.enviar_email.email_destino.value;
       men=document.enviar_email.mensaje.value;
       ajax=nuevoAjax();
       c.innerHTML = '<p style="text-align:center;"><img src="esperando.gif"/></p>';
       ajax.open("POST", "envia_mail.php",true);
       ajax.onreadystatechange=function() {
       if (ajax.readyState==4) {
       c.innerHTML = ajax.responseText
       }
       borrarCampos()
       }
       ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
       ajax.send("destinatario="+dest+"&emisor="+emis+"&mensaje="+men)
}
function borrarCampos(){
       document.enviar_email.emisor.value="";
       document.enviar_email.email_destino.value="";
       document.enviar_email.mensaje.value="";
       document.enviar_email.email_destino.focus();
}