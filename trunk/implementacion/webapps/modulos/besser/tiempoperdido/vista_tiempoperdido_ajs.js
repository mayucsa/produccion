app.controller('VistaTPBesser', function(BASEURL, ID, $scope, $http){
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
		'task': 'serverSideTPBesser'
	}).then(function (response){
		response = response.data;
		$scope.serverSideTPBesser = response;
	},function(error){
		console.log('error', error);
	});
	$scope.limpiarCampos = function (){
		$scope.maquina = '';
		$scope.fallo = '';
		$scope.motivo = '';
		$scope.hinicio = '';
		$scope.hfin = '';
		$scope.diferencia = '';

	}
	$scope.validacionDatos = function(){
		if ($scope.maquina == '' || $scope.maquina == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario seleccionar una máquina',
			  'warning'
			);
			return;
		}
		if ($scope.fallo == '' || $scope.fallo == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario seleccionar un fallo',
			  'warning'
			);
			return;
		}
		if ($scope.motivo == '' || $scope.motivo == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario escribir el motivo del fallo',
			  'warning'
			);
			return;
		}
		if ($scope.hinicio == '' || $scope.hinicio == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario escribir la hora de inicio',
			  'warning'
			);
			return;
		}
		if ($scope.hfin == '' || $scope.hfin == null) {
			Swal.fire(
			  'Campo faltante',
			  'Es necesario escribir la hora final',
			  'warning'
			);
			return;
		}
		Swal.fire({
		  title: 'Estás a punto de capturar un tiempo pérdido.',
		  text: '¿Es correcta la información agregada?',
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: 'green',
		  cancelButtonColor: 'red',
		  confirmButtonText: 'Aceptar',
		  cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {
			jsShowWindowLoad('Capturando tiempo pérdido...');
			$http.post('Controlador.php', {
					'task': 'guardarTiempoPerdido',
					'maquina': $scope.maquina,
					'fallo': $scope.fallo,
					'motivo': $scope.motivo,
					'hinicio': $scope.hinicio,
					'hfin': $scope.hfin,
					'id': ID,
			}).then(function(response){
				response = response.data;
				// console.log('response', response);
				jsRemoveWindowLoad();
				if (response.code == 200) {
					Swal.fire({
					  title: '¡Éxito!',
					  html: 'Su captura de tiempo perdido se generó correctamente.\n <b>Folio: ' +response.folio + '</b>',
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
				}else{
					alert('Error en controlador. \nFavor de ponerse en contacto con el administrador del sitio.');
				}
			}, function(error){
				console.log('error', error);
				jsRemoveWindowLoad();
			});
		  }
		})
	}
	$scope.sinacceso = function(){
    Swal.fire({
        // confirmButtonColor: '#3085d6',
        title: 'Usuario Sin Privilegios',
        html: 'Pongase en contacto con el Administrador',
        confirmButtonColor: '#1A4672'
        });
	}
	$scope.obtenerDatosEdit = function(cve_tp){
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
	$scope.eliminartp = function(cve_tp) {
	    $.getJSON("modelo_tiempoperdido.php?consultarDelete="+cve_tp, function(registros){
	        console.log(registros);

	        // $('#inputide').val(registros[0]['cve']);
	        // $('#inputmaqe').val(registros[0]['maquina']);
	        // $('#inputfalloe').val(registros[0]['fallo']);
	    });
	    Swal.fire({
			title: 'Eliminar folio',
			html: '¿Realmente desea eliminar el <b>folio '+ cve_tp +'</b>?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'green',
			confirmButtonText: 'Aceptar',
			cancelButtonColor: 'red',
			cancelButtonText: 'Cancelar'
	    }).then((result) => {
	    	if (result.isConfirmed) {
	    		jsShowWindowLoad('Elimiando tiempo pérdido...');
	    		$http.post('Controlador.php', {
	    			'task': 'EliminarTPerdido',
	    			'cve': cve_tp,
	    			'id': ID,
	    		}).then(function(response){
					response = response.data;
					console.log('response', response);
					jsRemoveWindowLoad();
					Swal.fire({
					  title: '¡Éxito!',
					  html: 'Se elimino el folio correctamente.\n <b>Folio: ' +cve_tp + '</b>',
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

	    		}, function (error){
	    			console.log('error', error);
	    			jsRemoveWindowLoad();
	    		})
	    	}
	    })
	}
	$scope.obtenerDatosE = function(cve_tp){
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