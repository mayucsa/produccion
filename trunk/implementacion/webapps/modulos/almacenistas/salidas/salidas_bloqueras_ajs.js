app.controller('vistaDespachoBloqueras', function(BASEURL, ID, $scope, $http){
	$scope.folio = '';
	$scope.folioe = '';
	let myModal = new bootstrap.Modal(document.getElementById('firmasModal'), {
	  keyboard: false
	})
	angular.element('#nextFocusHeader0').focus();
	$scope.modalMisEstiba = false;

	$http.post('Controller.php', {
		'task': 'tSalidasBloquera'
	}).then(function (response){
		response = response.data;
		console.log('tSalidasBloquera', response);
		$scope.tSalidasBloquera = response;
		setTimeout(function(){
			$('#tableSalidasBloquera').DataTable({
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

	$scope.setModalEstiba = function(CFOLIO){
		if ($scope.modalMisEstiba == false) {
			$scope.modalMisEstiba = true;
			$scope.modalestiba(CFOLIO);
	    // $.getJSON("modelo_confirmacion.php?consultar="+cve_desalojo, function(registros){
	    //     console.log(registros);
	    // });
		}else{
			$scope.modalMisEstiba = false;
			$scope.estiba = '';
		}
		// console.log($scope.modalMisRequ);
	}

	$scope.modalestiba = function(CFOLIO){
		$http.post('Controller.php', {
			'task': 'tEstibasBloquera',
			'CFOLIO': CFOLIO,
		}).then(function (response) {
			response = response.data;
			console.log('tEstibasBloquera', response);
			$scope.folioe = CFOLIO;
			$scope.tEstibasBloquera = response;
		})
	}

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
		});
	}

	$scope.limpiarCampos = function() {
		$scope.folio = '';
		$scope.cliente = '';
		$scope.placas = '';
		$scope.admDocumentosDetalle = [];
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
				                '<td style="dislay: none;">' + response.data[i].CIDPRODUCTO + '</td>'+
				                '<td style="dislay: none;">' + response.data[i].CNOMBREPRODUCTO + '</td>'+
				                '<td style="dislay: none;">' + response.data[i].CUNIDADESCAPTURADAS + '</td>'+ 
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
				case '4':
					Swal.fire('Pedido surtido','El folio <b>'+ folio +'</b> ya fue surtido, favor de verificar la información','error');
						angular.element('#nextFocusHeader0').focus();
					  	$('#nextFocusHeader0').val('');
					break;
				case '5':
					// $scope.setModalMisRequ();
					Swal.fire('Revisión','El folio <b>'+ folio +'</b> ya registro salida en planta','error');
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
		});
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
					'id': ID
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
	$scope.validaExistencia =  function(i){
		const estiba = $scope.tEstibasBloquera[i].estiba;
		const idproducto = $scope.tEstibasBloquera[i].cod_producto;
		const cantidad = parseFloat($scope.tEstibasBloquera[i].cantidad_salida);
		console.log('validaExistencia', $scope.tEstibasBloquera[i]);
		if (cantidad > 0) {
			// console.log('cantidades', cantidad)
			jsShowWindowLoad('Validando cantidades...');
			$http.post('Controller.php', {
				'task': 'validaExistencia',
				'idproducto': idproducto,
				'estiba': $scope.tEstibasBloquera[i].estiba,
				'cantidad': cantidad,
			}).then(function(response){
				response = response.data;
				jsRemoveWindowLoad();
				if (!response.cantidad) {
					Swal.fire({
						title: 'Error',
						text: response.msj,
						icon: 'error'
					});
					$scope.$apply(function(){
						$scope.tEstibasBloquera[i].estiba = '';
					}, 500);
				}
				if (response.msj != 'ok') {
					Swal.fire({
					  title: 'Estiba sin existencia ',
					  text: response.msj,
					  icon: 'warning',
					  showCancelButton: false,
					  confirmButtonColor: 'green',
					  confirmButtonText: 'Aceptar'
					}).then((result) => {
						if (response.cantidad > 0) {
							$scope.$apply(function(){
								$scope.tEstibasBloquera[i].cantidad_salida = response.cantidad;
							}, 500);
						}else{
							$scope.$apply(function(){
								$scope.tEstibasBloquera[i].estiba = '';
							}, 500);
						}
					})
				}
			}, function(error){
				console.log('error', error);
				jsRemoveWindowLoad();
			})
		}
	}
	$scope.validaEstiba = function(i){
		const estiba = $scope.tEstibasBloquera[i].estiba;
		const idproducto = $scope.tEstibasBloquera[i].cod_producto;
		if (estiba > 0) {
			switch (idproducto) {
				case 'B201':
					if (estiba >= 200 & estiba <= 299 ) {
						$scope.validaExistencia(i);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
						$scope.tEstibasBloquera[i].estiba = '';
					}
					break;
				case 'B304':
					if (estiba >= 600 & estiba <= 699 ) {
						$scope.validaExistencia(i);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
						$scope.tEstibasBloquera[i].estiba = '';
					}
					break;
				case 'B301':
					if (estiba >= 300 & estiba <= 399 ) {
						$scope.validaExistencia(i);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
						$scope.tEstibasBloquera[i].estiba = '';
					}
					break;
				case 'B101':
					if (estiba >= 100 & estiba <= 199 ) {
						$scope.validaExistencia(i);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
						$scope.tEstibasBloquera[i].estiba = '';
					}
					break;
				case 'B206':
					if (estiba >= 700 & estiba <= 799 ) {
						$scope.validaExistencia(i);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
						$scope.tEstibasBloquera[i].estiba = '';
					}
					break;
				case 'B401':
					if (estiba >= 400 & estiba <= 499 ) {
						$scope.validaExistencia(i);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
						$scope.tEstibasBloquera[i].estiba = '';
					}
					break;
				case 'B501':
					if (estiba >= 500 & estiba <= 599 ) {
						$scope.validaExistencia(i);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
						$scope.tEstibasBloquera[i].estiba = '';
					}
					break;
				case 'B801':
					if (estiba >= 800 & estiba <= 899 ) {
						$scope.validaExistencia(i);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
						$scope.tEstibasBloquera[i].estiba = '';
					}
					break;
				case 'B901':
					if (estiba >= 900 & estiba <= 999 ) {
						$scope.validaExistencia(i);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
						$scope.tEstibasBloquera[i].estiba = '';
					}
					break;
				case 'B001':
					if (estiba >= 1 & estiba <= 99 ) {
						$scope.validaExistencia(i);
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Estiba',
							text: 'El numero de estiba no corresponde al producto'
						})
						$scope.tEstibasBloquera[i].estiba = '';
					}
					break;
			}
		}
	}
	$scope.setNumerico = function(numero){
		if (numero == undefined) return;
		var aux = '';
		for (var x = 0; x < numero.length; x++) {
			if (!isNaN(numero[x])) {
				aux = aux +''+numero[x];
			}else{
				if (numero[x] == '.') {
					if ((numero.substring(0, x+1)).split('.').length == 2) {
						aux = aux +''+numero[x];
					}
				}
			}
		}
		return aux;
	}
	$scope.checkCantSalidas = function(i){
		$scope.tEstibasBloquera[i].cantidad_salida = $scope.setNumerico($scope.tEstibasBloquera[i].cantidad_salida);
		if (	parseFloat($scope.tEstibasBloquera[i].CUNIDADESCAPTURADAS) 
				< 
				parseFloat($scope.tEstibasBloquera[i].cantidad_salida)	) {
			Swal.fire({
				icon: 'warning',
				title: 'Cantidad  excedente',
				text: 'El campo cantidad a surtir no puede ser mayor al campo cantidad.'
			});
			$scope.tEstibasBloquera[i].cantidad_salida = $scope.tEstibasBloquera[i].CUNIDADESCAPTURADAS;
			return;
		}
	}
	$scope.validacionCampos = function(){
		// for (var i = 0; i < $scope.admDocumentosDetalle.length; i++) {
		// 	if ($scope.admDocumentosDetalle[i].ESTATUS_DOCUMENTO == 3) {
		// 		const cantidades = $scope.admDocumentosDetalle[i].cantidad_salida;
		// 		if (parseFloat(cantidades) <= 0 || cantidades == undefined) {
		// 			console.log('cantidades', cantidades, parseFloat(cantidades));
		// 			Swal.fire({
		// 				icon: 'warning',
		// 				title: 'Cantidad  a surtir',
		// 				text: 'Éste campo debe contener un dato correcto.'
		// 			});
		// 			return;
		// 		}
		// 		const estibas = $scope.admDocumentosDetalle[i].estiba;
		// 		console.log('estiba', estibas);
		// 		if (parseFloat(estibas) <= 0 || estibas == undefined) {
		// 			Swal.fire({
		// 				icon: 'warning',
		// 				title: 'Estiba',
		// 				text: 'Éste campo debe contener un dato correcto.'
		// 			});
		// 			return;
		// 		}
		// 	}
		// }
		const miFirma = miCanvas.toDataURL();
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
				// jsShowWindowLoad('Esperando firma...');
				myModal.show();
				return;
			}
			// else{
			// 	console.log('sin Confirmar');
			// }
		});
	}
	$scope.validacionCamposFinal = function(){
		if (lineas.length == 0) {
			Swal.fire({
				icon: 'warning',
				title: 'Sin firma',
				text: 'Es necesario ingresar su firma'
			});
			myModal.show();
			return;
		}
		myModal.hide();
		jsShowWindowLoad('Surtiendo pedido...');
		const miFirma = miCanvas.toDataURL();
		$http.post('Controller.php', {
			'task': 'despacharProducto',
			'datos': $scope.admDocumentosDetalle,
			'folio': $scope.folio,
			'firma': miFirma
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
		});
	}
	$scope.cancelarFirma = function(){
		myModal.hide();
	}
	$scope.aceptarFirma = function(){
		$scope.validacionCamposFinal();
	}
	$scope.validacionEstiba = function(){
		for (var i = 0; i < $scope.tEstibasBloquera.length; i++) {
			// if ($scope.tEstibasBloquera[i].ESTATUS_DOCUMENTO == 3) {
				const cantidades = $scope.tEstibasBloquera[i].cantidad_salida;
				if (parseFloat(cantidades) <= 0 || cantidades == undefined) {
					console.log('cantidades', cantidades, parseFloat(cantidades));
					Swal.fire({
						icon: 'warning',
						title: 'Cantidad  a surtir',
						text: 'Éste campo debe contener un dato correcto.'
					});
					return;
				}
				const estibas = $scope.tEstibasBloquera[i].estiba;
				console.log('estiba', estibas);
				if (parseFloat(estibas) <= 0 || estibas == undefined) {
					Swal.fire({
						icon: 'warning',
						title: 'Estiba',
						text: 'Éste campo debe contener un dato correcto.'
					});
					return;
				}
			// }
		}
		Swal.fire({
			title: 'Descontar estiba',
			html: '¿Esta correcta la información de la nota <b>'+ $scope.folioe +'</b> ?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			confirmButtonText: 'Aceptar',
			cancelButtonColor: 'red',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				jsShowWindowLoad('Descontando inventario de estibas...');
				$http.post('Controller.php', {
					'task': 'descontarEstiba',
					'datos': $scope.tEstibasBloquera,
					'folio': $scope.folioe
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
				});
			}
			// else{
			// 	console.log('sin Confirmar');
			// }
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

	$scope.inputCharacteres = function(i, cliente = '') {
		i++;
		if (cliente != '') {
			if (i == 1) {
				$('#nextFocusHeader1').focus();
				$('#nextFocusHeader1').click();
			}else{
				$('#nextFocusHeader'+i).focus();
			}
			return;
		}
		if (i == $scope.ordenCompraDetalle.length ) {
			$('#nextFocusHeader0').focus();
		}else{
			$('#nextFocus'+i).focus();
		}
	}
})

//======================================================================
// VARIABLES
//======================================================================
let miCanvas = document.querySelector('#pizarra');
let lineas = [];
let correccionX = 0;
let correccionY = 0;
let pintarLinea = false;
// Marca el nuevo punto
let nuevaPosicionX = 0;
let nuevaPosicionY = 0;

let posicion = miCanvas.getBoundingClientRect()
correccionX = posicion.x;
correccionY = posicion.y;

miCanvas.width = 500;
miCanvas.height = 300;

//======================================================================
// FUNCIONES
//======================================================================

/**
 * Funcion que empieza a dibujar la linea
 */
function empezarDibujo() {
    pintarLinea = true;
    lineas.push([]);
};
/**
 * Funcion que guarda la posicion de la nueva línea
 */
function guardarLinea() {
    lineas[lineas.length - 1].push({
        x: nuevaPosicionX,
        y: nuevaPosicionY
    });
}

/**
 * Funcion dibuja la linea
 */
function dibujarLinea(event) {
    event.preventDefault();
    if (pintarLinea) {
        let ctx = miCanvas.getContext('2d')
        // Estilos de linea
        ctx.lineJoin = ctx.lineCap = 'round';
        ctx.lineWidth = 2;
        // Color de la linea
        ctx.strokeStyle = 'black';
        // Marca el nuevo punto
        if (event.changedTouches == undefined) {
            // Versión ratón
            nuevaPosicionX = event.layerX;
            nuevaPosicionY = event.layerY;
        } else {
            // Versión touch, pantalla tactil
            nuevaPosicionX = event.changedTouches[0].pageX - correccionX;
            nuevaPosicionY = event.changedTouches[0].pageY - correccionY;
        }
        // Guarda la linea
        guardarLinea();
        // Redibuja todas las lineas guardadas
        ctx.beginPath();
        lineas.forEach(function (segmento) {
            ctx.moveTo(segmento[0].x, segmento[0].y);
            segmento.forEach(function (punto, index) {
                ctx.lineTo(punto.x, punto.y);
            });
        });
        ctx.stroke();
    }
}
function limpiar(){
	lineas = [];
	let ctx = miCanvas.getContext('2d')
	ctx.clearRect(0, 0, miCanvas.width, miCanvas.height);
}
/**
 * Funcion que deja de dibujar la linea
 */
function pararDibujar () {
    pintarLinea = false;
    guardarLinea();
}

//======================================================================
// EVENTOS
//======================================================================

// Eventos raton
miCanvas.addEventListener('mousedown', empezarDibujo, false);
miCanvas.addEventListener('mousemove', dibujarLinea, false);
miCanvas.addEventListener('mouseup', pararDibujar, false);

// Eventos pantallas táctiles
miCanvas.addEventListener('touchstart', empezarDibujo, false);
miCanvas.addEventListener('touchmove', dibujarLinea, false);
