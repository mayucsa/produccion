app.controller('vistaSeguridad', function(BASEURL, ID, $scope, $http){
	$scope.getmPrimaCat = function(mprima){
		if (mprima == '' || mprima == undefined) {
			return;
		}
		const cve_producto = $('#cve_productoEdit').val();
		$http.post('Controller.php',{
			'task': 'getmPrimaCat',
			'mprima': mprima,
			'cve_producto': cve_producto
		}).then(function (response) {
			response = response.data;
			console.log('response', response);
			$scope.arrayMPrimaCat = response;
		}, function(error){
			console.log('error', error);
		});
	}
	$scope.setmPrima = function(i){
		jsShowWindowLoad('Agregando...');
		const cve_producto = $('#cve_productoEdit').val();
		$http.post('Controller.php',{
			'task': 'getLengthMPrima',
			'cve_producto': cve_producto
		}).then(function (res) {
			const w = res.data.longitud;
			$http.post('Controller.php',{
				'task': 'setmPrima',
				'cve_producto': cve_producto,
				'cve_materia_prima': $scope.arrayMPrimaCat[i].cve_materia_prima
			}).then(function (response) {
				response = response.data;
				console.log('response', response);
				if (response == true) {
					$('#tablaModal').append('<tr>' + 
		            '<td style="dislay: none;">' + $scope.arrayMPrimaCat[i].nombre_materia_prima + '</td>'+
		            '<td align="center" style="dislay: none;">'+
		                '<input type="number" id="cantidad_'+w+'" value="1" step=".0001" class="form-control">'+
		            '</td>'+
		            '<td style="dislay: none; text-align:center; width:25%">'+
		                '<input type="button" value="Editar" class="btn btn-warning mr-2" onclick="editarMPrima('+w+', \''+$scope.arrayMPrimaCat[i].cve_materia_prima+'\', \''+cve_producto+'\')">'+
		                '<input type="button" value="Eliminar" class="btn btn-danger" onclick="eliminamPrima(\''+$scope.arrayMPrimaCat[i].cve_materia_prima+'\', \''+cve_producto+'\'))">'
		            +'</td></tr>');
				}
				$scope.arrayMPrimaCat = [];
				$scope.nuevaMPrima = '';
				jsRemoveWindowLoad();
			}, function(error2){
				console.log('error2', error2);
				jsRemoveWindowLoad();
			});
		}, function(error){
			console.log('error', error);
			jsRemoveWindowLoad();
		});
	}
});