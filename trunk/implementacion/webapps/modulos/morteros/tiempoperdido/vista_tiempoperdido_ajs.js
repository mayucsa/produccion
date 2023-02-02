app.controller('VistaTPMorteros', function(BASEURL, ID, $scope, $http){
	$scope.ordenServicioDisabled = true;
	$scope.oservicio = '';
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
		$scope.serverSideTPVibro = response;
		setTimeout(function(){
			$('#tableserverSideTPMorteros').DataTable({
		        "processing": true,
		        "bDestroy": true,
				"order": [0, 'desc'],
				"lengthMenu": [[30, 50, 75], [30, 50, 75]],
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
	$scope.limpiarCampos = function (){
		$scope.maquina = '';
		$scope.fallo = '';
		$scope.oservicio = '';
		$("#inputoservicio").attr("disabled", true);
		$scope.motivo = '';
		$scope.hinicio = '';
		$scope.hfin = '';
		$scope.diferencia = '';
		$("#diferencia").val('');
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
		if ($("#inputoservicio").attr("disabled") == undefined && $scope.oservicio == '') {
			$('#inputoservicio').focus();
			Swal.fire(
			  'Campo faltante',
			  'Es necesario escribir la orden de servicio',
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
		if ($scope.fallo == 4 || $scope.fallo == 5 || $scope.fallo == 6 || $scope.fallo == 14 || $scope.fallo == 15 || $scope.fallo == 16) {
			if ($scope.oservicio == '' || $scope.oservicio == null) {
				Swal.fire(
				  'Campo faltante',
				  'Es necesario escribir el número de orden de servicio',
				  'warning'
				);
				return;
			}
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
					'orden': $scope.oservicio,
					'motivo': $scope.motivo,
					'hinicio': $scope.hinicio,
					'hfin': $scope.hfin,
					'id': ID,
			}).then(function(response){
				response = response.data;
				console.log('response', response);
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
	$scope.editartp = function(){
		$scope.cve_tpe = $('#inputidedit').val();
		$scope.maquinae = $('#selectmaquinaedit').val();
		$scope.falloe = $('#selectfalloedit').val();
		$scope.motivoe = $('#inputmotivoedit').val();
		$scope.hinicioe = $('#inputhorainicioedit').val();
		$scope.hfine = $('#inputhorafinedit').val();
		console.log('cve_tpe', $scope.cve_tpe);
		console.log('maquinae', $scope.maquinae);
		console.log('falloe', $scope.falloe);
		console.log('motivoe', $scope.motivoe);
		console.log('hinicioe', $scope.hinicioe);
		console.log('hfine', $scope.hfine);
		Swal.fire({
		  title: 'Estás a punto de editar un tiempo perdido.',
		  text: '¿Es correcta la información agregada?',
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: 'green',
		  cancelButtonColor: 'red',
		  confirmButtonText: 'Aceptar',
		  cancelButtonText: 'Cancelar'
		}).then((result) =>{
			if (result.isConfirmed) {
				jsShowWindowLoad('Editando tiempo pérdido...');
				$http.post('Controlador.php', {
	    			'task': 'EditarTPerdido',
	    			'cve': $scope.cve_tpe,
	    			'maquinae': $scope.maquinae,
	    			'falloe': $scope.falloe,
	    			'motivoe': $scope.motivoe,
	    			'inicioe': $scope.hinicioe,
	    			'fine': $scope.hfine,
	    			'id': ID,
				}).then(function(response){
					response = response.data;
					console.log('response', response);
					jsRemoveWindowLoad();
					Swal.fire({
					  title: '¡Éxito!',
					  html: 'Se edito el folio correctamente.\n Folio: ' + $scope.cve_tpe + '</b>',
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
	$scope.checkTime = function(id){
	    texto = setNumeric($('#'+id).val());
	    var aux = '';
	    for (var i = 0; i < texto.length; i++) {
	        if(i < 6) aux = aux+''+texto[i];
	        if (i == 1 || i == 3) {
	            aux = aux + ':';
	        }
	    }
	    var auxiliar = aux.split(':');
	    aux = '';
	    for (var i = 0; i < auxiliar.length; i++) {
	    	var maxHour = 59;
	    	if (i == 0 ) {
	    		maxHour = 23;
	    	}
    		if(auxiliar[i] > maxHour){
    			aux += (i>0?':':'')+maxHour;
    		}else{
    			aux += (i>0?':':'')+auxiliar[i];
    		}
	    }
	    if (texto.length == 6 && $('#inputhorainicio').val() != '' && texto.length == 6 
	    	&& $('#inputhorainicio').val() != undefined && $('#inputhorafin').val() != '' 
	    	&& $('#inputhorafin').val() != undefined) {
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
	    var ini = $('#inputhorainicio').val();
	    var fin = $('#inputhorafin').val();
	    if (ini.length != 8 || fin.length != 8) {
	    	return;
	    }
	    ini = ini.split(':');
	    fin = fin.split(':');
	    var horas_fin = parseInt(fin[0]) * 3600;
	    var minutos_fin = parseInt(fin[1]) * 60;
	    var segundos_fin = parseInt(fin[2]);
	    var horas_ini = parseInt(ini[0]) * 3600;
		var minutos_ini = parseInt(ini[1]) * 60;
		var segundos_ini = parseInt(ini[2]);
		var inicial = horas_ini+minutos_ini+segundos_ini;
		var final = horas_fin+minutos_fin+segundos_fin;
	    if (inicial > final) {
	    	var dif = (86400 + final) - inicial;
	    }else{
	    	var dif = final - inicial;
	    }
	    var horas = parseInt(dif / 3600);
	    var minutos = parseInt((dif % 3600)/60);
	    var segundos = dif - ((horas * 3600 ) + (minutos * 60)); 
	    var dif = doscifras(horas)+':'+doscifras(minutos)+':'+doscifras(segundos);
	    $("#diferencia").val(dif);
	}
	$scope.validaservicio = function(fallo){
		const arregloFallos = [4, 5, 6, 14, 15, 16];
		if (fallo == 4 || fallo == 5 || fallo == 6 || fallo == 14 || fallo == 15 || fallo == 16) {
			$scope.nservicion = true;
			$("#inputoservicio").attr("disabled", false);
		}else{
			$("#inputoservicio").attr("disabled", true);
		}
	}

	$scope.getdiferenciah = function() {
		var inicio = $('#inputhorainicio').val();
		var fin = $('#inputhorafin').val();
		// console.log(hinicio);
		inicio = inicio.split(':');
	    fin = fin.split(':');
		var horas_ini = parseInt(inicio[0]);
		var horas_fin = parseInt(fin[0]);
		var min_ini = parseInt(inicio[1]);
		var min_fin = parseInt(fin[1]);
		var inicial = parseInt(inicio[0]+inicio[1]+inicio[2]);
		var final = parseInt(fin[0]+ fin[1]+fin[2]);
		// console.log(horas_ini);
		// console.log(min_ini);
		// console.log(horas_fin);
		// console.log(min_fin);
		// console.log(inicial);
		// console.log(final);
		if (inicial >= 220000) {
			// if (inicial > 2200 && inicial < 600) {
			    var ini = $('#inputhorainicio').val();
			    var fin = $('#inputhorafin').val();
			    if (ini.length != 8 || fin.length != 8) {
			    	return;
			    }
			    ini = ini.split(':');
			    fin = fin.split(':');
			    var horas_fin = parseInt(fin[0]) * 3600;
			    var minutos_fin = parseInt(fin[1]) * 60;
			    var segundos_fin = parseInt(fin[2]);
			    var horas_ini = parseInt(ini[0]) * 3600;
				var minutos_ini = parseInt(ini[1]) * 60;
				var segundos_ini = parseInt(ini[2]);
				var inicial = horas_ini+minutos_ini+segundos_ini;
				var final = horas_fin+minutos_fin+segundos_fin;
				// console.log(inicial);
				// console.log(final);
			    if (inicial > final) {
			    	var dif = (86400 + final) - inicial;
			    }else{
			    	var dif = final - inicial;
			    	Swal.fire('Error','La hora de inicio debe ser menor a la hora fin','warning');
			        $('#inputhorafin').val('');
			        $("#diferencia").val('');
			    }
			    var horas = parseInt(dif / 3600);
			    var minutos = parseInt((dif % 3600)/60);
			    var segundos = dif - ((horas * 3600 ) + (minutos * 60)); 
			    var dif = doscifras(horas)+':'+doscifras(minutos)+':'+doscifras(segundos);
			    $("#diferencia").val(dif);	
			// }else{
			// 	Swal.fire('Error','No se puede capturar la hora final despues de turno','warning');
			// 	$('#inputhorafin').val('');
			//     $("#diferencia").val('');
			// }
		}else{
			if (inicial >= 60000 && inicial <=135959) {
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
			        $("#diferencia").val('');
			        return;
			    }if (final >= 140000) {
			    	Swal.fire('Error','No puedes capturar tu hora final fuera del 1er turno, horario maximo 13:59:59','warning');
			        $('#inputhorafin').val('');
			        $("#diferencia").val('');
			    }if (inicial == final) {
			    	Swal.fire('Error','No puedes capturar hora inicial y final en un mismo horario','warning');
			        $('#inputhorafin').val('');
			        $("#diferencia").val('');
			    }else{
			    	// if (final == 235959) {
			    		var dif = doscifras(horas)+':'+doscifras(minutos)+':'+doscifras(segundos);
					    $("#diferencia").val(dif);
			    	// }else{
					//     var dif = doscifras(horas+1)+':'+doscifras(minutos-59)+':'+doscifras(segundos-59);
					//     $("#diferencia").val(dif);
					// }
			    }
			}
			// else{
			// 	Swal.fire('Error','No se puede capturar la hora final despues de turno','warning');
			// 	$('#inputhorafin').val('');
			//     $("#diferencia").val('');
			// }
			if (inicial >= 140000 && inicial <= 215959 ) {
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
			        $("#diferencia").val('');
			        return;
			    }if (final >= 220000) {
			    	Swal.fire('Error','No puedes capturar tu hora final fuera del 2do turno, horario maximo 21:59:59','warning');
			        $('#inputhorafin').val('');
			        $("#diferencia").val('');
			    }else{
				    var dif = doscifras(horas)+':'+doscifras(minutos)+':'+doscifras(segundos);
				    $("#diferencia").val(dif);
			    }
			}
			// else{
			// 	Swal.fire('Error','No se puede capturar la hora final despues de turno','warning');
			// 	$('#inputhorafin').val('');
			//     $("#diferencia").val('');
			// }
		}

	    // var ini = $('#inputhorainicio').val();
	    // var fin = $('#inputhorafin').val();
	    // if (ini.length != 8 || fin.length != 8) {
	    // 	return;
	    // }
	    // ini = ini.split(':');
	    // fin = fin.split(':');
	    // var horas_fin = parseInt(fin[0]) * 3600;
	    // var minutos_fin = parseInt(fin[1]) * 60;
	    // var segundos_fin = parseInt(fin[2]);
	    // var horas_ini = parseInt(ini[0]) * 3600;
		// var minutos_ini = parseInt(ini[1]) * 60;
		// var segundos_ini = parseInt(ini[2]);
		// var inicial = horas_ini+minutos_ini+segundos_ini;
		// var final = horas_fin+minutos_fin+segundos_fin;
	    // if (inicial > final) {
	    // 	var dif = (86400 + final) - inicial;
	    // }else{
	    // 	var dif = final - inicial;
	    // }
	    // var horas = parseInt(dif / 3600);
	    // var minutos = parseInt((dif % 3600)/60);
	    // var segundos = dif - ((horas * 3600 ) + (minutos * 60)); 
	    // var dif = doscifras(horas)+':'+doscifras(minutos)+':'+doscifras(segundos);
	    // $("#diferencia").val(dif);
	}
	$scope.getdiferenciahe = function() {
		var inicio = $('#inputhorainicioedit').val();
		var fin = $('#inputhorafinedit').val();
		// console.log(hinicio);
		inicio = inicio.split(':');
	    fin = fin.split(':');
		var horas_ini = parseInt(inicio[0]);
		var horas_fin = parseInt(fin[0]);
		var min_ini = parseInt(inicio[1]);
		var min_fin = parseInt(fin[1]);
		var inicial = parseInt(inicio[0]+inicio[1]+inicio[2]);
		var final = parseInt(fin[0]+ fin[1]+fin[2]);
		// console.log(horas_ini);
		// console.log(min_ini);
		// console.log(horas_fin);
		// console.log(min_fin);
		// console.log(inicial);
		// console.log(final);
		if (inicial >= 220000) {
			// if (inicial > 2200 && inicial < 600) {
			    var ini = $('#inputhorainicioedit').val();
			    var fin = $('#inputhorafinedit').val();
			    if (ini.length != 8 || fin.length != 8) {
			    	return;
			    }
			    ini = ini.split(':');
			    fin = fin.split(':');
			    var horas_fin = parseInt(fin[0]) * 3600;
			    var minutos_fin = parseInt(fin[1]) * 60;
			    var segundos_fin = parseInt(fin[2]);
			    var horas_ini = parseInt(ini[0]) * 3600;
				var minutos_ini = parseInt(ini[1]) * 60;
				var segundos_ini = parseInt(ini[2]);
				var inicial = horas_ini+minutos_ini+segundos_ini;
				var final = horas_fin+minutos_fin+segundos_fin;
				// console.log(inicial);
				// console.log(final);
			    if (inicial > final) {
			    	var dif = (86400 + final) - inicial;
			    }else{
			    	var dif = final - inicial;
			    	Swal.fire('Error','La hora de inicio debe ser menor a la hora fin','warning');
			        $('#inputhorafinedit').val('');
			        $("#diferenciaedit").val('');
			    }
			    var horas = parseInt(dif / 3600);
			    var minutos = parseInt((dif % 3600)/60);
			    var segundos = dif - ((horas * 3600 ) + (minutos * 60)); 
			    var dif = doscifras(horas)+':'+doscifras(minutos)+':'+doscifras(segundos);
			    $("#diferenciaedit").val(dif);	
			// }else{
			// 	Swal.fire('Error','No se puede capturar la hora final despues de turno','warning');
			// 	$('#inputhorafin').val('');
			//     $("#diferencia").val('');
			// }
		}else{
			if (inicial >= 60000 && inicial <=135959) {
			    var inicio = $('#inputhorainicioedit').val();
			    var fin = $('#inputhorafinedit').val();
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
			        $('#inputhorafinedit').val('');
			        $("#diferenciaedit").val('');
			        return;
			    }if (final >= 140000) {
			    	Swal.fire('Error','No puedes capturar tu hora final fuera del 1er turno, horario maximo 13:59:59','warning');
			        $('#inputhorafinedit').val('');
			        $("#diferenciaedit").val('');
			    }if (inicial == final) {
			    	Swal.fire('Error','No puedes capturar hora inicial y final en un mismo horario','warning');
			        $('#inputhorafinedit').val('');
			        $("#diferenciaedit").val('');
			    }else{
			    	// if (final == 235959) {
			    		var dif = doscifras(horas)+':'+doscifras(minutos)+':'+doscifras(segundos);
					    $("#diferenciaedit").val(dif);
			    	// }else{
					//     var dif = doscifras(horas+1)+':'+doscifras(minutos-59)+':'+doscifras(segundos-59);
					//     $("#diferencia").val(dif);
					// }
			    }
			}
			// else{
			// 	Swal.fire('Error','No se puede capturar la hora final despues de turno','warning');
			// 	$('#inputhorafin').val('');
			//     $("#diferencia").val('');
			// }
			if (inicial >= 140000 && inicial <= 215959 ) {
			    var inicio = $('#inputhorainicioedit').val();
			    var fin = $('#inputhorafinedit').val();
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
			        $('#inputhorafinedit').val('');
			        $("#diferenciaedit").val('');
			        return;
			    }if (final >= 220000) {
			    	Swal.fire('Error','No puedes capturar tu hora final fuera del 2do turno, horario maximo 21:59:59','warning');
			        $('#inputhorafinedit').val('');
			        $("#diferenciaedit").val('');
			    }else{
				    var dif = doscifras(horas)+':'+doscifras(minutos)+':'+doscifras(segundos);
				    $("#diferenciaedit").val(dif);
			    }
			}
			// else{
			// 	Swal.fire('Error','No se puede capturar la hora final despues de turno','warning');
			// 	$('#inputhorafin').val('');
			//     $("#diferencia").val('');
			// }
		}

	    // var ini = $('#inputhorainicio').val();
	    // var fin = $('#inputhorafin').val();
	    // if (ini.length != 8 || fin.length != 8) {
	    // 	return;
	    // }
	    // ini = ini.split(':');
	    // fin = fin.split(':');
	    // var horas_fin = parseInt(fin[0]) * 3600;
	    // var minutos_fin = parseInt(fin[1]) * 60;
	    // var segundos_fin = parseInt(fin[2]);
	    // var horas_ini = parseInt(ini[0]) * 3600;
		// var minutos_ini = parseInt(ini[1]) * 60;
		// var segundos_ini = parseInt(ini[2]);
		// var inicial = horas_ini+minutos_ini+segundos_ini;
		// var final = horas_fin+minutos_fin+segundos_fin;
	    // if (inicial > final) {
	    // 	var dif = (86400 + final) - inicial;
	    // }else{
	    // 	var dif = final - inicial;
	    // }
	    // var horas = parseInt(dif / 3600);
	    // var minutos = parseInt((dif % 3600)/60);
	    // var segundos = dif - ((horas * 3600 ) + (minutos * 60)); 
	    // var dif = doscifras(horas)+':'+doscifras(minutos)+':'+doscifras(segundos);
	    // $("#diferencia").val(dif);
	}

})