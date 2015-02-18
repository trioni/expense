app.controller('StatisticsModalCtrl', ['$scope','appConfig','routeBuilder','$modalInstance',function($scope, appConfig, routes, $modalInstance) {

    $scope.config = appConfig;

    $scope.cancel = function() {
        routes.goto('home');
        $modalInstance.dismiss('cancel');
    };
}]);

app.controller('StatisticsCtrl', ['$scope','$modal', function($scope, $modal) {

    var openModal, modalInstance;

    openModal = function() {
        if( modalInstance ) return;

        modalInstance = $modal.open({
            templateUrl: 'partials/statistics.html',
            controller: 'StatisticsModalCtrl',
            size: 'md',
            backdrop: 'static'
        });
    };

    openModal();
}]);

app.controller('ChartCtrl', ['$scope','appConfig', function($scope, appConfig) {
    var chart1 = {}, i = 0, len = appConfig.be.chart.length;
    chart1.type = "PieChart";
    //chart1.type = "BarChart";
    chart1.data = [];

    chart1.data = [
        ['Category', 'cost']
    ];
    for(i; i < len; ++i) {
        chart1.data.push([
            appConfig.be.chart[i].label,
            appConfig.be.chart[i].total
        ]);
    }

    chart1.options = {
        //legend: 'none',
        pieHole: 0.2,
        height: 400,
        width: "100%",
        displayExactValues: true,
        displayed: true,
        chartArea: {left:10,top:10,bottom:20,height:"100%", width:"100%"},
        colors: ['#5bc0de', '#f0ad4e', '#428bca', '#d9534f', '#5cb85c', '#999']
    };

    chart1.formatters = {
        number : [{
            columnNum: 1,
            pattern: "HKD$ #,##0.00"
        }]
    };

    $scope.chart = chart1;
}]);
