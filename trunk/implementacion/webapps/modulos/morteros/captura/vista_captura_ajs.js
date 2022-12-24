// var app = angular.module('customerApp', ['datatables']);
app.controller('vistaProduccionMorteros', function (BASEURL, ID, $scope, $http) {
	// $scope.misProducciones = [];

	// $http.post('Controller.php', {
	// 	'task': 'getMisProducciones',
	// }).then(function (response){
	// 	response = response.data;
	// 	console.log('response', response);
	// 	$scope.misProducciones = response;
	// }, function(error){
	// 	console.log('error', error);
	// });

	// $scope.eliminarProduccion = function(cve_captura){
	//     $.getJSON("modelo_captura.php?obtenerDatos="+cve_captura, function(registros){
	//         console.log(registros);
	//     });

	//     Swal.fire({
	// 	  title: 'Eliminar Produccion',
	// 	  html: '¿Realmente deseas eliminar la produccion con folio: <b>'+cve_captura+'</b>?',
	// 	  icon: 'warning',
	// 	  showCancelButton: true,
	// 	  confirmButtonColor: '#3085d6',
	// 	  cancelButtonColor: '#d33',
	// 	  confirmButtonText: 'Eliminar',
	// 	  cancelButtonText: 'Cancelar'
	//     }).then((result) => {
	//     	if (result.isConfirmed) {
	//     		jsShowWindowLoad('Eliminando producción...');
	//     		$http.post('Controller.php', {
	//     			'cve_usuario': ID,
	//     			'cve_captura': cve_captura,
	//     			'task': 'eliminarCaptura',
	//     		}).then(function (response){
	//     			response = response.data;
	//     			// console.log('response', response.data);
	//     			jsRemoveWindowLoad();
	//     			// if (response.code == 200) {
	// 					Swal.fire({
	// 					  title: '¡Éxito!',
	// 					  html: 'Se elimino la produccion',
	// 					  icon: 'success',
	// 					  showCancelButton: false,
	// 					  confirmButtonColor: 'green',
	// 					  confirmButtonText: 'Aceptar'
	// 					}).then((result) => {
	// 					  if (result.isConfirmed) {
	// 					  	location.reload();
	// 					  }else{
	// 					  	location.reload();
	// 					  }
	// 					});
	//     			// }else{
	//     				// alert('Error en controlador. \nFavor de ponerse en contacto con el administrador del sitio.');
	//     			// }
	//     		}, function(error){
	//     			console.log('error', error);
	//     			jsRemoveWindowLoad();
	//     		});
	//     	}
	//     });
	// }

});