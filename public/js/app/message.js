app.controller('MessageCtrl', ['$scope','$interval','$rootScope', function($scope, $interval, $rootScope) {
    var intervalPromise, diminish, hide;

    diminish = function() {
        intervalPromise = $interval(hide, 4000, 1);
    };

    hide = function() {
        $scope.hidden = true;
    };

    $scope.hide = hide;

    $scope.$on('message', function(e,data) {
        // Data should contain msg and status.
        // action is optional: {href:'/action',text:'TakeAction'}
        $scope.hidden = false;
        $scope.data = data;

        if( !data.action ) {
            diminish();
        }
    });

    $scope.takeAction = function( action ) {
        $rootScope.$emit(action.name, action.data);
        hide();
    };

    $scope.$on('destroy', function() {
        $interval.cancel(intervalPromise);
    })
}]);

app.directive('messageview', function() {
    return {
        controller: 'MessageCtrl',
        restrict: 'E',
        templateUrl: 'partials/messageview.html'
    }
});
