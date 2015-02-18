app.controller('FilterCtrl', ['$scope','$routeParams','ExpenseResource', function($scope, $routeParams, store) {
    store.filteredList($routeParams);
}]);
