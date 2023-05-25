app.controller('vistaProduccionMorteros', function (BASEURL, ID, $scope, $http) {

	$scope.producto = '';
	$scope.tonelada = '';
	$scope.presentacion = '';
	$scope.cantidad = '';
	$scope.kgreal = '';
	$scope.sacosrotos = '';
	$scope.tarimas = '';
	$scope.kgformula = '';
	$scope.diferencia = '';
	$scope.sacosproduccion = '';
	$scope.sacostotales = '';

	$http.post('Controller.php', {
		'task': 'getProducto'
	}).then(function (response){
		response = response.data;
		console.log('getProducto', response);
		$scope.prod = response;
	},function(error){
		console.log('error', error);
	});

	$http.post('Controller.php', {
		'task': 'getProduccion'
	}).then(function(response) {
		response = response.data;
		console.log('getProduccion', response);
		$scope.ssProduccionMorteros = response;
		setTimeout(function(){
			$('#tablaProduccion').DataTable({
		        "processing": true,
		        "bDestroy": true,
				"order": [5, 'desc'],
				"lengthMenu": [[15, 30, 45], [15, 30, 45]],
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
	}, function(error){
		console.log('error', error);
	});

	$scope.sinacceso = function(){
    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
	}

	$scope.limpiarCampos = function(){
		$scope.producto = '';
		$scope.tonelada = '';
		$scope.presentacion = '';
		$scope.cantidad = '';
		$scope.kgreal = '';
		$scope.sacosrotos = '';
		$scope.tarimas = '';
		$scope.kgformula = '';
		$scope.diferencia = '';
		$scope.sacosproduccion = '';
		$scope.sacostotales = '';
	}

	$scope.habilitarinput = function () {
		$("#cantidad").attr("disabled", false);
		$("#kgreal").attr("disabled", false);
		$("#sacosrotos").attr("disabled", false);
		$("#tarimas").attr("disabled", false);

		$http.post('Controller.php', {
			'task': 'getTonelada',
			'producto': $scope.producto
		}).then(function (response){
			response = response.data;
			console.log('getTonelada', response[0].tonelada);
			console.log('getPresentacion', response[0].presentacion);
			$scope.tonelada = response[0].tonelada;
			$scope.presentacion = response[0].presentacion;
		}, function(error){
			console.log('error', error);
		})

	}

	$scope.toneladaporbarcada = function(tonelada, cantidad){
		tonelada = parseFloat(tonelada);
		cantidad = parseFloat(cantidad);
		// console.log('producto', tonelada);
		// console.log('desalojo', cantidad);
		$scope.kgformula = tonelada * cantidad;
	}
	$scope.realmenosformula = function(kgreal, kgformula, presentacion){
		kgreal = parseFloat(kgreal);
		kgformula = parseFloat(kgformula);
		presentacion = parseFloat(presentacion);
		// console.log('kgreal', kgreal);
		// console.log('kgformula', kgformula);
		// console.log('presentacion', presentacion);
		$scope.diferencia = kgreal - kgformula;
		$scope.sacosproduccion = kgreal / presentacion;
	}
	$scope.sacosusadosmasrotos = function(sacosproduccion, sacosrotos){
		sacosproduccion = parseFloat(sacosproduccion);
		sacosrotos = parseFloat(sacosrotos);
		// console.log('sacosproduccion', sacosproduccion);
		// console.log('sacosrotos', sacosrotos);
		$scope.sacostotales = sacosproduccion + sacosrotos;

	}

	$scope.existenciatarimas = function(cantidad){
		cantidad =  parseFloat(cantidad);
		// console.log('cantidad', cantidad);
		if (cantidad > 0) {
			jsShowWindowLoad('Validando existencia...');
			$http.post('Controller.php', {
				'task': 'getTarimas',
				'cantidad': cantidad
			}).then(function (response){
				response = response.data;
				// console.log('getTarimas', response);
				jsRemoveWindowLoad();
				if (response.msj != 'ok') {
					Swal.fire({
					  title: 'Sin existencia de tarimas',
					  text: response.msj,
					  icon: 'warning',
					  showCancelButton: false,
					  confirmButtonColor: 'green',
					  confirmButtonText: 'Aceptar'
					}).then((result) => {
						if (result.isConfirmed) {
							$scope.tarimas = '';
							$("#tarimas").val('');
						}else{
							$scope.tarimas = '';
							$("#tarimas").val('');
						}
					});
				}
			}, function(error){
				console.log('error', error);
			});
		}
	}

	$scope.validacionCampos = function(){
		if ($scope.producto == '' || $scope.producto == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario seleccionar un producto',
			  'warning'
			);
			return;
		}
		if ($scope.cantidad == '' || $scope.cantidad == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar la cantidad de barcadas',
			  'warning'
			);
			return;
		}
		if ($scope.kgreal == '' || $scope.kgreal == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar el kilogramo real producido',
			  'warning'
			);
			return;
		}
		if ($scope.sacosrotos == '' || $scope.sacosrotos == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar la cantidad de sacos que se rompieron durante la producción',
			  'warning'
			);
			return;
		}
		if ($scope.tarimas == '' || $scope.tarimas == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar la cantidad de tarimas utilizadas en la produccion',
			  'warning'
			);
			return;
		}

		producto = parseFloat($scope.producto);
		cantidad = parseFloat($scope.cantidad);
		kgreal = parseFloat($scope.kgreal);
		sacosrotos = parseFloat($scope.sacosrotos);
		tarimas = parseFloat($scope.tarimas);
		kgformula = parseFloat($scope.kgformula);
		diferencia = parseFloat($scope.diferencia);
		sacosproduccion = parseFloat($scope.sacosproduccion);
		sacostotales = parseFloat($scope.sacostotales);

		// console.log('producto', producto);
		// console.log('cantidad', cantidad);
		// console.log('kgreal', kgreal);
		// console.log('sacosrotos', sacosrotos);
		// console.log('tarimas', tarimas);

		// console.log('kgformula', kgformula);
		// console.log('diferencia', diferencia);
		// console.log('sacosproduccion', sacosproduccion);
		// console.log('sacostotales', sacostotales);

		Swal.fire({
			title: 'Estás a punto de capturar una producción.',
			text: '¿Es correcta la información agregada?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			cancelButtonColor: 'red',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				jsShowWindowLoad('Capturando producción...');
				$http.post('Controller.php', {
					'task': 'guardarProduccion',
					'producto': producto,
					'cantidad': cantidad,
					'kgformula': kgformula,
					'kgreal': kgreal,
					'diferencia': diferencia,
					'sacosproduccion': sacosproduccion,
					'sacosrotos': sacosrotos,
					'sacostotales': sacostotales,
					'tarimas': tarimas,
					'id': ID,
				}).then(function(response){
					response = response.data;
					// console.log('response', response);
					jsRemoveWindowLoad();
					if (response.code == 200) {
						Swal.fire({
						  title: '¡Éxito!',
						  html: 'Su captura de producción se generó correctamente.\n <b>Folio: ' +response.folio + '</b>',
						  icon: 'success',
						  showCancelButton: false,
						  confirmButtonColor: 'green',
						  confirmButtonText: 'Aceptar'
						}).then((result) => {
						  if (result.isConfirmed) {
						  	location.reload();
						  }else{
						  	location.reload();
						  }
						});
					}else{
						alert('Error en controlador. \nFavor de ponerse en contacto con el administrador del sitio.');
					}
				}, function(error){
					console.log('error', error);
					jsRemoveWindowLoad();
				})
			}
		})

	}

	$scope.eliminar = function(cve_captura, cve_mortero, kg_real){
		console.log('cve_captura', cve_captura);
		console.log('producto', cve_mortero);
		console.log('kg_real', kg_real);
		Swal.fire({
			title: 'Eliminar producción',
			html: '¿Realmente desea eliminar el <b>folio '+ cve_captura +'</b>?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			confirmButtonText: 'Aceptar',
			cancelButtonColor: 'red',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				jsShowWindowLoad('Eliminando produccion de morteros...');
				$http.post('Controller.php', {
					'task': 'eliminarProduccion',
					'cve_captura': cve_captura,
					'producto': cve_mortero,
					'kgreal': kg_real,
				}).then(function(response){
					response = response.data;
					console.log('response', response);
					jsRemoveWindowLoad();
					Swal.fire({
						title: '¡Éxito!',
					  	html: 'Se elimino la producción correctamente.\n <b>Folio: ' + cve_captura + '</b>',
					  	icon: 'success',
					  	showCancelButton: false,
					  	confirmButtonColor: 'green',
					  	confirmButtonText: 'Aceptar'
					}).then((result) => {
						if (result.isConfirmed) {
						  	location.reload();
						  }else{
						  	location.reload();
						  }
					});
				}, function(error){
					console.log('error', error);
	    			jsRemoveWindowLoad();
				})
			}
		})
	}

});