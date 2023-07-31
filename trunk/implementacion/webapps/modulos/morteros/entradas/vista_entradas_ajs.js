app.controller('vistaEntradasMorteros', function (BASEURL, ID, $scope, $http){
	$scope.materiaprima = '';
	$scope.cantidad = '';
	$scope.folioe = '';
	$scope.emateriaprima = '';
	$scope.cantidade = '';

// TABLA GLOBAL MATERIA PRIMA / SACOS
	$http.post('Controller.php', {
		'task': 'getMisEntradas'
	}).then(function (response){
		response = response.data;
		$scope.datosMateriaPrima = response;
		setTimeout(function(){
			$('#tablaEntradas').DataTable({
		        "processing": true,
		        "bDestroy": true,
		        "order": [0, 'desc'],
				"lengthMenu": [[30, 50, 75], [30, 50, 75]],
				// "columnDefs":[
                //             {
                //                 "targets": [3],
                //                 "render": $.fn.dataTable.render.number(',', '.', 0, '')
                //                 // "render": $.fn.dataTable.render.number(',', '.', 3, '');
                //             }
                //         ],
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

	$http.post('Controller.php', {
		'task': 'getMateriaPrima'
	}).then(function (response){
		response = response.data;
		console.log('getMateriaPrima', response);
		$scope.mp = response;
	},function(error){
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
		$scope.materiaprima = '';
		$scope.cantidad = '';
		$scope.saco = '';
		$scope.cantidads = '';
	}

	$scope.validacionCampos = function(){
		if ($scope.materiaprima == '' || $scope.materiaprima == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario seleccionar una materia prima',
			  'warning'
			);
			return;
		}
		if ($scope.cantidad == '' || $scope.cantidad == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario escribir una cantidad correcta',
			  'warning'
			);
			return;
		}
		console.log('materiaprima', $scope.materiaprima);
		console.log('cantidad', $scope.cantidad);
		console.log('id', ID);
		Swal.fire({
		  title: 'Estás a punto de generar una entrada.',
		  text: '¿Es correcta la información agregada?',
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: 'green',
		  cancelButtonColor: 'red',
		  confirmButtonText: 'Aceptar',
		  cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				jsShowWindowLoad('Generando entrada...');
				$http.post('Controller.php', {
					'materiaprima': $scope.materiaprima,
					'cantidad': $scope.cantidad,
					'id': ID,
					'task': 'GuardarEntrada',
				}).then(function(response){
					response = response.data;
					// console.log('response', response.data);
	    			jsRemoveWindowLoad();
	    			if (response.code == 200) {
	    				Swal.fire({
						  title: '¡Éxito!',
						  html: 'Se registro la entrada se registro correctamente,<br> <b>Folio de entrada: ' + response.folio +'</b>',
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
		});
	}

	$scope.consultar = function(cve_entrada, cve_mp, cantidad){
		console.log('cve', cve_entrada);
		console.log('cvemp', cve_mp);
		$scope.folioe = cve_entrada;
		$scope.emateriaprima = cve_mp;
		$scope.cantidade = cantidad;
		$scope.cantoriginal = cantidad;
		// $('#emateriaprima').val([0]['cve_entrada']);
		// $('#folioe').val([0]['cve_entrada']);
	}

	$scope.editar = function(){
		console.log('folio', $scope.folioe);
		console.log('cvemp', $scope.emateriaprima);
		console.log('cantidad', $scope.cantidade);
		console.log('original', $scope.cantoriginal);
		if ($scope.cantidade == '' || $scope.cantidade == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario escribir una cantidad correcta',
			  'warning'
			);
			return;
		}
		Swal.fire({
			title: 'Estás a punto de editar la cantidad de una entrada.',
			text: '¿Es correcta la información agregada?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			cancelButtonColor: 'red',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				jsShowWindowLoad('Generando entrada...');
				$http.post('Controller.php', {
					'task': 'editar',
					'folio': $scope.folioe,
					'cvemp': $scope.emateriaprima,
					'cantidad': $scope.cantidade,
					'original': $scope.cantoriginal,
					'id': ID,
				}).then(function(response){
					jsRemoveWindowLoad();
					Swal.fire({
						title: '¡Éxito!',
						html: 'Se editado la entrada de manera correctamente,<br> <b>Folio de entrada: ' + $scope.folioe +'</b>',
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
					})
				}, function(error){
					console.log('error', error);
	    			jsRemoveWindowLoad();
				})
			}
		});

	}

	$scope.eliminar = function(cve_entrada, cantidad, cvemp){
		console.log('cve', cve_entrada);
		console.log('cvemp', cvemp);
		console.log('cantidad', cantidad);
		Swal.fire({
			title: 'Eliminar entrada',
			html: '¿Realmente desea eliminar el <b>folio '+ cve_entrada +'</b>?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			confirmButtonText: 'Aceptar',
			cancelButtonColor: 'red',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				jsShowWindowLoad('Eliminando entrada de morteros...');
				$http.post('Controller.php', {
					'task': 'eliminar',
					'cve': cve_entrada,
					'cvemp': cvemp,
					'cantidad': cantidad,
					'id': ID,
				}).then(function(response){
					response = response.data;
					console.log('response', response);
					jsRemoveWindowLoad();
					Swal.fire({
					  title: '¡Éxito!',
					  html: 'Se elimino la entrada correctamente.\n <b>Folio: ' + cve_entrada + '</b>',
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