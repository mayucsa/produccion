app.controller('vistaSalidasMorteros', function(BASEURL, ID, $scope, $http){
	$scope.folio = '';
	angular.element('#nextFocusHeader0').focus();

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

	$scope.validaFolio = function(folio){
		if (folio == '' || folio == undefined) {
			return;
		}
		jsShowWindowLoad('Validando folio...');
		$http.post('Controller.php', {
			'task': 'validaFolio',
			'folio': folio
		}).then(function(response){
			jsRemoveWindowLoad();
			console.log('admDocumentosDetalle: ', response.data);
			// $scope.admDocumentosDetalle = response.data;
			if (response.data.length == 0) {
				Swal.fire({
					title: 'Sin información',
					html: 'No existe información asociada al <b>folio '+ folio +'</b> ingresado.',
					icon: 'error',
				}).then((result) => {
					  if (result.dismiss === Swal.DismissReason.timer) {
				    	angular.element('#nextFocusHeader0').focus();
						$('#nextFocusHeader0').val('');
					  }else{
					  	angular.element('#nextFocusHeader0').focus();
					  	$('#nextFocusHeader0').val('');
					  }
				})
			}else{
				switch (response.data[0].ESTATUS_DOCUMENTO){
				case '1':
					Swal.fire('Sin entrada','El folio <b>'+ folio +'</b> no registro entrada en planta','error');
						angular.element('#nextFocusHeader0').focus();
					  	$('#nextFocusHeader0').val('');
					break;
				case '2':
					$scope.setModalMisRequ(response);
					$("#tablaModal").html('');
						$scope.documento = response.data[0].CIDDOCUMENTO;
						$scope.foliov = response.data[0].CFOLIO;
						$scope.clientev = response.data[0].CRAZONSOCIAL;
						$scope.placasv = response.data[0].CTEXTOEXTRA2;

				        $("#tablaModal").html( '<thead> <tr>     <th class="text-center">Cve producto</th>'+
				                                                '<th class="text-center">Nombre de producto</th>'+
				                                                '<th class="text-center">Cantidad</th>'+
				                                    '</thead>');
				        for (i = 0; i < response.data.length; i++){
				             $("#tablaModal").append('<tr>' + 
				                '<td style="dislay: none;">' + response.data[i].CIDPRODUCTO + '</td>'+
				                '<td style="dislay: none;">' + response.data[i].CNOMBREPRODUCTO + '</td>'+
				                '<td style="dislay: none;">' + response.data[i].CUNIDADESCAPTURADASO + ' ' +response.data[i].CUNIDADMEDIDA + '</td>'+ 
				                '</td>'
				                +'</tr>');
				        }
					break;
				case '3':
					$scope.cliente = response.data[0].CRAZONSOCIAL;
					$scope.placas = response.data[0].CTEXTOEXTRA2;
					$scope.admDocumentosDetalle = response.data;
					break;
				case '4':
					Swal.fire('Pedido entregado','El folio <b>'+ folio +'</b> ya fue entregado','error');
						angular.element('#nextFocusHeader0').focus();
					  	$('#nextFocusHeader0').val('');
					break;
				case '5':
					Swal.fire('Revisión','El folio <b>'+ folio +'</b> ya registro salida en planta','info');
						angular.element('#nextFocusHeader0').focus();
					  	$('#nextFocusHeader0').val('');
					break;
				default:
					Swal.fire('Error','El folio <b>'+ $scope.folio +'</b> no tiene registros en sistema','error');
						angular.element('#nextFocusHeader0').focus();
					  	$('#nextFocusHeader0').val('');
				}
			}
		}, function(caseError){
			jsRemoveWindowLoad();
			console.log('Error', caseError);
		});
	}
	$scope.verificar = function(){
		$scope.documento = $('#inputdocumento').val();
		$scope.foliov = $('#inputfoliov').val();

		Swal.fire({
			title: '¡Iniciar!',
			html: '¿Estas seguro de iniciar el surtido de la nota con folio <b>'+ $scope.folio +'</b>?',
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
					  html: 'Confirmaste el inicio de surtido correctamente.\n <b>Folio: ' + $scope.foliov + '</b>',
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
	$scope.validacionDatos = function(){
		Swal.fire({
			title: 'Surtir producto',
			html: '¿Realmente deseas surtir el pedido de la nota <b>'+ $scope.folio +'</b> ?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			confirmButtonText: 'Aceptar',
			cancelButtonColor: 'red',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				jsShowWindowLoad('Surtiendo pedido...');
				$http.post('Controller.php', {
					'task': 'despacharProducto',
					'datos': $scope.admDocumentosDetalle,
					'folio': $scope.folio
				}).then(function(response){
					response = response.data;
					console.log('response', response);
					jsRemoveWindowLoad();
					if (response.code == 200) {
						Swal.fire({
						  title: '¡Éxito!',
						  text: response.msj,
						  icon: 'success',
						  showCancelButton: false,
						  confirmButtonColor: 'green',
						  confirmButtonText: 'Aceptar'
						}).then((result) => {
							location.reload();
						});
					}
				}, function(errorLog){
					jsRemoveWindowLoad();
					console.log('Error', errorLog);
				})
			}
		});
	}

	$scope.inputCharacters = function(i) {
		i++;
		// if (tipo != '') {
			if (i == 0) {
				$('#nextFocusHeader1').focus();
				$('#nextFocusHeader1').click();
			}else{
				$('#nextFocusHeader1').focus();
				$('#nextFocusHeader1').click();
			}
			// return;
		// }
	}
	
});