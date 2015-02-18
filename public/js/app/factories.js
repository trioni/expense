//-- Services --//
app.factory('appConfig', ['$http', function($http) {
    var req, onSuccess, configObj;

    configObj = {
        titles: null,
        users: null,
        types: null,
        be: window.be
    };

    onSuccess = function( response ) {
        configObj.titles = response.titles;
        configObj.users = response.users;
        configObj.types = response.types;
    };

    req = $http.get('app');
    req.success(onSuccess);

    return configObj;
}]);

app.factory('routeBuilder', function() {
    return {
        get: function( action, id ) {
            switch( action ) {
                case 'edit':
                    return '/expenses/' + id + '/edit';
                case 'save':
                    return '/expenses/' + id;
                case 'create':
                    return '/expenses';
                case 'filter':
                    return '/expenses/filter';
                case 'delete':
                    return '/expenses/' + id;
                case 'restore':
                    return '/expenses/restore/' + id;
                default:
                    return '/';
            }
        },
        goto: function(name) {
            switch( name ) {
                case 'home':
                    window.location = '/#/home';
                    break;
                default:
                    return;
            }
        },
        action: function( actionName, item ) {
            if( actionName === 'restore' ) {
                return {
                    name: actionName,
                    href:'/expenses/restore/' + item.id,
                    text: 'Återställ ' + item.title,
                    data: item
                }
            }
        }
    };
});

app.factory('ExpenseResource', ['$http','$routeParams','routeBuilder','$rootScope','CSRF_TOKEN', function($http, $routeParams, routeBuilder, $rootScope, CSRF_TOKEN) {
    var onLoaded, onSaved, onCreated, onRestored, onDeleted, onListLoaded, listLoaded, req, item, url, store = {};

    var store = {
        getItem: function() {
            return item;
        },
        load: function() {
            url = routeBuilder.get('edit', $routeParams.id);
            req = $http.get(url, {params:{'json-response':true}});
            req.success(onLoaded);
        },
        loadList: function() {
            req = $http.get('/', {params:{'json-response':true}});
            req.success(onListLoaded);
        },
        filteredList: function( params, $scope ) {
            url = routeBuilder.get('filter');
            params['json-response'] = true;
            req = $http.get(url, {params: params});
            req.success(onListLoaded);
        },
        save: function( item, $scope ) {
            store.$scope = $scope;
            item.date = item.displayDate.toISOString().split('T')[0];
            item['json-response'] = true;
            req = $http.put(routeBuilder.get('save', item.id), item);
            req.success(onSaved);
        },
        create: function( item, $scope ) {
            store.$scope = $scope;
            item.date = item.displayDate.toISOString().split('T')[0];
            item['json-response'] = true;
            item['_token'] = CSRF_TOKEN;
            req = $http.post(routeBuilder.get('create', item.id), item);
            req.success(onCreated);
        },
        delete: function( item, $scope ) {
            store.$scope = $scope;
            item['json-response'] = true;
            item['_token'] = CSRF_TOKEN;
            url = routeBuilder.get('delete', item.id);
            req = $http.delete(url, {params:{'json-response':true}});
            req.success(onDeleted);
            return req;
        },
        restore: function(item) {
            url = routeBuilder.get('restore', item.id);
            req = $http.get(url, {params:{'json-response':true}});
            req.success(onRestored);
        }
    };

    $rootScope.$on('restore', function(e,item) {
        store.restore(item);
    });

    onLoaded = function(response) {
        item = response;
        item.displayDate = new Date(response.date);
        $rootScope.$emit('edit-loaded', item);
    };

    onSaved = function(response) {
        store.$scope.$emit('edit-saved', response);
        $rootScope.$emit('message', response);
    };

    onCreated = function(response) {
        store.$scope.$emit('create-saved', response);
        $rootScope.$emit('message', response);
    };

    onListLoaded = function(response) {
        listLoaded(response);
    };

    onDeleted = function(response) {
        store.$scope.$emit('delete-saved', response);
        response.action = routeBuilder.action('restore', response.data);
        $rootScope.$emit('message', response);
    };

    onRestored = function(response) {
        console.log('---Restored---');
        $rootScope.$broadcast('item-restored', response.data);
    };

    listLoaded = function(response) {
        // Give the pagination data to update
        $rootScope.$emit('list-loaded', response);
    };

    return store;
}]);
