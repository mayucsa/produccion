app.directive('hcPieChart', function () {
                return {
                    restrict: 'E',
                    template: '<div></div>',
                    scope: {
                        title: '@',
                        data: '='
                    },
                    link: function (scope, element) {
                        Highcharts.chart(element[0], {
                            chart: {
                                type: 'pie'
                            },
                            title: {
                                text: scope.title
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                    }
                                }
                            },
                            series: [{
                                data: scope.data
                            }]
                        });
                    }
                };
            })

app.controller('dashboardBloqueras', function(BASEURL, ID, $scope, $http){
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
        });

    $scope.pieData =  [{
                name: "Microsoft Internet Explorer",
                y: 56.33
            }, {
                name: "Chrome",
                y: 24.03,
                sliced: true,
                selected: true
            }, {
                name: "Firefox",
                y: 10.38
            }, {
                name: "Safari",
                y: 4.77
            }, {
                name: "Opera",
                y: 0.91
            }, {
                name: "Proprietary or Undetectable",
                y: 0.2
        }]

});