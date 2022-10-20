function consultar(){
    $(document).ready(function() {
    $('#tablaInvBesser').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "serverSideDesalojo.php",
        "lengthMenu": [[15, 30, 45], [15, 30, 45]],
        "order": [6, 'desc'],
        // "destroy": true,
        "searching": true,
        // bSort: false,
        // "paging": false,
        // "searching": false,
        "bDestroy": true,
        "columnDefs":[
                        {
                            "targets": [1, 2, 3, 4, 5, 6, 7],
                            "className": 'dt-body-center' /*alineacion al centro th de tbody de la table*/
                        },
                        {
                            "targets": 7,
                            "render": function(data, type, row, meta){
                                if (row[7] == 'FALSE') {
                                    return '<span class= "btn btn-warning" onclick= "modal()" data-toggle="modal" data-target="#modalConfirmacion"><i class="fas fa-edit"></i> </span>';
                                }else{
                                    return '<span class= "btn btn-warning" onclick= "confirmado()" data-toggle="modal" data-target="#modalConfirmacion"><i class="fas fa-edit"></i> </span>';
                                }
                                // return '<span class= "btn btn-warning" onclick= "obtenerDatos('+row[5]+')" data-toggle="modal" data-target="#modalConfirmacion"><i class="fas fa-edit"></i> </span>';
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

function modal(){

    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
}

function confirmado(){

    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Desalojo',
        html: 'Este desalojo ya fue confirmado, no se puede modificar',
        confirmButtonColor: '#1A4672'
        });
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
			// selectPiezas();
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
    $('#selectceldas').val("0");
    $('#inputtotal').val("");
    $('#inputrotura').val("");
    $('#inputdespuntados').val("");
}

function validacionDatos(){
    var producto        = $('#selectproducto').val();
    var presentacion    = $('#selectpresentacion').val();
    var celdas    		= $('#selectceldas').val();
    var total           = $('#inputtotal').val();
    var rotura          = $('#inputrotura').val();
    var despuntados     = $('#inputdespuntados').val();
    var msj = "";

    if (producto == 0) {
        msj += '<li>Producto</li>';
    }   
    if (presentacion == "") {
        msj += '<li>Presentación</li>';
    }
    if (celdas == "") {
        msj += '<li>Celdas</li>';
    }   
    if (total == "") {
        msj += '<li>Cantidad Total</li>';
    }   
    if (rotura == "") {
        msj += '<li>Cantidad Rotura</li>';
    }   
    if (despuntados == "") {
        msj += '<li>Cantidad despuntados</li>';
    }
    if (msj.length != 0) {
        $('#encabezadoModal').html('Validación de datos');
        $('#cuerpoModal').html('Los siguientes campos son obligatorios:<ul>'+msj+'</ul>');
        $('#modalMensajes').modal('toggle');

    } else{
        capturaProduccion();
    }
}

function capturaProduccion() {
    var datos = new FormData();
    var mgs = "";
    var mgsp = "";
    var producto    = $('#selectproducto').val();
    var presentacion    = $('#selectpresentacion').val();

    datos.append('producto',        $('#selectproducto').val());
    datos.append('presentacion',    $('#selectpresentacion').val());
    datos.append('celdas',    		$('#selectceldas').val());
    datos.append('total',           $('#inputtotal').val());
    datos.append('rotura',          $('#inputrotura').val());
    datos.append('despuntados',     $('#inputdespuntados').val());
    datos.append('user',            $('#spanuser').text());

    console.log(datos.get('producto'));
    console.log(datos.get('presentacion'));
    console.log(datos.get('celdas'));
    console.log(datos.get('total'));
    console.log(datos.get('rotura'));
    console.log(datos.get('despuntados'));
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
                '</b><br> Cantidad total: <b>' + datos.get('total') +
                '</b><br> Despuntados: <b>' + datos.get('despuntados'),
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
                url:"modelo_desalojo.php?accion=insertar",
                data: datos,
                processData:false,
                contentType:false,
        success:function(data){

                    consultar();
                    limpiarCampos();
                    // cerrarModal();
                    // $('#myLoadingGral').modal('show');
                    Swal.fire(
                                'Desalojo!',
                                'Desalojo realizado con Exito !',
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