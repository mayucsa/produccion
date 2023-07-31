app.controller('vistaReportesVentas', function(BASEURL, ID, $scope, $http){

	var fechaActual = new Date();
	$scope.fechaActual = fechaActual.toLocaleDateString('en-ZA');
	$scope.fechab = $scope.fechaActual;
	$scope.fechat = $scope.fechaActual;
	$scope.fecham = $scope.fechaActual;

	$scope.getPDF =  function(tipo){
		if (tipo == 'bloquera') {
			jsShowWindowLoad('Generando reporte...');
			$http.post('Controller.php', {
				'task': 'ventasbloquera',
				'fecha': $('#fechab').val(),
			}).then(function (response){
				response = response.data;
				$scope.ventasBloquera = response;
				setTimeout(function(){
					imprSelec('pdfVentasBloquera');
					jsRemoveWindowLoad();
				}, 700);
			}, function(error){
				console.log('error', error);
				jsRemoveWindowLoad();
			});
		}
		if (tipo == 'trituradora') {
			jsShowWindowLoad('Generando reporte...');
			$http.post('Controller.php', {
				'task': 'ventastrituradora',
				'fecha': $('#fechat').val(),
			}).then(function (response){
				response = response.data;
				$scope.ventasTrituradora = response;
				setTimeout(function(){
					imprSelec('pdfVentasTrituradora');
					jsRemoveWindowLoad();
				}, 700);
			}, function(error){
				console.log('error', error);
				jsRemoveWindowLoad();
			});
		}
		if (tipo == 'mortero') {
			jsShowWindowLoad('Generando reporte...');
			$http.post('Controller.php', {
				'task': 'ventasmortero',
				'fecha': $('#fecham').val(),
			}).then(function (response){
				response = response.data;
				$scope.ventasMortero = response;
				setTimeout(function(){
					imprSelec('pdfVentasMortero');
					jsRemoveWindowLoad();
				}, 700);
			}, function(error){
				console.log('error', error);
				jsRemoveWindowLoad();
			});
		}
	}

});

function imprSelec(id) {
	var div = document.getElementById(id);
    var ventimp = window.open(' ', 'popimpr');
    ventimp.document.write( div.innerHTML );
    ventimp.document.close();
    ventimp.print( );
    ventimp.close();
}