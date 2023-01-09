app.controller('vistaMovtosPorteria', function(BASEURL, ID, $scope, $http){

	$http.post('Controller.php', {
		'task': 'ssMovtos'
	}).then(function (response){
		response = response.data;
		$scope.ssMovtos = response;
		// console.log(response.data);
		setTimeout(function(){
			$('#tablaMovtos').DataTable({
		        "processing": true,
		        "bDestroy": true,
				"order": [3, 'desc']+[4, 'desc'],
				"lengthMenu": [[50, 100, 150], [50, 100, 150]],
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

})