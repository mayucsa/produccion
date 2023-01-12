app.controller('vistaDespachoBloqueras', function(BASEURL, ID, $scope, $http){
	$scope.folio = '';

	$scope.setModalMisRequ = function(response){
		if ($scope.modalMisRequ == true) {
			$scope.modalMisRequ = false;
			// $scope.pintarmodal(response);
		}else{
			$scope.modalMisRequ = true;
			// $scope.estiba = '';
		}
		// console.log($scope.modalMisRequ);
	}

	$scope.pintarmodal = function(response){
		$("#tablaModal").html('');
			$scope.foliov = response.data[0].CFOLIO;
			$scope.clientev = response.data[0].CRAZONSOCIAL;
			$scope.placasv = response.data[0].CTEXTOEXTRA2;

	        $("#tablaModal").html( '<thead> <tr>     <th class="text-center">Cve producto</th>'+
	                                                '<th class="text-center">Producto</th>'+
	                                                '<th class="text-center">Cantidad</th>'+
	                                    '</thead>');
	        for (i = 0; i < response.data.length; i++){
	             $("#tablaModal").append('<tr>' + 
	                '<td style="dislay: none;">' + response.data[0].CIDPRODUCTO + '</td>'+
	                '<td style="dislay: none;">' + response.data[0].CNOMBREPRODUCTO + '</td>'+
	                '<td style="dislay: none;">' + response.data[0].CUNIDADESCAPTURADAS + '</td>'+ 
	                '</td>'
	                +'</tr>');
	        }
	}

	$scope.sweet = function (){
		Swal.fire({
				icon: 'success',
				title: 'Estiba',
				text: 'El numero de estiba SI corresponde al producto'
			})
	}

	$scope.limpiarCampos = function() {
		$scope.folio = '';
		$scope.cliente = '';
		$scope.placas = '';
		$scope.admDocumentosDetalle = '';
	}

	$scope.validaFolio = function(folio){
		if (folio == '' || folio == undefined) {
			return;
		}
		jsShowWindowLoad('Validando folio...');
		$http.post('Controller.php', {
			'task': 'validaFolio',
			'folio': folio
		}).then(function (response){
			jsRemoveWindowLoad();
			console.log('admDocumentosDetalle: ',response.data);
			// $scope.admDocumentosDetalle = response.data;
			if (response.data.length == 0) {
				Swal.fire('Sin información','No existe información asociada al folio ingresado. ','error');
				$scope.folio = '';
				// $scope.setModalMisRequ();
			}else{
			switch (response.data[0].ESTATUS_DOCUMENTO) {
				case '1':
					// $scope.setModalMisRequ();
					Swal.fire('Sin entrada','El folio <b>'+ folio +'</b> no registro entrada en planta','error');
					break;
				case '2':
					// $scope.admDocumentosDetalle = response.data;
					$scope.setModalMisRequ(response);
					$("#tablaModal").html('');
						$scope.documento = response.data[0].CIDDOCUMENTO;
						$scope.foliov = response.data[0].CFOLIO;
						$scope.clientev = response.data[0].CRAZONSOCIAL;
						$scope.placasv = response.data[0].CTEXTOEXTRA2;

				        $("#tablaModal").html( '<thead> <tr>     <th class="text-center">Cve producto</th>'+
				                                                '<th class="text-center">Producto</th>'+
				                                                '<th class="text-center">Cantidad</th>'+
				                                    '</thead>');
				        for (i = 0; i < response.data.length; i++){
				             $("#tablaModal").append('<tr>' + 
				                '<td style="dislay: none;">' + response.data[0].CIDPRODUCTO + '</td>'+
				                '<td style="dislay: none;">' + response.data[0].CNOMBREPRODUCTO + '</td>'+
				                '<td style="dislay: none;">' + response.data[0].CUNIDADESCAPTURADAS + '</td>'+ 
				                '</td>'
				                +'</tr>');
				        }
					break;
				case '3':
					$scope.cliente = response.data[0].CRAZONSOCIAL;
					$scope.placas = response.data[0].CTEXTOEXTRA2;
					$scope.admDocumentosDetalle = response.data;
					// $scope.setModalMisRequ();
					break;
			}


				// if (response.data[0].ESTATUS_DOCUMENTO == 1){
				// 		// Swal.fire('Sin información','No existe información asociada al folio ingresado. ','info');
				// 		// $scope.admDocumentosDetalle = response.data;
				// 		$scope.setModalMisRequ();
				// }if (response.data[0].ESTATUS_DOCUMENTO == 2) {
				// 	$scope.admDocumentosDetalle = response.data;
				// }
			}
		})
	}

	$scope.verificar = function(){
		$scope.documento = $('#inputdocumento').val();
		$scope.foliov = $('#inputfoliov').val();

		Swal.fire({
			title: '¡Verificación!',
			html: '¿Realmente deseas verificar el <b>folio '+ $scope.folio +'</b>?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			confirmButtonText: 'Aceptar',
			cancelButtonColor: 'red',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				jsShowWindowLoad('Verificando pedido...');
				$http.post('Controller.php', {
					'task': 'verificarFolio',
					'documento': $scope.documento,
					'id': ID,
				}).then(function(response){
					response = response.data;
					console.log('response', response);
					jsRemoveWindowLoad();
					let timerInterval
					// Swal.fire({
					// 	title: 'Éxito!',
					// 	html: 'La verificación del producto generó correctamente.\n <b>Estiba: ' + $scope.foliov + '</b>',
					// 	timer: 2000,
					//   	timerProgressBar: true,
					// })
					Swal.fire({
					  title: '¡Éxito!',
					  html: 'La verificación del producto generó correctamente.\n <b>Estiba: ' + $scope.foliov + '</b>',
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
				})
			}
		})
	}

	$scope.validaExistencia =  function(estiba, idproducto, cantidad){
		cantidad = parseFloat(cantidad);
		if (cantidad > 0) {
			console.log('cantidades', cantidad)
			jsShowWindowLoad('Validando cantidades...');
			$http.post('Controller.php', {
				'task': 'validaExistencia',
				'idproducto': idproducto,
				'estiba': estiba,
				'cantidad': cantidad,
			}).then(function(response){
				response = response.data;
				jsRemoveWindowLoad();
				if (response.msj != 'ok') {
					Swal.fire({
					  title: 'Estiba sin existencia ',
					  text: response.msj,
					  icon: 'warning',
					  showCancelButton: false,
					  confirmButtonColor: 'green',
					  confirmButtonText: 'Aceptar'
					}).then((result) => {
						if (result.isConfirmed) {
							$scope.resetifValueFailed(cantidad);
						}else{
							$scope.resetifValueFailed(cantidad);
						}
					})
				}
			}, function(error){
				console.log('error', error);
				jsRemoveWindowLoad();
			})
		}
	}

	$scope.validaEstiba = function(estiba, idproducto, cantidad){
		console.log('estiba', estiba);
		console.log('idproducto', idproducto);
		console.log('cantidad', cantidad);
		// $scope.idproducto = $('#inputidproducto').val();
		// console.log('id', $scope.idproducto);
		if (estiba > 0) {
			switch (idproducto) {
				case 'B201':
					if (estiba >= 200 & estiba <= 299 ) {
						$scope.validaExistencia(estiba, idproducto, cantidad);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
					}
					break;
				case 'B304':
					if (estiba >= 600 & estiba <= 699 ) {
						$scope.validaExistencia(estiba, idproducto, cantidad);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
					}
					break;
				case 'B301':
					if (estiba >= 300 & estiba <= 399 ) {
						$scope.validaExistencia(estiba, idproducto, cantidad);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
					}
					break;
				case 'B101':
					if (estiba >= 100 & estiba <= 199 ) {
						$scope.validaExistencia(estiba, idproducto, cantidad);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
					}
					break;
				case 'B206':
					if (estiba >= 700 & estiba <= 799 ) {
						$scope.validaExistencia(estiba, idproducto, cantidad);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
					}
					break;
				case 'B401':
					if (estiba >= 400 & estiba <= 499 ) {
						$scope.validaExistencia(estiba, idproducto, cantidad);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
						$scope.estiba = '';
					}
					break;
				case 'B501':
					if (estiba >= 500 & estiba <= 599 ) {
						$scope.validaExistencia(estiba, idproducto, cantidad);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
					}
					break;
				case 'B801':
					if (estiba >= 800 & estiba <= 899 ) {
						$scope.validaExistencia(estiba, idproducto, cantidad);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
					}
					break;
				case 'B901':
					if (estiba >= 900 & estiba <= 999 ) {
						$scope.validaExistencia(estiba, idproducto, cantidad);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
					}
					break;
				case 'B001':
					if (estiba >= 1 & estiba <= 99 ) {
						$scope.validaExistencia(estiba, idproducto, cantidad);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
					}
					break;
			}
		}
	}

})