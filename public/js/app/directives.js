app.controller('FormUserfieldCtrl', ['$scope','appConfig', function($scope, appConfig) {
    $scope.appConfig = appConfig;
}]);

app.directive('formUserfield', function() {
    return {
        controller: 'FormUserfieldCtrl',
        restrict: 'E',
        templateUrl: 'partials/form-userfield.html'
    };
});


app.controller('FormTypefieldCtrl', ['$scope','appConfig', function($scope, appConfig) {
    $scope.appConfig = appConfig;
}]);

app.directive('formTypefield', function() {
    return {
        controller: 'FormTypefieldCtrl',
        restrict: 'E',
        templateUrl: 'partials/form-typefield.html'
    }
});
