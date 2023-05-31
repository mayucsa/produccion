app.controller('vistaSalidasMorteros', function(BASEURL, ID, $scope, $http){
	$scope.folio = '';
	let myModal = new bootstrap.Modal(document.getElementById('firmasModal'), {
	  keyboard: false
	})
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
		})
	}
	$scope.cancelarFirma = function(){
		myModal.hide();
	}
	$scope.aceptarFirma = function(){
		$scope.validacionDatosFinal();
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
				myModal.show();
				return;
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
            nuevaPosicionX = event.layerX*1.3;
            nuevaPosicionY = event.layerY*1.28;
            console.log('asd');
        } else {
            // Versión touch, pantalla tactil
            nuevaPosicionX = event.changedTouches[0].pageX*1.15;
            nuevaPosicionY = event.changedTouches[0].pageY*0.8;
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

