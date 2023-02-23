app.controller('VistaProduccionLinea1', function(BASEURL, ID, $scope, $http){
	$scope.maquina = '';
	$scope.nmaquina = '';
	$scope.repoDetallado = false;
	$scope.repoGlobal = true;
	$scope.fechaRepo = '';
	$scope.turnoRepo = '';
	var fechaActual = new Date();
	$scope.fechaActual = fechaActual.toLocaleDateString('en-ZA');
	angular.element('#inputmaquina').focus();

	$http.post('Controller.php', {
		'task': 'getMaquinas'
	}).then(function (response){
		response = response.data;
		console.log('getMaquinas', response);
		$scope.Maquinas = response;
	},function(error){
		console.log('error', error);
	});
	$http.post('Controller.php', {
		'task': 'getTipoMaterial'
	}).then(function (response){
		response = response.data;
		console.log('getTipoMaterial', response);
		$scope.TipoMaterial = response;
	},function(error){
		console.log('error', error);
	});
	$http.post('Controller.php', {
		'task': 'ssProduccionLinea1'
	}).then(function (response){
		response = response.data;
		console.log('ssProduccionLinea1', response);
		$scope.ssProduccionLinea1 = response;
		setTimeout(function(){
			$('#tableserverSideTPLinea1').DataTable({
		        "processing": true,
		        "bDestroy": true,
				"order": [0, 'desc'],
				"lengthMenu": [[30, 50, 75], [30, 50, 75]],
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

	$scope.limpiarCampos = function (){
		$scope.maquina = '';
		$scope.nmaquina = '';
		$scope.tmaterial = '';
	}
	$scope.validaMaquina = function(maquina){
		console.log('maq', maquina);
		$http.post('Controller.php', {
			'task': 'TraerMaquinas',
			'maquina': maquina
		}).then(function (response){
			// response = response.data;
			// console.log('getMaquinas', response.data);
			// $scope.nmaquina = response.data[0].nombre_maq;
			if (response.data.length == 0) {
				Swal.fire({
					title: 'Sin información',
					html: 'No existe información asociada con la maquina '+ maquina +'</b>.',
					icon: 'info',
				}).then((result) => {
					/* Read more about handling dismissals below */
					  if (result.dismiss === Swal.DismissReason.timer) {
						// $scope.folio = '';
				    	angular.element('#inputmaquina').focus();
						$('#inputmaquina').val('');
				    	// location.reload();
					  }else{
					  	// location.reload();
						// $scope.folio = '';
					  	angular.element('#inputmaquina').focus();
					  	$('#inputmaquina').val('');
					  }
				})
			}else{
				console.log('getMaquinas', response.data);
				$scope.nmaquina = response.data[0].nombre_maq;
			}
		}, function(error){
			console.log('error', error);
		});
	}
	$scope.validacionDatos = function(){
		if ($scope.maquina == '' || $scope.maquina == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario seleccionar una máquina',
			  'warning'
			);
			return;
		}
		if ($scope.tmaterial == '' || $scope.tmaterial == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario seleccionar un tipo de material',
			  'warning'
			);
			return;
		}
		Swal.fire({
		  title: 'Estás a punto de capturar una producción en la Linea 1.',
		  text: '¿Es correcta la información agregada?',
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: 'green',
		  cancelButtonColor: 'red',
		  confirmButtonText: 'Aceptar',
		  cancelButtonText: 'Cancelar'
		}).then(function(result){
			if (result.isConfirmed) {
				jsShowWindowLoad('Capturando producción en Linea 1...');
				$http.post('Controller.php', {
					'task': 'guardarProduccionL1',
					'maquina': $scope.maquina,
					'tmaterial': $scope.tmaterial,
					'id': ID,
				}).then(function(response){
					response = response.data;
					console.log('response', response);
					jsRemoveWindowLoad();
					if (response.code == 200) {
						Swal.fire({
						  title: '¡Éxito!',
						  html: 'Su captura de producción en la Linea 1 generó correctamente.\n <b>Folio: ' +response.folio + '</b>',
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
	$scope.sinacceso = function(){
    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
	}
	$scope.eliminartp = function(cve_pt) {
	    $.getJSON("modelo_produccion.php?consultar="+cve_pt, function(registros){
	        console.log(registros);

	        // $('#inputide').val(registros[0]['cve']);
	        // $('#inputmaqe').val(registros[0]['maquina']);
	        // $('#inputfalloe').val(registros[0]['fallo']);
	    });
	    Swal.fire({
			title: 'Eliminar folio',
			html: '¿Realmente desea eliminar el <b>folio '+ cve_pt +'</b>?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			confirmButtonText: 'Aceptar',
			cancelButtonColor: 'red',
			cancelButtonText: 'Cancelar'
	    }).then((result) => {
	    	if (result.isConfirmed) {
	    		jsShowWindowLoad('Elimiando tiempo pérdido...');
	    		$http.post('Controller.php', {
	    			'task': 'EliminarProduccion',
	    			'cve': cve_pt,
	    			'id': ID,
	    		}).then(function(response){
					response = response.data;
					console.log('response', response);
					jsRemoveWindowLoad();
					Swal.fire({
					  title: '¡Éxito!',
					  html: 'Se elimino el folio correctamente.\n <b>Folio: ' +cve_pt + '</b>',
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

	    		}, function (error){
	    			console.log('error', error);
	    			jsRemoveWindowLoad();
	    		})
	    	}
	    })
	}
	$scope.obtenerDatosEdit = function(cve_pt) {
	    $.getJSON("modelo_produccion.php?consultar="+cve_pt, function(registros){
	        // console.log(registros);

	        $('#inputidedit').val(registros[0]['cve_pt']);
	        $('#selectmaquinae').val(registros[0]['cve_maq']);
	        $('#inputtmateriale').val(registros[0]['cve_mt']);

	    });
	}
	$scope.editartp = function(){
		$scope.cve_pte = $('#inputidedit').val();
		$scope.maquinae = $('#selectmaquinae').val();
		$scope.tmateriale = $('#inputtmateriale').val();
		Swal.fire({
		  title: 'Estás a punto de editar una producción.',
		  text: '¿Es correcta la información agregada?',
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: 'green',
		  cancelButtonColor: 'red',
		  confirmButtonText: 'Aceptar',
		  cancelButtonText: 'Cancelar'
		}).then((result) =>{
			jsShowWindowLoad('Editando producción...');
			$http.post('Controller.php', {
    			'task': 'EditarProduccion',
    			'cve': $scope.cve_pte,
    			'maquinae': $scope.maquinae,
    			'tmateriale': $scope.tmateriale,
    			'id': ID,
			}).then(function(response){
				response = response.data;
				console.log('response', response);
				jsRemoveWindowLoad();
				Swal.fire({
				  title: '¡Éxito!',
				  html: 'Se edito el folio correctamente.\n Folio: ' + $scope.cve_pte + '</b>',
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
		})
	}
	$scope.checkTipoRepo = function(tipo){
		if (tipo == 1) {
			$scope.repoGlobal = true;
			$scope.repoDetallado = false;
		}else{
			$scope.repoDetallado = true;
			$scope.repoGlobal = false;
		}
	}
	$scope.checkFecha = function(fecha, test){
		setTimeout(function(){
			$scope.fechaRepo = $('#fechaRepo').val();
		}, 500);
	}
	$scope.getReporte = function(){
		// console.log( $("#turnoRepo option:selected").text());
		jsShowWindowLoad('Creando reporte producción en Linea 1...');
		$http.post('Controller.php', {
			'task': 'getReporte',
			'repo': 1,
			'tipo': ($scope.repoDetallado?'detalle':'global'),
			'datos': {
				'fecha': $scope.fechaRepo,
				'turno': $scope.turnoRepo,
				'turnoDesc': $("#turnoRepo option:selected").text()
			}
		}).then(function (response){
			response = response.data;
			$scope.repoProduccionLinea = response;
			console.log('repoProduccionLinea', response);
			jsRemoveWindowLoad();
			if (response.datos.length > 0) {
				setTimeout(function(){
					imprSelec('reporteProd');
				},350);
			}else{
				Swal.fire(
				  'Sin resultados',
				  '',
				  'warning'
				);
			}

		},function(error){
			console.log('error', error);
		});
	}
});

// LINEA 2

app.controller('VistaProduccionLinea2', function(BASEURL, ID, $scope, $http){
	$scope.maquina = '';
	$scope.nmaquina = '';
	$scope.repoDetallado = false;
	$scope.repoGlobal = true;
	$scope.fechaRepo = '';
	$scope.turnoRepo = '';
	var fechaActual = new Date();
	$scope.fechaActual = fechaActual.toLocaleDateString('en-ZA');
	angular.element('#inputmaquina').focus();

	$http.post('Controller.php', {
		'task': 'getMaquinas'
	}).then(function (response){
		response = response.data;
		console.log('getMaquinas', response);
		$scope.Maquinas = response;
	},function(error){
		console.log('error', error);
	});
	$http.post('Controller.php', {
		'task': 'getTipoMaterial'
	}).then(function (response){
		response = response.data;
		console.log('getTipoMaterial', response);
		$scope.TipoMaterial = response;
	},function(error){
		console.log('error', error);
	});
	$http.post('Controller.php', {
		'task': 'ssProduccionLinea2'
	}).then(function (response){
		response = response.data;
		console.log('ssProduccionLinea2', response);
		$scope.ssProduccionLinea2 = response;
		setTimeout(function(){
			$('#tableserverSideTPLinea2').DataTable({
		        "processing": true,
		        "bDestroy": true,
				"order": [0, 'desc'],
				"lengthMenu": [[30, 50, 75], [30, 50, 75]],
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

	$scope.limpiarCampos = function (){
		$scope.maquina = '';
		$scope.nmaquina = '';
		$scope.tmaterial = '';
	}
	$scope.sinacceso = function(){
    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
	}
	$scope.validaMaquina = function(maquina){
		console.log('maq', maquina);
		$http.post('Controller.php', {
			'task': 'TraerMaquinas',
			'maquina': maquina
		}).then(function (response){
			// response = response.data;
			// console.log('getMaquinas', response.data);
			// $scope.nmaquina = response.data[0].nombre_maq;
			if (response.data.length == 0) {
				Swal.fire({
					title: 'Sin información',
					html: 'No existe información asociada con la maquina '+ maquina +'</b>.',
					icon: 'info',
				}).then((result) => {
					/* Read more about handling dismissals below */
					  if (result.dismiss === Swal.DismissReason.timer) {
						// $scope.folio = '';
				    	angular.element('#inputmaquina').focus();
						$('#inputmaquina').val('');
				    	// location.reload();
					  }else{
					  	// location.reload();
						// $scope.folio = '';
					  	angular.element('#inputmaquina').focus();
					  	$('#inputmaquina').val('');
					  }
				})
			}else{
				console.log('getMaquinas', response.data);
				$scope.nmaquina = response.data[0].nombre_maq;
			}
		}, function(error){
			console.log('error', error);
		});
	}
	$scope.validacionDatos = function(){
		if ($scope.maquina == '' || $scope.maquina == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario seleccionar una máquina',
			  'warning'
			);
			return;
		}
		if ($scope.tmaterial == '' || $scope.tmaterial == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario seleccionar un tipo de material',
			  'warning'
			);
			return;
		}
		Swal.fire({
		  title: 'Estás a punto de capturar una producción en la Linea 1.',
		  text: '¿Es correcta la información agregada?',
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: 'green',
		  cancelButtonColor: 'red',
		  confirmButtonText: 'Aceptar',
		  cancelButtonText: 'Cancelar'
		}).then(function(result){
			if (result.isConfirmed) {
				jsShowWindowLoad('Capturando producción en Linea 1...');
				$http.post('Controller.php', {
					'task': 'guardarProduccionL2',
					'maquina': $scope.maquina,
					'tmaterial': $scope.tmaterial,
					'id': ID,
				}).then(function(response){
					response = response.data;
					console.log('response', response);
					jsRemoveWindowLoad();
					if (response.code == 200) {
						Swal.fire({
						  title: '¡Éxito!',
						  html: 'Su captura de producción en la Linea 1 generó correctamente.\n <b>Folio: ' +response.folio + '</b>',
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
	$scope.eliminartp = function(cve_pt) {
	    $.getJSON("modelo_produccion.php?consultar="+cve_pt, function(registros){
	        console.log(registros);

	        // $('#inputide').val(registros[0]['cve']);
	        // $('#inputmaqe').val(registros[0]['maquina']);
	        // $('#inputfalloe').val(registros[0]['fallo']);
	    });
	    Swal.fire({
			title: 'Eliminar folio',
			html: '¿Realmente desea eliminar el <b>folio '+ cve_pt +'</b>?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			confirmButtonText: 'Aceptar',
			cancelButtonColor: 'red',
			cancelButtonText: 'Cancelar'
	    }).then((result) => {
	    	if (result.isConfirmed) {
	    		jsShowWindowLoad('Elimiando tiempo pérdido...');
	    		$http.post('Controller.php', {
	    			'task': 'EliminarProduccion',
	    			'cve': cve_pt,
	    			'id': ID,
	    		}).then(function(response){
					response = response.data;
					console.log('response', response);
					jsRemoveWindowLoad();
					Swal.fire({
					  title: '¡Éxito!',
					  html: 'Se elimino el folio correctamente.\n <b>Folio: ' +cve_pt + '</b>',
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

	    		}, function (error){
	    			console.log('error', error);
	    			jsRemoveWindowLoad();
	    		})
	    	}
	    })
	}
	$scope.obtenerDatosEdit = function(cve_pt) {
	    $.getJSON("modelo_produccion.php?consultar="+cve_pt, function(registros){
	        // console.log(registros);

	        $('#inputidedit').val(registros[0]['cve_pt']);
	        $('#selectmaquinae').val(registros[0]['cve_maq']);
	        $('#inputtmateriale').val(registros[0]['cve_mt']);

	    });
	}
	$scope.editartp = function(){
		$scope.cve_pte = $('#inputidedit').val();
		$scope.maquinae = $('#selectmaquinae').val();
		$scope.tmateriale = $('#inputtmateriale').val();
		Swal.fire({
		  title: 'Estás a punto de editar una producción.',
		  text: '¿Es correcta la información agregada?',
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: 'green',
		  cancelButtonColor: 'red',
		  confirmButtonText: 'Aceptar',
		  cancelButtonText: 'Cancelar'
		}).then((result) =>{
			jsShowWindowLoad('Editando producción...');
			$http.post('Controller.php', {
    			'task': 'EditarProduccion',
    			'cve': $scope.cve_pte,
    			'maquinae': $scope.maquinae,
    			'tmateriale': $scope.tmateriale,
    			'id': ID,
			}).then(function(response){
				response = response.data;
				console.log('response', response);
				jsRemoveWindowLoad();
				Swal.fire({
				  title: '¡Éxito!',
				  html: 'Se edito el folio correctamente.\n Folio: ' + $scope.cve_pte + '</b>',
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
		})
	}
	$scope.checkTipoRepo = function(tipo){
		if (tipo == 1) {
			$scope.repoGlobal = true;
			$scope.repoDetallado = false;
		}else{
			$scope.repoDetallado = true;
			$scope.repoGlobal = false;
		}
	}
	$scope.checkFecha = function(fecha, test){
		setTimeout(function(){
			$scope.fechaRepo = $('#fechaRepo').val();
		}, 500);
	}
	$scope.getReporte = function(){
		jsShowWindowLoad('Creando reporte producción en Linea 2...');
		$http.post('Controller.php', {
			'task': 'getReporte',
			'repo': 2,
			'tipo': ($scope.repoDetallado?'detalle':'global'),
			'datos': {
				'fecha': $scope.fechaRepo,
				'turno': $scope.turnoRepo,
				'turnoDesc': $("#turnoRepo option:selected").text()
			}
		}).then(function (response){
			response = response.data;
			$scope.repoProduccionLinea = response;
			jsRemoveWindowLoad();
			if (response.datos.length > 0) {
				setTimeout(function(){
					imprSelec('reporteProd');
				},350);
			}else{
				Swal.fire(
				  'Sin resultados',
				  '',
				  'warning'
				);
			}
		},function(error){
			console.log('error', error);
		});
	}
})

function imprSelec(id) {
	var div = document.getElementById(id);
    var ventimp = window.open(' ', 'popimpr');
    ventimp.document.write( div.innerHTML );
    ventimp.document.close();
    ventimp.print( );
    ventimp.close();
    console.log('ok');
}