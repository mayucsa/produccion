function consultar(){
    $(document).ready(function() {
    $('#tablaCapturaBloquera').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSideproduccion.php",
        "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        "order": [7, 'desc'],
        "searching": true,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [1, 2, 3, 4, 5, 6, 7, 8],
                            "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
                        },
                        {
                          "targets": 1,
                          // "data": 'creator',
                          "render": function ( data, type, row ) {
                          return row[1] +' - '+ row[8] + ' Celdas' ;
                        }
                    },
                        {
                            "targets": 8,
                            "render": function(data, type, row, meta){
                                // const primaryKey = data;
                                // "data": 'cve_entrada',
                                // if (row[8] >=  '05:00:00' + 'AND' + row[8] <= '07:00:00') {
                                if (row[10] >=  '01:00:00', row[10] <= '08:00:00'){
                                    return '<span class= "badge badge-success">3er Turno</span>';
                                } if (row[10] >=  '09:00:00', row[10] <= '17:00:00'){
                                    return '<span class= "badge badge-success">1er Turno</span>';
                                } if (row[10] >=  '18:00:00', row[10] <= '23:59:59'){
                                	 return '<span class= "badge badge-success">2do Turno</span>';
                                }
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
			$("#selectpresentacion").attr("disabled", false);
			$("#selectpresentacion").html(r);

		}
	})

}

function selectPiezas(){
	var cve_presentacionb = $("#selectpresentacion").val();
	$.ajax({
		type: "POST",
		url: "selectpieza.php",
		// method: "POST",
		data: {
			"cve_presentacionb":cve_presentacionb
		},
		success:function(r){
			// console.log(r);
			// $("#spantonelada").html(r);
			// selectTonelada();
			$("#spanpiezas").attr("disabled", false);
			$("#spanpiezas").html(r);
		}
	})
}

function selectPresentacion(){
	var cve_presentacionb = $("#selectpresentacion").val();
	$.ajax({
		type: "POST",
		url: "selectcelda.php",
		// method: "POST",
		data: {
			"cve_presentacionb":cve_presentacionb
		},
		success:function(r){
			// console.log(r);
			// $("#spantonelada").html(r);
			selectPiezas();
			$("#selectceldas").attr("disabled", false);
			$("#selectceldas").html(r);

		}
	})

}

function sinacceso(){

    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
}

function limpiarCampos() {
	$('#selectproducto').val("0");
	$('#selectpresentacion').val("0");
	$('#selectceldas').val("");
	$('#spanpiezas').text("");
	$('#inputbarcadas').val("");
	$('#inputbandeja').val("");
	$('#inputcemento').val("");
	$('#inputaditivo').val("");
	$('#inputpesadas').val("");	
	$('#inputllenado').val("");
	$('#inputhumedad').val("");
	$('#inputpesopromedio').val("");
	$('#inputpolvo').val("");
	$('#inputsegpolvo').val("");
	$('#spPorcpolvo').text("");
	$('#inputgravilla').val("");
	$('#inputseggravilla').val("");
	$('#spPorcGravilla').text("");
	$('#inputgravillados').val("");
	$('#inputseggravillados').val("");
	$('#spPorcGravillados').text("");
	$('#spPiezasTotal').text("");
	$('#spConsumoCemento').text("");
	$('#spCementoPieza').text("");
}

function validacionDatos(){
	var producto 	= $('#selectproducto').val();
	var barcadas 	= $('#inputbarcadas').val();
	var bandejas 	= $('#inputbandeja').val();
	var cemento 	= $('#inputcemento').val();
	var aditivo 	= $('#inputaditivo').val();
	var pesadas 	= $('#inputpesadas').val();

	var llenado 	= $('#inputllenado').val();
	var humedad 	= $('#inputhumedad').val();
	var peso 		= $('#inputpesopromedio').val();

	var polvo 			= $('#inputpolvo').val();
	var polvoseg 		= $('#inputsegpolvo').val();
	var gravilla 		= $('#inputgravilla').val();
	var gravillaseg		= $('#inputseggravilla').val();
	var gravillados 	= $('#inputgravillados').val();
	var gravillasegdos	= $('#inputseggravillados').val();
	var msj = "";

	if (producto == 0) {
		msj += '<li>Producto</li>';
	}	
	if (barcadas == "") {
		msj += '<li>Cantidad de barcadas</li>';
	}	
	if (bandejas == "") {
		msj += '<li>Bandejas producidas</li>';
	}	
	if (cemento == "") {
		msj += '<li>Cemento por barcada</li>';
	}	
	if (aditivo == "") {
		msj += '<li>Consumo de aditivo</li>';
	}
	if (pesadas == "") {
		msj += '<li>Pesadas</li>'
	}
	if (llenado == "") {
		msj += '<li>Tiempo de llenado</li>';
	}
	if (humedad == "") {
		msj += '<li>Húmedad</li>';
	}
	if (peso == "") {
		msj += '<li>Peso Promedio</li>';
	}
	if (polvo == "") {
		msj += '<li>Polvo</li>';
	}
	if (polvoseg == "") {
		msj += '<li>Segundos polvo</li>';
	}
	if (gravilla == "") {
		msj += '<li>Gravilla</li>';
	}
	if (gravillaseg == "") {
		msj += '<li>Segundos gravilla</li>';
	}
	if (gravillados== "") {
		msj += '<li>Gravilla</li>';
	}
	if (gravillasegdos == "") {
		msj += '<li>Segundos gravilla</li>';
	}
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');

    } else{
    	existenciaCemento();
    }
}

function existenciaCemento(){
    var cemento = $('#spConsumoCemento').val();
    var msj = "";

    var datos   = new FormData();

    datos.append('cemento', $('#spConsumoCemento').val());

        $.ajax({
                type:"POST",
                url:"modelo_besser.php?accion=consultarC&cemento=" + cemento,
                data: cemento,
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
                    existenciaAditivo();

                    }else{
                        Swal.fire({
                                        icon: 'info',
                                        // iconColor: '#FF0000',
                                        title: '¡Error!',
                                        text: 'Sin existencia de cemento',
                                        footer: 'Revisar las existencias de Tarimas',
                                        confirmButtonColor: '#1A4672'
                                    })
                        }
                    }


            })
}

function existenciaAditivo(){
    var aditivo = $('#inputaditivo').val();
    var msj = "";

    var datos   = new FormData();

    datos.append('aditivo', $('#inputaditivo').val());

        $.ajax({
                type:"POST",
                url:"modelo_besser.php?accion=consultarA&aditivo=" + aditivo,
                data: aditivo,
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
                    capturaProduccion();

                    }else{
                        Swal.fire({
                                        icon: 'info',
                                        // iconColor: '#FF0000',
                                        title: '¡Error!',
                                        text: 'Sin existencia de Aditivo',
                                        footer: 'Revisar las existencias de Tarimas',
                                        confirmButtonColor: '#1A4672'
                                    })
                        }
                    }


            })
}

function capturaProduccion(){
	var datos = new FormData();
	var mgs = "";
	var mgsp = "";
	var producto    = $('#selectproducto').val();
	var presentacion    = $('#selectpresentacion').val();

	datos.append('producto',		$('#selectproducto').val());
	datos.append('presentacion',	$('#selectpresentacion').val());
	datos.append('celdas',			$('#selectceldas').val());
	datos.append('piezas',			$('#spanpiezas').text());

	datos.append('barcadas',		$('#inputbarcadas').val());
	datos.append('bandejas',		$('#inputbandeja').val());
	datos.append('cemento',			$('#inputcemento').val());

	datos.append('aditivo',			$('#inputaditivo').val());
	datos.append('pesadas',			$('#inputpesadas').val());

	datos.append('llenado',			$('#inputllenado').val());
	datos.append('humedad',			$('#inputhumedad').val());
	datos.append('pesopromedio',	$('#inputpesopromedio').val());

	datos.append('polvo',			$('#inputpolvo').val());
	datos.append('polvoseg',		$('#inputsegpolvo').val());
	datos.append('polvoporc',		$('#spPorcpolvo').text());

	datos.append('gravilla',		$('#inputgravilla').val());
	datos.append('gravillaseg',		$('#inputseggravilla').val());
	datos.append('gravillaporc',	$('#spPorcGravilla').text());

	datos.append('gravillados',		$('#inputgravillados').val());
	datos.append('gravillasegdos',	$('#inputseggravillados').val());
	datos.append('gravillaporcdos',	$('#spPorcGravillados').text());

	datos.append('piezastotales',	$('#spPiezasTotal').text());
	datos.append('consumototal',	$('#spConsumoCemento').text());
	datos.append('cementopieza',	$('#spCementoPieza').text());

	datos.append('user',			$('#spanuser').text());

    // console.log(datos.get('producto'));
    // console.log(datos.get('presentacion'));
    // console.log(datos.get('celdas'));
    // console.log(datos.get('piezas'));

    // console.log(datos.get('barcadas'));
    // console.log(datos.get('bandejas'));
    // console.log(datos.get('cemento'));

    // console.log(datos.get('aditivo'));
    // console.log(datos.get('pesadas'));

    // console.log(datos.get('llenado'));
    // console.log(datos.get('humedad'));
    // console.log(datos.get('pesopromedio'));

    // console.log(datos.get('polvo'));
    // console.log(datos.get('polvoseg'));
    // console.log(datos.get('polvoporc'));

    // console.log(datos.get('gravilla'));
    // console.log(datos.get('gravillaseg'));
    // console.log(datos.get('gravillaporc'));

    // console.log(datos.get('gravillados'));
    // console.log(datos.get('gravillasegdos'));
    // console.log(datos.get('gravillaporcdos'));

    // console.log(datos.get('piezastotales'));
    // console.log(datos.get('consumototal'));
    // console.log(datos.get('cementopieza'));

    // console.log(datos.get('user'));

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
                '</b><br> Celdas: <b>' + datos.get('celdas'),
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
                url:"modelo_besser.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){

                    consultar();
                    limpiarCampos();
                    // cerrarModal();
                    // $('#myLoadingGral').modal('show');
                    Swal.fire(
                                '¡Agregado!',
                                'Produccion Besser Agregado con Exito !',
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