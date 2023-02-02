app.controller('vistaMovtosPorteria', function(BASEURL, ID, $scope, $http){
	$scope.folio = '';
	angular.element('#nextFocusHeader0').focus();
	// $scope.folio =  undefined;

	$http.post('Controller.php', {
		'task': 'ssMovtos'
	}).then(function (response){
		response = response.data;
		$scope.ssMovtos = response;
		// console.log(response.data);
		setTimeout(function(){
			$('#tablaMovtos').DataTable({
		        "processing": true,
		        "bDestroy": true,
				"order": [3, 'desc']+[4, 'desc'],
				"lengthMenu": [[50, 100, 150], [50, 100, 150]],
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

	$scope.setModalMisRequ = function(response){
		if ($scope.modalMisRequ == true) {
			$scope.modalMisRequ = false;
			// $scope.pintarmodal(response);
		}else{
			$scope.modalMisRequ = true;
			$('#nextFocusHeader0').val('');
			angular.element('#nextFocusHeader0').focus();
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
			// response = response.data;
			console.log('admDocumentosDetalle: ',response.data);
			if (response.data.length == 0) {
				// Swal.fire('Sin información','No existe información asociada al <b>folio '+ folio +'</b> ingresado. ','error');
				// 	angular.element('#nextFocusHeader0').focus();
				// 	$scope.folio = '';
				Swal.fire({
					title: 'Sin información',
					html: 'No existe información asociada al <b>folio '+ folio +'</b> ingresado.',
					icon: 'error',
				}).then((result) => {
					/* Read more about handling dismissals below */
					  if (result.dismiss === Swal.DismissReason.timer) {
						// $scope.folio = '';
				    	angular.element('#nextFocusHeader0').focus();
						$('#nextFocusHeader0').val('');
				    	// location.reload();
					  }else{
					  	// location.reload();
						// $scope.folio = '';
					  	angular.element('#nextFocusHeader0').focus();
					  	$('#nextFocusHeader0').val('');
					  }
				})
			}else{
				switch(response.data[0].ESTATUS_DOCUMENTO){
				case '1':
					$scope.Cliente = response.data[0].CRAZONSOCIAL;
					$http.post('Controller.php', {
						'task': 'entradaFolio',
						'folio': folio,
						'id': ID,
					}).then(function(response){
						response = response.data;
						console.log('response', response);
						jsRemoveWindowLoad();
						let timerInterval
						Swal.fire({
						  title: 'Éxito!',
						  html: 'Entrada generada correctamente.\n <b>Folio: ' + folio + '</b>',
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
					break;
				case '4':
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
				                '<td style="dislay: none;">' + response.data[i].CIDPRODUCTO + '</td>'+
				                '<td style="dislay: none;">' + response.data[i].CNOMBREPRODUCTO + '</td>'+
				                '<td style="dislay: none;">' + response.data[i].CUNIDADESCAPTURADASO + ' ' +response.data[i].CUNIDADMEDIDA + ' / ' + response.data[i].SERVOBSERVAMOV +'</td>'+ 
				                '</td>'
				                +'</tr>');
				        }
					// $http.post('Controller.php', {
					// 	'task': 'salidaFolio',
					// 	'folio': folio,
					// 	'id': ID,
					// }).then(function(response){
					// 	response = response.data;
					// 	console.log('response', response);
					// 	jsRemoveWindowLoad();
					// 	let timerInterval
					// 	Swal.fire({
					// 	  title: 'Éxito!',
					// 	  html: 'Salida generada correctamente.\n <b>Folio: ' + folio + '</b>',
					// 	  timer: 4000,
					// 	  timerProgressBar: true,
					// 	  didOpen: () => {
					// 	    Swal.showLoading()
					// 	    const b = Swal.getHtmlContainer().querySelector('b')
					// 	    timerInterval = setInterval(() => {
					// 	      // b.textContent = Swal.getTimerLeft()
					// 	    }, 100)
					// 	  },
					// 	  willClose: () => {
					// 	    clearInterval(timerInterval)
					// 	  }
					// 	}).then((result) => {
					// 	  if (result.dismiss === Swal.DismissReason.timer) {
					// 	    location.reload();
					// 	  }else{
					// 	  	location.reload();
					// 	  }
					// 	})
					// }, function(error){
					// 	console.log('error', error);
					// 	jsRemoveWindowLoad();
					// })
					break;
				case '2':
						Swal.fire('Revisar','El <b>folio '+ folio+'</b> ya ingreso a planta. Verificar la información. ','info');
						angular.element('#nextFocusHeader0').focus();
					  	$('#nextFocusHeader0').val('');
					break;
				case '3':
						Swal.fire('Revisar','El <b>folio '+ folio+'</b> no ha sido despachado. Verificar la información. ','info');
						angular.element('#nextFocusHeader0').focus();
					  	$('#nextFocusHeader0').val('');
					break;
				case '5':
						Swal.fire('Revisar','El <b>folio '+ folio+'</b> ha salido de planta. Verificar la información. ','info');
						angular.element('#nextFocusHeader0').focus();
					  	$('#nextFocusHeader0').val('');
					break;
				default:
					Swal.fire('Sin Movimientos','El folio <b>'+ $scope.folio +'</b> no registro movimientos en planta','error');
						angular.element('#nextFocusHeader0').focus();
					  	$('#nextFocusHeader0').val('');
				}
			}
		}, function(caseError){
			jsRemoveWindowLoad();
			console.log('Error', caseError);
		})
	}
	$scope.verificar = function(){
		$scope.documento = $('#inputdocumento').val();
		$scope.foliov = $('#foliov').val();

		Swal.fire({
			title: '¡Confirmación!',
			html: '¿Verificaste que el producto en la nota con <b>folio '+ $scope.folio +'</b> sea el correcto dentro del vehiculo?',
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
					'folio': $scope.documento,
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
					  html: 'El vehiculo puede proceder a salir de planta...',
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
});