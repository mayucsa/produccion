app.controller('vistaInventarioMorteros', function(BASEURL, ID, $scope, $http){
// TABLA PRODUCTO FINALIZADO
	$http.post('Controller.php', {
		'task': 'productofinalizado'
	}).then(function (response){
		response = response.data;
		$scope.datosProductoFinalizado = response;
		setTimeout(function(){
			$('#tablaProducto').DataTable({
			"dom": 'Bfrtip',
            "buttons": [
                 {"extend": 'excel',"text": '<i class="far fa-file-excel"> Exportar en Excel</i>', "title": 'Inventario Morteros'}, 
                 {"extend": 'pdf', "text": '<i class="far fa-file-pdf"> Exportar en PDF</i>', "title": 'Inventario Morteros'}, 
                 {"extend": 'print', "text": '<i class="fas fa-print"> Imprimir</i>', "title": 'Inventario Morteros'},
                 "pageLength",
            ],
		        "processing": true,
		        "bDestroy": true,
				"lengthMenu": [[30, 50, 75], [30, 50, 75]],
				"columnDefs":[
                            {
                                "targets": [2, 3, 4],
                                "render": $.fn.dataTable.render.number(',', '.', 0, '')
                                // "render": $.fn.dataTable.render.number(',', '.', 3, '');
                            }
                        ],
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
// TABLA MATERIA PRIMA
	$http.post('Controller.php', {
		'task': 'materiaprima'
	}).then(function (response){
		response = response.data;
		$scope.datosMateriaPrima = response;
		setTimeout(function(){
			$('#tablaMateriaPrima').DataTable({
			"dom": 'Bfrtip',
            "buttons": [
                 {"extend": 'excel',"text": '<i class="far fa-file-excel"> Exportar en Excel</i>', "title": 'Inventario Morteros'}, 
                 {"extend": 'pdf', "text": '<i class="far fa-file-pdf"> Exportar en PDF</i>', "title": 'Inventario Morteros'}, 
                 {"extend": 'print', "text": '<i class="fas fa-print"> Imprimir</i>', "title": 'Inventario Morteros'},
                 "pageLength",
            ],
		        "processing": true,
		        "bDestroy": true,
				"lengthMenu": [[30, 50, 75], [30, 50, 75]],
				"columnDefs":[
                            {
                                "targets": [2],
                                "render": $.fn.dataTable.render.number(',', '.', 0, '')
                                // "render": $.fn.dataTable.render.number(',', '.', 3, '');
                            }
                        ],
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
// TABLA SAQUERIA
	$http.post('Controller.php', {
		'task': 'saqueria'
	}).then(function (response){
		response = response.data;
		$scope.datosSacos = response;
		setTimeout(function(){
			$('#tablaSacos').DataTable({
			"dom": 'Bfrtip',
            "buttons": [
                 {"extend": 'excel',"text": '<i class="far fa-file-excel"> Exportar en Excel</i>', "title": 'Inventario Morteros'}, 
                 {"extend": 'pdf', "text": '<i class="far fa-file-pdf"> Exportar en PDF</i>', "title": 'Inventario Morteros'}, 
                 {"extend": 'print', "text": '<i class="fas fa-print"> Imprimir</i>', "title": 'Inventario Morteros'},
                 "pageLength",
            ],
		        "processing": true,
		        "bDestroy": true,
				"lengthMenu": [[30, 50, 75], [30, 50, 75]],
				"columnDefs":[
                            {
                                "targets": [2],
                                "render": $.fn.dataTable.render.number(',', '.', 0, '')
                                // "render": $.fn.dataTable.render.number(',', '.', 3, '');
                            }
                        ],
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

});