app.controller('vistaEntradasMorteros', function (BASEURL, ID, $scope, $http){
	$scope.materiaprima = '';
	$scope.cantidad = '';

	$scope.limpiarCampos = function(){
		$scope.materiaprima = '';
		$scope.cantidad = '';
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
					console.log('response', response.data);
	    			jsRemoveWindowLoad();
	    			Swal.fire({
						  title: '¡Éxito!',
						  html: 'Se elimino la produccion',
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