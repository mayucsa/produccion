app.controller('vistaConfirmarDesalojo', function(BASEURL, ID, $scope, $http){
	$scope.folio = '';
	$scope.producto = '';
	$scope.estiba = '';
	$scope.modalMisRequ = false;

	$http.post('Controller.php', {
		'task': 'ssConfirmacionsDesalojo'
	}).then(function (response){
		response = response.data;
		$scope.ssConfirmacionsDesalojo = response;
		setTimeout(function(){
			$('#tablaConfirmacion').DataTable({
		        "processing": true,
		        "bDestroy": true,
				"order": [0, 'desc'],
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
	},function(error){
		console.log('error', error);
	});

	$scope.setModalMisRequ = function(cve_desalojo){
		if ($scope.modalMisRequ == false) {
			$scope.modalMisRequ = true;
			$scope.pintarmodal(cve_desalojo);
	    // $.getJSON("modelo_confirmacion.php?consultar="+cve_desalojo, function(registros){
	    //     console.log(registros);
	    // });
		}else{
			$scope.modalMisRequ = false;
			$scope.estiba = '';
		}
		// console.log($scope.modalMisRequ);
	}

	$scope.pintarmodal = function(cve_desalojo){
	    $.getJSON("modelo_confirmacion.php?consultar="+cve_desalojo, function(registros){
	        console.log(registros);

	        // $scope.folio = registros[0]['cve_bloquera'];

	        $('#inputfolio').val(registros[0]['cve_desalojo']);
	        $('#inputidproducto').val(registros[0]['cve_bloquera']);
	        $('#inputproducto').val(registros[0]['nombre_producto']);
	        $('#inputdesalojo').val(registros[0]['cantidad_total']);
	        $('#inputdespuntado').val(registros[0]['cantidad_despuntados']);
	        $('#inputrotura').val(registros[0]['cantidad_rotura']);

	    });
	}

	$scope.confirmar = function(){
		$scope.folio = $('#inputfolio').val();
		if ($scope.estiba == '' || $scope.estiba == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario indicar el número de estiba',
			  'warning'
			);
			return;
		}

		Swal.fire({
			title: 'Confirmación de estiba',
			html: '¿Realmente deseas confirmar la estiba con <b>folio '+ $scope.folio +'</b>?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			confirmButtonText: 'Aceptar',
			cancelButtonColor: 'red',
			cancelButtonText: 'Cancelar'	
		}).then((result) => {
			if (result.isConfirmed) {
				jsShowWindowLoad('Capturando estiba...');
				$http.post('Controller.php', {
					'task': 'generarEstiba',
					'folio': $scope.folio,
					'estiba': $scope.estiba,
					'id': ID,
				}).then(function(response){
					response = response.data;
					// console.log('response', response);
					jsRemoveWindowLoad();
					let timerInterval
					Swal.fire({
					  title: 'Éxito!',
					  html: 'Su captura de estiba generó correctamente.\n <b>Estiba: ' + $scope.estiba + '</b>',
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
					// Swal.fire({
					// 	  title: '¡Éxito!',
					// 	  html: 'Su captura de estiba generó correctamente.\n <b>Estiba: ' + $scope.estiba + '</b>',
					// 	  icon: 'success',
					// 	  showCancelButton: false,
					// 	  confirmButtonColor: 'green',
					// 	  confirmButtonText: 'Aceptar'
					// 	}).then((result) => {
					// 	  if (result.isConfirmed) {
					// 	  	location.reload();
					// 	  }else{
					// 	  	location.reload();
					// 	  }
					// 	});
				}, function(error){
					console.log('error', error);
					jsRemoveWindowLoad();
				});
			}
		})
	}

	$scope.validaEstiba = function(estiba){
		$scope.folio = $('#inputfolio').val();
		$scope.idproducto = $('#inputidproducto').val();

		$scope.desalojo = $('#inputdesalojo').val();
		$scope.despuntado = $('#inputdespuntado').val();
		$scope.rotura = $('#inputrotura').val();

		// console.log('folio', $scope.folio);
		// console.log('producto', $scope.producto);
		// console.log('estiba', $scope.estiba);
		// if (estiba > 0) {
		// 	console.log('folio', $scope.folio)
		// 	console.log('estiba', $scope.estiba)
		// 	jsShowWindowLoad('Validando existencia de estiba...');
		// }
		// if () {}

		if (estiba > 0) {
			switch ($scope.idproducto) {
				case '1':
					if (estiba >= 200 & estiba <= 299 ) {
						$scope.confirmar();
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
						$("#inputestiba").val('');
					}
					break;
				case '2':
					if (estiba >= 600 & estiba <= 699 ) {
						$scope.confirmar();
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
						$("#inputestiba").val('');
					}
					break;
				case '3':
					if (estiba >= 300 & estiba <= 399 ) {
						$scope.confirmar();
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
						$("#inputestiba").val('');
					}
					break;
			}
		}
	}

	$scope.sweet = function(){
		let timerInterval
		Swal.fire({
		  title: 'Éxito!',
		  html: 'Su captura de estiba generó correctamente.\n <b>Estiba: ' + $scope.estiba + '</b>',
		  timer: 4000,
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
	}

	$scope.obtenerDatosEdit = function(cve_desalojo){
	    $.getJSON("modelo_confirmacion.php?consultar="+cve_desalojo, function(registros){
	        console.log(registros);

	        // var cve_desalojo = registros[0]['cve_desalojo'];
	        // cantidad_entrada = registros[0]['cantidad_entrada'];
	        // console.log(cve_desalojo);
	        // console.log(cantidad_entrada);

	        // $scope.productoe = registros[0]['cve_mp'];
	        // $scope.cantidade = registros[0]['cantidad_entrada'];
	        // $scope.productoe = cve_mp;
	        // $scope.cantidade = cantidad_entrada;
	        $('#inputfolioe').val(registros[0]['cve_desalojo']);
	        $('#selectproductoe').val(registros[0]['cve_bloquera']);
	        $('#inputdesalojoe').val(registros[0]['cantidad_total']);
	        $('#inputdespuntadose').val(registros[0]['cantidad_despuntados']);
	        $('#inputroturae').val(registros[0]['cantidad_rotura']);
	        // $('#inputfalloe').val(registros[0]['fallo']);
	    });

	}

	$scope.editar = function(){
		$scope.folioe = $('#inputfolioe').val();
		$scope.desalojoe = $('#inputdesalojoe').val();
		$scope.despuntadose = $('#inputdespuntadose').val();
		$scope.roturae = $('#inputroturae').val();
		// console.log('folio', $scope.folioe);
		// console.log('desalojo', $scope.desalojoe);
		// console.log('despuntado', $scope.despuntadose);
		// console.log('rotura', $scope.roturae);

		Swal.fire({
			title: 'Editar folio',
			html: '¿Realmente desea editar el <b>folio '+ $scope.folioe +'</b>?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			confirmButtonText: 'Aceptar',
			cancelButtonColor: 'red',
			cancelButtonText: 'Cancelar'	
		}).then((result) => {
			if (result.isConfirmed) {
				jsShowWindowLoad('Editando desalojo de bloquera...');
				$http.post('Controller.php', {
	    			'task': 'editar',
	    			'folio': $scope.folioe,
	    			'desalojoe': $scope.desalojoe,
	    			'despuntadoe': $scope.despuntadose,
	    			'roturae': $scope.roturae,
	    			'id': ID,
				}).then(function(response){
					response = response.data;
					console.log('response', response);
					jsRemoveWindowLoad();
					Swal.fire({
					  title: '¡Éxito!',
					  html: 'Se edito el folio del desalojo  correctamente.\n <b>Folio: ' + $scope.folioe + '</b>',
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

})