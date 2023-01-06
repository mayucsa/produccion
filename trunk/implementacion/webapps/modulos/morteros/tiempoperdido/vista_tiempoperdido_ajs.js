app.controller('VistaTPMorteros', function(BASEURL, ID, $scope, $http){
	$http.post('Controlador.php', {
		'task': 'getMaquinas'
	}).then(function (response){
		response = response.data;
		console.log('getMaquinas', response);
		$scope.Maquinas = response;
	},function(error){
		console.log('error', error);
	});
	$http.post('Controlador.php', {
		'task': 'getFallos'
	}).then(function (response){
		response = response.data;
		console.log('getFallos', response);
		$scope.Fallos = response;
	},function(error){
		console.log('error', error);
	});
	$http.post('Controlador.php', {
		'task': 'serverSideTPMorteros'
	}).then(function (response){
		response = response.data;
		console.log('serverSideTPMorteros', response);
		$scope.serverSideTPMorteros = response;
	},function(error){
		console.log('error', error);
	});
	$scope.obtenerDatosEdit = function(cve_tp) {
	    $.getJSON("modelo_tiempoperdido.php?consultar="+cve_tp, function(registros){
	        // console.log(registros);

	        $('#inputidedit').val(registros[0]['cve_tp']);
	        $('#selectmaquinaedit').val(registros[0]['cve_maq']);
	        $('#selectfalloedit').val(registros[0]['cve_fallo']);
	        $('#inputmotivoedit').val(registros[0]['motivo_fallo']);
	        $('#inputhorainicioedit').val(registros[0]['hora_inicio']);
	        $('#inputhorafinedit').val(registros[0]['hora_fin']);
	    });
	}

	$scope.obtenerDatosE = function(cve_tp) {
	    $.getJSON("modelo_tiempoperdido.php?consultarDelete="+cve_tp, function(registros){
	        console.log(registros);

	        $('#inputide').val(registros[0]['cve']);
	        $('#inputmaqe').val(registros[0]['maquina']);
	        $('#inputfalloe').val(registros[0]['fallo']);
	    });
	}
	$scope.checkTime = function(id){
	    texto = setNumeric($('#'+id).val());
	    var aux = '';
	    for (var i = 0; i < texto.length; i++) {
	        if(i < 6) aux = aux+''+texto[i];
	        if (i == 1 || i == 3) {
	            aux = aux + ':';
	        }
	    }
	    if (texto.length == 6 && $('#inputhorainicio').val() != '' && $('#inputhorafin').val() != '') {
	        setTimeout(function(){
	            $scope.getdiferencia();
	        },500);
	    }
	    if (texto.length == 6 && $('#inputhorainicio').val() != '' && $('#inputhorafin').val() == '') {
	        $('#inputhorafin').focus()
	    }
	    $('#'+id).val(aux);
	}
	$scope.getdiferencia = function() {
	    var inicio = $('#inputhorainicio').val();
	    var fin = $('#inputhorafin').val();
	    if (inicio.length != 8 && fin.length != 8) {
	    	return;
	    }
	    inicio = inicio.split(':');
	    fin = fin.split(':');
	    var horas = parseInt(fin[0]) - parseInt(inicio[0]);
	    var minutos = parseInt(fin[1]) - parseInt(inicio[1]);
	    var segundos = parseInt(fin[2]) - parseInt(inicio[2]);
	    if (segundos < 0) {
	        minutos --;
	        segundos = Math.abs(segundos);
	    }
	    if (minutos < 0) {
	        horas--;
	        minutos = Math.abs(minutos);
	    }
	    if (horas < 0) {
	        Swal.fire('Error','La hora de inicio debe ser menor a la hora fin','warning');
	        $('#inputhorafin').val('');
	        $("#diferencia").val('');;
	        return;
	    }else{
		    var dif = doscifras(horas)+':'+doscifras(minutos)+':'+doscifras(segundos);
		    $("#diferencia").val(dif);
	    }
	}
})