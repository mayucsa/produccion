app.controller('vistaDespachoTrituradora', function(BASEURL, ID, $scope, $http){
	$scope.folio = '';
	angular.element('#nextFocusHeader0').focus();
	let myModal = new bootstrap.Modal(document.getElementById('firmasModal'), {
	  keyboard: false
	})
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
	$scope.limpiarCampos = function() {
		$scope.folio = '';
		$scope.documento = '';
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
			switch (response.data[0].ESTATUS_DOCUMENTO) {
				case '1':
					// $scope.setModalMisRequ();
					Swal.fire('Sin entrada','El folio <b>'+ folio +'</b> no registro entrada en planta','error');
						angular.element('#nextFocusHeader0').focus();
					  	$('#nextFocusHeader0').val('');
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
					$scope.documento = response.data[0].CIDDOCUMENTO;
					$scope.cliente = response.data[0].CRAZONSOCIAL;
					$scope.placas = response.data[0].CTEXTOEXTRA2;
					$scope.admDocumentosDetalle = response.data;
					// $scope.setModalMisRequ();
					break;
				case '4':
					// $scope.setModalMisRequ();
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
	$scope.validacionDatosFinal = function(){
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
		jsShowWindowLoad('Despachando producto de agregador...');
		const miFirma = miCanvas.toDataURL();
		$http.post('Controller.php', {
			'task': 'despacharProducto',
			'folio': $scope.folio,
			'documento': $scope.documento,
			'id': ID,
			'firma': miFirma,
			'datos': $scope.admDocumentosDetalle
		}).then(function(response){
			response = response.data;
			console.log('response', response);
			jsRemoveWindowLoad();
			if (response.code == 200) {
				let timerInterval
				Swal.fire({
				  title: '¡Éxito!',
				  html: 'El despacho el producto se generó correctamente.',
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
			}else{
				Swal.fire(
				  'Error en controlador',
				  'Revisar la consola',
				  'warning'
				);
				return;
			}
		}, function(error){
			console.log('error', error);
			jsRemoveWindowLoad();
		})
	}
	$scope.cancelarFirma = function(){
		myModal.hide();
	}
	$scope.aceptarFirma = function(){
		$scope.validacionDatosFinal();
	}
	$scope.despachar = function(){
		if ($scope.folio == '' || $scope.folio == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario seleccionar una máquina',
			  'warning'
			);
			return;
		}
		Swal.fire({
		  title: 'Surtir producto',
		  html: '¿Realmente deseas surtir el pedido de la nota <b>'+ $scope.folio +'</b> ?',
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: 'green',
		  cancelButtonColor: 'red',
		  confirmButtonText: 'Aceptar',
		  cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
				myModal.show();
				return;
			}
		})
	}
	$scope.inputCharacters = function(i) {
		i++;
		// if (tipo != '') {
			if (i == 0) {
				$('#nextFocusHeader1').focus();
				// $('#nextFocusHeader1').click();
			}else{
				$('#nextFocusHeader1').focus();
				// $('#nextFocusHeader1').click();
			}
			// return;
		// }
	}

	$scope.prueba = function(){
		Swal.fire({
	 		title: "Are you finished your creation?",  
	        text: "click yes to save",   
	        type: "warning",  
	        showCancelButton: true,   
	        confirmButtonColor: "#f8c1D9",   
	        confirmButtonText: "Yes, save it!",  
	        closeOnConfirm: true 
		}).then((result) => {
			if (result.isConfirmed) {
				
			}
		})
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

