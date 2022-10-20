function consultar(){
    $(document).ready(function() {
    $('#tablaSalidaVibro').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serversidesalidas.php",
        "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        "order": [8, 'desc'],
        // "destroy": true,
        "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": false,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [1, 2, 3, 4, 5, 6, 7, 8, 9],
                            "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
                        },
                        {
                            "targets": 9,
                            "render": function(data, type, row, meta){
                                return '<span class= "btn btn-danger" onclick= "obtenerDatos('+row[10]+')" data-toggle="modal" data-target="#modalEliminar"><i class="fas fa-trash-alt"></i> </span>';
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
    $('#tablaSalidaVibro').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serversidesalidas.php",
        "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        "order": [8, 'desc'],
        // "destroy": true,
        "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": false,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [1, 2, 3, 4, 5, 6, 7, 8, 9],
                            "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
                        },
                        {
                            "targets": 9,
                            "render": function(data, type, row, meta){
                                return '<span class= "btn btn-danger" onclick= "sinacceso()"><i class="fas fa-trash-alt"></i> </span>';
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

function selectProducto(){
	var cve_pbloquera = $("#selectproducto").val();
    // var arreglo_datos = [];
	$.ajax({
		type: "POST",
		url: "selectproducto.php",
		// method: "POST",
		data: {
			"cve_pbloquera":cve_pbloquera
		},
		success:function(r){
			$("#selectpresentacion").attr("disabled", false);
            $("#selectpresentacion").html(r);
		}
	})
}

function selectProductoBesser(){
    var cve_pbloquera = $("#selectproductob").val();
    $.ajax({
        type: "POST",
        url: "selectoption.php",
        // method: "POST",
        data: {
            "cve_pbloquera":cve_pbloquera
        },
        success:function(r){
            // console.log(r);
            // $("#spantonelada").html(r);
            // selectTonelada();
            $("#selectpresentacionb").attr("disabled", false);
            // $('#selectpresentacionb').val("Seleccione");
            $("#selectpresentacionb").html(r);

        }
    })

}

function selectPresentacion(){
    var cve_pbloquera = $("#selectproducto").val();
    var cve_presentacionb = $("#selectpresentacion").val();
    $.ajax({
        type: "POST",
        url: "selectestiba.php",
        // method: "POST",
        data: {
            "cve_pbloquera":cve_pbloquera,
            "cve_presentacionb":cve_presentacionb
        },
        success:function(r){
            // console.log(r);
            // $("#spantonelada").html(r);
            // selectPiezas();
            $("#selectestiba").attr("disabled", false);
            $("#selectestiba").html(r);
        }
    })
}

// function selectPresentacion(){
// 	var cve_pbloquera = $("#selectproducto").val();
// 	var cve_presentacionb = $("#selectpresentacion").val();
// 	$.ajax({
// 		type: "POST",
// 		url: "selectestiba.php",
// 		// method: "POST",
// 		data: {
// 			"cve_pbloquera":cve_pbloquera,
// 			"cve_presentacionb":cve_presentacionb
// 		},
// 		success:function(r){
// 			// console.log(r);
// 			// $("#spantonelada").html(r);
// 			// selectPiezas();
// 			$("#selectestiba").attr("disabled", false);
// 			$("#selectestiba").html(r);
// 		}
// 	})
// }

function selectPresentacionBesser(){
    var cve_presentacionb = $("#selectpresentacionb").val();
    $.ajax({
        type: "POST",
        url: "selectceldas.php",
        // method: "POST",
        data: {
            "cve_presentacionb":cve_presentacionb
        },
        success:function(r){
            // console.log(r);
            // $("#spantonelada").html(r);
            // selectPiezas();
            $("#selectceldasb").attr("disabled", false);
            $("#selectceldasb").html(r);

        }
    })

}

function selectEstibaBesser(){
    var cve_presentacionb = $("#selectpresentacionb").val();
    var num_celdas  = $("#selectceldasb").val();
    $.ajax({
        type: "POST",
        url: "selectestibabesser.php",
        // method: "POST",
        data: {
            "cve_presentacionb":cve_presentacionb,
            "num_celdas":num_celdas
        },
        success:function(r){
            // console.log(r);
            // $("#spantonelada").html(r);
            // selectPiezas();
            $("#selectestibab").attr("disabled", false);
            $("#selectestibab").html(r);

        }
    })

}

function obtenerDatos(cve_spf) {
    $.getJSON("modelo_salidas.php?consultar="+cve_spf, function(registros){
        // console.log(registros);

        $('#mcomb_idu').val(registros[0]['cve_spf']);
        $('#minputfolio').val(registros[0]['num_remision']);
        $('#minputcantsalida').val(registros[0]['cantidad_salida']);
        // $('#comb_id').html(registros[0]['cve_spf']);
        // $('#comb_productou').val(registros[0]['nombre_salida']);
        // $('#comb_presentup').val(registros[0]['presentacion_salida']);
        // $('#comb_cantidadu').val(registros[0]['cantidad_salida']);
    });
}

function limpiarCamposModal() {

    /*Campos VibroBlock*/
    $('#mcomb_idu').val("0");
    $('#minputfolio').val("0");
    $('#minputcantsalida').val("0");
}

function limpiarCampos() {

    /*Campos VibroBlock*/
	$('#selectproducto').val("0");
	$('#selectpresentacion').val("0");
	$('#selectestiba').val("0");

	$('#inputcantidad').val("");
	$('#inputremision').val("");
	$('#inputplacas').val("");

    /*Campos Besser*/
    $('#selectproductob').val("0");
    $('#selectpresentacionb').val("0");
    $('#selectestibab').val("0");
    $('#selectceldasb').val("0");

    $('#inputcantidadb').val("");
    $('#inputremisionb').val("");
    $('#inputplacasb').val("");
}

function sinacceso(){

    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
}

function sweetSalida(){

        Swal.fire(
                    'Salida!',
                    'Salida de producto de VibroBlock realizado con Exito !',
                    'success'
                )
}

function validacionDatos(){
	// var area 			= $('#selectarea').val();
	var producto 		= $('#selectproducto').val();
	var presentacion	= $('#selectpresentacion').val();
	var estiba 			= $('#selectestiba').val();
	var cantidad 		= $('#inputcantidad').val();
	var remision 		= $('#inputremision').val();
	var placas 			= $('#inputplacas').val();
	// var firma 			= $('#inputfirmas').val();

	var msj = "";

	// if (area == 0) {
	// 	msj += '<li>Área</li>';
	// }
	if (producto == 0) {
		msj += '<li>Producto</li>';
	}
	if (presentacion == 0) {
		msj += '<li>Presentación</li>';
	}
	if (estiba == 0) {
		msj += '<li>Número de estiba</li>';
	}	
	if (cantidad == "") {
		msj += '<li>Cantidad</li>';
	}	
	if (remision == "") {
		msj += '<li>Número de remisión</li>';
	}	
	if (placas == "") {
		msj += '<li>Número de placas</li>';
	}	
	// if (firma == "") {
	// 	msj += '<li>Firma de cliente</li>';
	// }
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');

    } else{
    	salidaProducto();
    }
}

function salidaProducto(){
	var datos = new FormData();
    var mgs = "";
    var mgsp = "";
    var producto    = $('#selectproducto').val();
    var presentacion    = $('#selectpresentacion').val();

	datos.append('producto',		$('#selectproducto').val());
	datos.append('presentacion',	$('#selectpresentacion').val());
	datos.append('estiba',			$('#selectestiba').val());
	datos.append('cantidad',		$('#inputcantidad').val());
	datos.append('remision',		$('#inputremision').val());
	datos.append('placas',			$('#inputplacas').val());
	datos.append('user',			$('#spanuser').text());

	// console.log(datos.get('producto'));
 //    console.log(datos.get('presentacion'));
 //    console.log(datos.get('estiba'));
 //    console.log(datos.get('cantidad'));
 //    console.log(datos.get('remision'));
 //    console.log(datos.get('placas'));
 //    console.log(datos.get('user'));
     if (producto == 2) {
        mgs += 'Block';
    } else if (producto == 3) {
        mgs += 'Bovedilla';
    } else if (producto == 4){
        mgs += 'Tabique';
    }

    if (presentacion == 4){
        mgsp += '10 x 20 x 40';
    } else if (presentacion == 5){
        mgsp += '12 x 20 x 40';
    } else if (presentacion == 6){
        mgsp += '15 x 20 x 40';
    } else if (presentacion == 7){
        mgsp += '20 x 20 x 40';
    } else if (presentacion == 8){
        mgsp += '15 x 25 x 56';
    } else if (presentacion == 9){
        mgsp += '20 x 25 x 56';
    } else if (presentacion == 10){
        mgsp += '5 x 17 x 40';
    }


    Swal.fire({
                title: '¿Los datos son correctos?',
                html: 'Producto: <b>' +  mgs + 
                '</b><br> Presentacion: <b>' + mgsp +
                '</b><br> Estiba: <b>' + datos.get('estiba') +
                '</b><br> Cantidad: <b>' + datos.get('cantidad'),
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
                url:"modelo_salidas.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){

                    consultar();
                    limpiarCampos();
                    sweetSalida();
                    // $("#btnvibro").attr("disabled", true);
                    // cerrarModal();
                    // $('#myLoadingGral').modal('show');
                    // $('#myLoading').modal('show');
                    // setTimeout(function(){location.href='vista_salidas.php';},8000);
                    // setTimeout(function(){location.href='modulos/inventario/morteros/inventario_morteros.php';},2000);
                    // Swal.fire(
                    //             'Salida!',
                    //             'Salida de producto de VibroBlock realizado con Exito !',
                    //             'success'
                    //         )
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

function validacionDatosBesser(){
    // var area             = $('#selectarea').val();
    var producto        = $('#selectproductob').val();
    var presentacion    = $('#selectpresentacionb').val();
    var celdas          = $('#selectceldasb').val();
    var estiba          = $('#selectestibab').val();
    var cantidad        = $('#inputcantidadb').val();
    var remision        = $('#inputremisionb').val();
    var placas          = $('#inputplacasb').val();
    // var firma            = $('#inputfirmas').val();

    var msj = "";

    // if (area == 0) {
    //  msj += '<li>Área</li>';
    // }
    if (producto == 0) {
        msj += '<li>Producto</li>';
    }
    if (presentacion == 0) {
        msj += '<li>Presentación</li>';
    }
    if (celdas == 0) {
        msj += '<li>Celdas</li>';
    }
    if (estiba == 0) {
        msj += '<li>Número de estiba</li>';
    }   
    if (cantidad == "") {
        msj += '<li>Cantidad</li>';
    }   
    if (remision == "") {
        msj += '<li>Número de remisión</li>';
    }   
    if (placas == "") {
        msj += '<li>Número de placas</li>';
    }
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');

    } else{
        salidaProductoBesser();
    }
}

function salidaProductoBesser(){
    var datos = new FormData();
    var mgs = "";
    var mgsp = "";
    var producto    = $('#selectproductob').val();
    var presentacion    = $('#selectpresentacionb').val();

    datos.append('producto',        $('#selectproductob').val());
    datos.append('presentacion',    $('#selectpresentacionb').val());
    datos.append('celdas',          $('#selectceldasb').val());
    datos.append('estiba',          $('#selectestibab').val());
    datos.append('cantidad',        $('#inputcantidadb').val());
    datos.append('remision',        $('#inputremisionb').val());
    datos.append('placas',          $('#inputplacasb').val());
    datos.append('user',            $('#spanuser').text());

    console.log(datos.get('producto'));
    console.log(datos.get('presentacion'));
    console.log(datos.get('celdas'));
    console.log(datos.get('estiba'));
    console.log(datos.get('cantidad'));
    console.log(datos.get('remision'));
    console.log(datos.get('placas'));
    console.log(datos.get('user'));
     if (producto == 1) {
        mgs += 'Block';
    }

    if (presentacion == 1){
        mgsp += '12 x 20 x 40';
    } else if (presentacion == 2){
        mgsp += '15 x 20 x 40';
    }


    Swal.fire({
                title: '¿Los datos son correctos?',
                html: 'Producto: <b>' +  mgs + 
                '</b><br> Presentacion: <b>' + mgsp +
                '</b><br> Celdas: <b>' + datos.get('celdas') +
                '</b><br> Estiba: <b>' + datos.get('estiba') +
                '</b><br> Cantidad: <b>' + datos.get('cantidad'),
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
                url:"insert_besser.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){

                    consultar();
                    limpiarCampos();
                    // cerrarModal();
                    // $('#myLoadingGral').modal('show');
                    Swal.fire(
                                'Salida!',
                                'Salida de producto de Besser realizado con Exito !',
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

function eliminarSalida(){
    var datos = new FormData();
    // var mgs = "";
    // var cve_spf             = $('#mcomb_idu').val();
    // var num_remision        = $('#minputfolio').val();
    // var cantidad_salida     = $('#minputcantsalida').val();

    datos.append('cve_spf',         $('#mcomb_idu').val());
    datos.append('num_remision',    $('#minputfolio').val());
    datos.append('cantidad_salida', $('#minputcantsalida').val());
    datos.append('user',            $('#spanuser').text());

    console.log(datos.get('cve_spf'));
    console.log(datos.get('num_remision'));
    console.log(datos.get('cantidad_salida'));
    console.log(datos.get('user'));


    Swal.fire({
                title: '¿Los datos son correctos?',
                html: 'Folio: <b>' +  datos.get('num_remision') + 
                '</b><br> Cantidad: <b>' + datos.get('cantidad_salida'),
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
                url:"delete_salida.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){

                    consultar();
                    limpiarCamposModal();
                    // cerrarModal();
                    // $('#myLoadingGral').modal('show');
                    Swal.fire(
                                'Eliminacion!',
                                'El folio ha sido eliminado con Exito !',
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