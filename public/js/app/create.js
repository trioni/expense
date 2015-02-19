app.controller('CreateModalCtrl', ['$scope','appConfig','routeBuilder','ExpenseResource','$rootScope','$modalInstance',function($scope, appConfig, routes, store, $rootScope, $modalInstance) {

    $scope.config = appConfig;
    $scope.item = {
        displayDate: new Date(),
        include: true
    };

    $scope.save = function() {
        store.create( $scope.item, $scope );
    };

    $scope.cancel = function() {
        routes.goto('home');
        $modalInstance.dismiss('cancel');
    };

    $scope.$on('create-saved', function(e,response) {
        routes.goto('home');
        $modalInstance.close(response.item);
        $rootScope.$broadcast('item-created', response.item);
    });
}]);

/**
 * TODO:
 * Re-use the EditCtrl and use the routeParams for determining
 * the templateUrl. No need to have separate Controllers for this.
 */
app.controller('CreateCtrl', ['$scope','$modal', function($scope, $modal) {

    var openModal, modalInstance;

    openModal = function() {
        if( modalInstance ) return;

        modalInstance = $modal.open({
            templateUrl: 'partials/create.html',
            controller: 'CreateModalCtrl',
            size: 'lg',
            backdrop: 'static'
        });
    };

    openModal();
}]);
