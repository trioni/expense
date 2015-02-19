app.controller('EditModalCtrl', ['$scope','appConfig','routeBuilder','ExpenseResource','$rootScope','$modalInstance',function($scope, appConfig, routes, store, $rootScope, $modalInstance) {

    $scope.config = appConfig;

    $rootScope.$on('edit-loaded', function(e,data) {
        $scope.item = data;
    });

    $scope.save = function() {
        store.save( this.item, this );
    };

    $scope.cancel = function() {
        routes.goto('home');
        $modalInstance.dismiss('cancel');
    };

    $scope.$on('edit-saved', function(e,response) {
        routes.goto('home');
        $modalInstance.close(response.item);
        $rootScope.$broadcast('item-update', response.item);
    });

    store.load();
}]);

app.controller('EditCtrl', ['$scope','$modal', function($scope, $modal) {

    var openModal, modalInstance;

    openModal = function() {
        if( modalInstance ) return;

        modalInstance = $modal.open({
            templateUrl: 'partials/edit.html',
            controller: 'EditModalCtrl',
            size: 'lg',
            backdrop: 'static'
        });
    };

    openModal();
}]);
