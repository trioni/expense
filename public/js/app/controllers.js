app.controller('ListCtrl', ['$http', '$log', '$scope','$rootScope','ExpenseResource', function($http, $log, $scope, $rootScope, store) {
    var list = this, deleteItem;
    list.items = [];

    $scope.predicate = '-date';

    $rootScope.$on('item-update', function(e, updatedItem) {
        $scope.updateItem(updatedItem);
    });

    $rootScope.$on('item-created', function(e, createdItem) {
        $scope.add(createdItem);
    });

    var itemRestored = $scope.$on('item-restored', function(e, restoredItem) {
        $scope.add(restoredItem);
    });

    $scope.$on('$destroy', function() {
        console.log('<<< Destroying listener >>>');
        itemRestored(); // remove listener.
    });

    $rootScope.$on('list-loaded', function(e, response) {
        list.items = response.data;
    });

    $rootScope.$on('delete-saved', function(e, response) {
        var removedItem = response.data;
        deleteItem(removedItem);
    });

    $scope.add = function(createdItem) {
        list.items.unshift(createdItem);
    };

    deleteItem = function( removedItem ) {
        var i = 0, len = list.items.length;

        for(i; i < len; ++i) {
            if( list.items[i].id === removedItem.id ) {
                list.items.splice(i, 1);
                break;
            }
        }
    };

    $scope.updateItem = function(updatedItem) {
        var i = 0, len = list.items.length;

        for(i; i < len; ++i) {
            if( list.items[i].id === updatedItem.id ) {
                list.items[i] = updatedItem;
                break;
            }
        }
    };

    store.loadList();
}]);

app.controller('ListItemCtrl', ['$log', '$scope', 'ExpenseResource', function($log, $scope, store) {
    $scope.actionState = 'closed';

    $scope.toggleActions = function() {
        $scope.actionState = ($scope.actionState === 'open') ? 'closed':'open';
    };

    $scope.clickHandler = function() {
        $scope.toggleActions();
    };

    $scope.delete = function( item ) {
        store.delete(item, $scope);
    };

}]);

app.controller('PagingCtrl', ['$scope','$rootScope','$location', function($scope, $rootScope, $location) {
    var update;

    $scope.maxSize = 5;

    update = function( response ) {
        $scope.totalItems = response.total;
        $scope.currentPage = response.current_page;
        $scope.itemsPerPage = response.per_page;
        $scope.numPages = response.last_page;
    };

    $rootScope.$on('list-loaded', function(e, response) {
        update( response );
    });

    $scope.changePage = function() {
        $location.path('/filter').search('page', $scope.currentPage);
    };
}]);
