app.controller('MainNavigationCtrl', ['$scope', function($scope) {
    $scope.active = "home";

    $scope.$on('$locationChangeStart', function(e, newRoute, oldRoute) {
        if( newRoute.includes('create') ) {
            $scope.active = 'create';
        } else if( newRoute.includes('stat') ) {
            $scope.active = 'statistics';
        } else if( newRoute.includes('filter') ) {
            $scope.active = '';
        } else {
            $scope.active = 'home';
        }
    });

    var items = [
        {
            name: 'home',
            label: 'Översikt',
            href: '/#/home'
        },
        {
            name: 'create',
            label: 'Lägg till',
            href: '/#/expenses/create'
        },
        {
            name: 'statistics',
            label: 'Statistik',
            href: '/#/statistics'
        }
    ];

    $scope.items = items;

    $scope.setActive = function( name ) {
        $scope.active = name;
    };
}]);

app.directive('mainNavigation', function() {
    return {
        controller: 'MainNavigationCtrl',
        restrict: 'E',
        templateUrl: 'partials/main-navigation.html'
    }
});
