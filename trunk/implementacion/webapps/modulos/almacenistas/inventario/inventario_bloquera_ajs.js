app.controller('vistaInventario', function(BASEURL, ID, $scope, $http){
	$scope.idproducto = '';
	$scope.producto = '';
	$scope.estiba = '';
	$scope.existencia = '';
	$scope.rotura = '';

	$http.post('Controller.php', {
		'task': 'ssInventarioBloquera'
	}).then(function (response){
		response = response.data;
		$scope.ssInventarioBloquera = response;
		setTimeout(function(){
			$('#tablaEstibas').DataTable({
	            "dom": 'Bfrtip',
	            "buttons": [
	                 {"extend": 'excel',"exportOptions": { columns: [0,1,2, 3] }, "text": '<i class="far fa-file-excel"> Exportar en Excel</i>', "title": 'Inventario bloquera'}, 
	                 {"extend": 'pdf',"exportOptions": { columns: [0,1,2, 3] },  "text": '<i class="far fa-file-pdf"> Exportar en PDF</i>', "title": 'Inventario bloquera'}, 
	                 {"extend": 'print',"exportOptions": { columns: [0,1,2, 3] },  "text": '<i class="fas fa-print"> Imprimir</i>', "title": 'Inventario bloquera'},
	                 "pageLength",
	            ],
		        "processing": true,
		        "bDestroy": true,
				"order": [2, 'asc'],
				"lengthMenu": [[100, 150, 200], [100, 150, 200]],
				"pageLength": 100,
				"columnDefs": [
								{
									"targets": 3,
									render: $.fn.dataTable.render.number(',', '.', 0, '')
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
			});
		},800);
	},function(error){
		console.log('error', error);
	});

	$scope.setModalMisRequ = function(numero_estiba){
		if ($scope.modalMisRequ == false) {
			$scope.modalMisRequ = true;
			$scope.pintarmodal(numero_estiba);
		}else{
			$scope.modalMisRequ = false;
			$scope.rotura = '';
		}
		// console.log($scope.modalMisRequ);
	}

	$scope.pintarmodal = function(numero_estiba){
	    $.getJSON("modelo_estiba.php?consultar="+numero_estiba, function(registros){
	        console.log(registros);

	        // $scope.folio = registros[0]['cve_bloquera'];

	        // $('#inputfolio').val(registros[0]['cve_desalojo']);
	        $('#inputidproducto').val(registros[0]['nombre_producto']);
	        $('#inputproducto').val(registros[0]['producto']);
	        $('#inputestiba').val(registros[0]['numero_estiba']);
	        $('#inputexistencia').val(registros[0]['cantidad_estiba']);
	        // $('#inputrotura').val(registros[0]['cantidad_rotura']);

	    });
	}

	$scope.roturadiaria = function(){
		$scope.idproducto = $('#inputidproducto').val();
		$scope.estiba = $('#inputestiba').val();
		$scope.rotura = $('#inputrotura').val();
		if ($scope.rotura == '' || $scope.rotura == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar la cantidad de rotura',
			  'warning'
			);
			return;
		}

		Swal.fire({
			title: 'Rotura diaria',
			html: '¿Realmente deseas capturar la rotura de la <b>estiba '+ $scope.estiba +'</b> con cantidad de <b>'+ $scope.rotura + '</b>?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			confirmButtonText: 'Aceptar',
			cancelButtonColor: 'red',
			cancelButtonText: 'Cancelar'	
		}).then((result) => {
			if (result.isConfirmed) {
				jsShowWindowLoad('Capturando rotura diaria...');
				$http.post('Controller.php', {
					'task': 'roturadiaria',
					'cve_bloquera': $scope.idproducto,
					'estiba': $scope.estiba,
					'cantidad': $scope.rotura,
					'id': ID,
				}).then(function(response){
					response = response.data;
					console.log('response', response);
					jsRemoveWindowLoad();
					let timerInterval
					Swal.fire({
					  title: 'Éxito!',
					  html: 'Su captura de rotura diaria generó correctamente.\n <p> <b>Estiba: ' + $scope.estiba + '<p> Cantidad: '+ $scope.rotura +' </b> ',
					  timer: 2000,
					  timerProgressBar: true,
					  didOpen: () => {
					    Swal.showLoading()
					    const b = Swal.getHtmlContainer().querySelector('b')
					    timerInterval = setInterval(() => {
					      // b.textContent = Swal.getTimerLeft()
					    }, 100)
					  },
					  willClose: () => {
					    clearInterval(timerInterval)
					  }
					}).then((result) => {
					  /* Read more about handling dismissals below */
					  if (result.dismiss === Swal.DismissReason.timer) {
					    // console.log('I was closed by the timer')
					    location.reload();
					  }else{
					  	location.reload();
					  }
					})
				}, function(error){
					console.log('error', error);
					jsRemoveWindowLoad();
				});
			}
		})
	}

	$scope.validaExistencia = function(rotura){
		$scope.existencia = parseFloat($('#inputexistencia').val());
		// console.log('existencia', $scope.existencia);
		// existencia = parseFloat(existencia);
		rotura = parseFloat(rotura);
		console.log('rotura', rotura);
		console.log('existencia', $scope.existencia );

		if (rotura <= $scope.existencia) {
			$scope.roturadiaria();
		}else{
			Swal.fire({
					icon: 'error',
					title: '¡Error!',
					text: 'La cantidad de rotura debe ser menor al inventario'
				});
			$("#inputrotura").val('');
		}
	}

	$scope.sinacceso = function(){
    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
	}

})