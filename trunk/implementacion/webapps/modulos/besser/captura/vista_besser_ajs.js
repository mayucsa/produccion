app.controller('vistaProduccionBesser', function(BASEURL, ID, $scope, $http){
	$scope.producto = '';
	$scope.pieza = '';
	$scope.barcadas = '';
	$scope.bandejas = '';
	$scope.cemento = '';
	$scope.aditivo = '';
	$scope.pesadas = '';
	$scope.llenado = '';
	$scope.humedad = '';
	$scope.pesopromedio = '';
	$scope.polvo = '';
	$scope.segundospolvo = '';
	$scope.porcentajepolvo = '';
	$scope.gravilla = '';
	$scope.segundosgravilla = '';
	$scope.porcentajegravilla = '';
	$scope.gravillados = '';
	$scope.segundosgravillados = '';
	$scope.porcentajegravillados = '';
	$scope.piezastotal = '';
	$scope.cementototal = '';
	$scope.cementopieza = '';

	$scope.hinicial = '';
	$scope.hfinal = '';
	$scope.hdiferencia = '';

	$scope.limpiarCampos = function(){
		$scope.producto = '';
		$scope.pieza = '';
		$scope.barcadas = '';
		$scope.bandejas = '';
		$scope.cemento = '';
		$scope.aditivo = '';
		$scope.pesadas = '';
		$scope.llenado = '';
		$scope.humedad = '';
		$scope.pesopromedio = '';
		$scope.polvo = '';
		$scope.segundospolvo = '';
		$scope.porcentajepolvo = '';
		$scope.gravilla = '';
		$scope.segundosgravilla = '';
		$scope.porcentajegravilla = '';
		$scope.gravillados = '';
		$scope.segundosgravillados = '';
		$scope.porcentajegravillados = '';
		$scope.piezastotal = '';
		$scope.cementototal = '';
		$scope.cementopieza = '';

		$scope.hinicial = '';
		$scope.hfinal = '';
		$scope.hdiferencia = '';
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
		if ($scope.barcadas == '' || $scope.barcadas == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar la cantidad de barcadas',
			  'warning'
			);
			return;
		}
		if ($scope.bandejas == '' || $scope.bandejas == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar el número de bandejas',
			  'warning'
			);
			return;
		}
		if ($scope.cemento == '' || $scope.cemento == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar la cantidad de cemento por barcada',
			  'warning'
			);
			return;
		}
		if ($scope.aditivo == '' || $scope.aditivo == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar la cantidad de aditivo',
			  'warning'
			);
			return;
		}
		if ($scope.pesadas == '' || $scope.pesadas == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar la cantidad de piezas pesadas',
			  'warning'
			);
			return;
		}
		if ($scope.llenado == '' || $scope.llenado == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar el tiempo de llenado',
			  'warning'
			);
			return;
		}
		if ($scope.humedad == '' || $scope.humedad == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar la humedad',
			  'warning'
			);
			return;
		}
		if ($scope.pesopromedio == '' || $scope.pesopromedio == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar el peso promedio',
			  'warning'
			);
			return;
		}
		if ($scope.hinicial == '' || $scope.hinicial == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar el  horometro inicial',
			  'warning'
			);
			return;
		}
		if ($scope.hfinal == '' || $scope.hfinal == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar el horometro final',
			  'warning'
			);
			return;
		}
		if ($scope.polvo == '' || $scope.polvo == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar la cantidad de latas en polvo',
			  'warning'
			);
			return;
		}
		if ($scope.segundospolvo == '' || $scope.segundospolvo == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar los segundos del polvo',
			  'warning'
			);
			return;
		}
		if ($scope.gravilla == '' || $scope.gravilla == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar la cantidad de latas en gravilla linea 1',
			  'warning'
			);
			return;
		}
		if ($scope.segundosgravilla == '' || $scope.segundosgravilla == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar los segundos de la gravilla linea 1',
			  'warning'
			);
			return;
		}
		if ($scope.gravillados == '' || $scope.gravillados == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar la cantidad de latas en gravilla linea 2',
			  'warning'
			);
			return;
		}
		if ($scope.segundosgravillados == '' || $scope.segundosgravillados == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar los segundo de la gravilla linea 2',
			  'warning'
			);
			return;
		}

		$scope.piezastotal = $('#spPiezasTotal').val();
		$scope.cementopieza = $('#spCementoPieza').val();
		$scope.cementototal = $('#spConsumoCemento').val();
		$scope.pieza = $('#spanpiezas').val();
		$scope.porcentajepolvo = $('#spPorcpolvo').val();
		$scope.porcentajegravilla = $('#spPorcGravilla').val();
		$scope.porcentajegravillados = $('#spPorcGravillados').val();
		$scope.hdiferencia = $('#inputhdiferencia').val();

		console.log('piezatotal', $scope.piezastotal);
		console.log('cementopieza', $scope.cementopieza);
		console.log('cementototal', $scope.cementototal);
		console.log('pieza', $scope.pieza);
		console.log('porcentajepolvo', $scope.porcentajepolvo);
		console.log('porcentajegravilla', $scope.porcentajegravilla);
		console.log('hnicial', $scope.porcentajegravillados);
		console.log('hfinal', $scope.hdiferencia);
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
					'producto': $scope.producto,
					'pieza': $scope.pieza,
					'barcadas': $scope.barcadas,
					'bandejas': $scope.bandejas,
					'cemento': $scope.cemento,
					'aditivo': $scope.aditivo,
					'pesadas': $scope.pesadas,
					'llenado': $scope.llenado,
					'humedad': $scope.humedad,
					'pesopromedio': $scope.pesopromedio,
					'hinicial': $scope.hinicial,
					'hfinal': $scope.hfinal,
					'hdiferencia': $scope.hdiferencia,
					'polvo': $scope.polvo,
					'segundospolvo': $scope.segundospolvo,
					'porcentajepolvo': $scope.porcentajepolvo,
					'gravilla': $scope.gravilla,
					'segundosgravilla': $scope.segundosgravilla,
					'porcentajegravilla': $scope.porcentajegravilla,
					'gravillados': $scope.gravillados,
					'segundosgravillados': $scope.segundosgravillados,
					'porcentajegravillados': $scope.porcentajegravillados,
					'piezastotal': $scope.piezastotal,
					'cementototal': $scope.cementototal,
					'cementopieza': $scope.cementopieza,
					// 'autoriza': $scope.autoriza,
					// 'comentario': $scope.comentario,
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
				});
			}
		})
	}

})