
app.controller('dashboardBloqueras', function(BASEURL, ID, $scope, $http){
    $scope.cargaChartPie = function (idChart, datosChart, tituloChart = '', nombreChart = ''){
        var datosOrdenados = [];
        var coloresChart = [
            '#7cb5ec', '#f7a35c', '#90ee7e', '#aaeeee', '#ff0066',
            '#eeaaee', '#55BF3B', '#DF5353', '#910000', '#1aadce',
            '#964BC3', '#f28f43', '#a6c96a', '#4572A7', '#D7E03B', 
            '#80699B', '#3D96AE', '#DB843D', '#92A8CD', '#A47D7C', 
            '#B5CA92'
        ];
        for (var i = 0; i < datosChart.length; i++) {
            datosOrdenados.push(
                {
                  
                  name: datosChart[i].producto,
                  // sliced: false,
                  // selected: false,
                  y: parseInt(datosChart[i].total),
                  color: coloresChart[i],
                  events: {
                    click: function(event){
                        // alert(i);
                    }
                  }
                }
            );
        }
        Highcharts.chart(idChart, {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: tituloChart,
                align: 'left'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y} -> {point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y} -> {point.percentage:.1f} %'
                    }
                }
            },
            exporting: false,
            credits: {
              enabled: false
            },
            series: [{
                name: nombreChart,
                colorByPoint: true,
                data: datosOrdenados
            }]
        });
    }
// return {
//         restrict: 'E',
//         template: '<div></div>',
//         scope: {
//             title: '@',
//             data: '='
//         },
//         link: function (scope, element) {
//             Highcharts.chart(element[0], {
//                 chart: {
//                     type: 'pie'
//                 },
//                 title: {
//                     text: scope.title
//                 },
//                 plotOptions: {
//                     pie: {
//                         allowPointSelect: true,
//                         cursor: 'pointer',
//                         dataLabels: {
//                             enabled: true,
//                             format: '<b>{point.name}</b>: {point.percentage:.1f} %'
//                         }
//                     }
//                 },
//                 series: [{
//                     data: scope.data
//                 }]
//             });
//         }
//     }
    $http.post('Controller.php', {
        'task': 'produccionBloqueras'
    }).then(function(response){
        response = response.data;
        // console.log('datos para chart', response);
        $scope.cargaChartPie('chartPieDashboard', response, 'Mi grafica de Pie', 'dato');
    }, function(error){
        console.log('error', error);
    });
    $scope.VCProduccion = function(){
        var fproducinicio = $('#fproducinicio').val();
        var fproducfin = $('#fproducfin').val();
        if (!fproducinicio || !fproducfin) {
            Swal.fire(
                'Campo faltante',
                'Los campos fecha inicio y fecha fin son requeridos',
                'warning'
            );
            return;
        }
        if (fproducinicio >= fproducfin) {
            Swal.fire(
                'Fechas incorrectas',
                'La fecha inicio debe ser menor a la fecha fin',
                'warning'
            );
            return;
        }
        jsShowWindowLoad('Obteniendo datos...');
        $http.post('Controller.php', {
            'task': 'produccionBloquerasFecha',
            'fechaIni': fproducinicio,
            'fechaFin': fproducfin
        }).then(function(response){
            response = response.data;
            // console.log('datos para chart', response);
            $scope.cargaChartPie('chartPieDashboard', response, 'Mi grafica de Pie', 'dato');
            jsRemoveWindowLoad();
        }, function(error){
            console.log('error', error);
            jsRemoveWindowLoad();
        });
    }

});