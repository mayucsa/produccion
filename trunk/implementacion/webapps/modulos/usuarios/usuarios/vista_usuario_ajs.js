app.controller('vistaUsuario', function(BASEURL, ID, $scope, $http) {
	$scope.inputusuario = '';
	$scope.inputnombre = '';
	$scope.inputapellido = '';
	$scope.inputpuesto = '';
	$scope.inputcorreo = '';


	$scope.limpiarCampos = function(){
		$scope.inputusuario = '';
		$scope.inputnombre = '';
		$scope.inputapellido = '';
		$scope.inputpuesto = '';
		$scope.inputcorreo = '';
	}
	$scope.validacionCampos = function(){
		if ($scope.inputusuario == '' || $scope.inputusuario == null) {
			Swal.fire(
				'Campo faltante',
				'Es necesario colocar un nombre de usuario',
				'warning'
				);
			return;
		}
		if ($scope.inputnombre == '' || $scope.inputnombre == null) {
			Swal.fire(
				'Campo faltante',
				'Es necesario colocar el nombre',
				'warning'
				);
			return;
		}
		if ($scope.inputapellido == '' || $scope.inputapellido == null) {
			Swal.fire(
				'Campo faltante',
				'Es necesario colocar el apellido del usuario',
				'warning'
				);
			return;
		}
		if ($scope.inputpuesto == '' || $scope.inputpuesto == null) {
			Swal.fire(
				'Campo faltante',
				'Es necesario colocar el puesto del usuario',
				'warning'
				);
			return;
		}
		if ($scope.inputcorreo == '' || $scope.inputcorreo == null) {
			Swal.fire(
				'Campo faltante',
				'Es necesario colocar un correo del usuario',
				'warning'
				);
			return;
		}
	}
	Swal.fire({
		  title: 'Estás a punto de crear un usuario.',
		  text: '¿Es correcta la información agregada?',
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: 'green',
		  cancelButtonColor: 'red',
		  confirmButtonText: 'Aceptar',
		  cancelButtonText: 'Cancelar'
	}).then((result) => {
		if (result.isConfirmed) {
			jsShowWindowLoad('Creando usuario...');
			$http.post('Controller.php', {
				'task': 'guardarUsuario',
				'usuario': $scope.inputusuario,
				'nombre': $scope.inputnombre,
				'apellido': $scope.inputapellido,
				'puesto': $scope.inputpuesto,
				'correo': $scope.inputcorreo,
			}).then(function(response){
				response = response.data;

				jsRemoveWindowLoad();

				if (response.code == 200) {
					Swal.fire({
					  title: '¡Éxito!',
					  text: 'Se ha creado el usuario correctamente.\n Usuario: '+response.usuario,
					  icon: 'success',
					  showCancelButton: false,
					  confirmButtonColor: 'green',
					  confirmButtonText: 'Aceptar'
					}).then((result)=>{
						if (result.isConfirmed) {
							location.reload();
						}else{
							location.reload();
						}
					});
				}else{
					alert('Error en controlador. \nFavor de ponerse en contacto con el administrador del sitio.');
				}

			}, function (error) {
				console.log('error', error);
				jsRemoveWindowLoad();
			});
		}
	})
});