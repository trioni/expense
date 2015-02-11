(function() {
    var app = angular.module('expenses', ['ngRoute'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }).constant('CSRF_TOKEN', window.app.csrf_token);

    //-- Services --//
    app.factory('appConfig', ['$http', function($http) {
        var req, onSuccess, configObj;

        configObj = {
            titles: null,
            users: null,
            types: null
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
            }
        };
    });

    app.factory('EditModelService', ['$http','$routeParams','routeBuilder', function($http, $routeParams, routeBuilder) {
        var onSuccess, req, item, url;

        item = {
            title: null,
            owner: null
        };

        url = routeBuilder.get('edit', $routeParams.id);

        onSuccess = function(response) {
            item = response;
        };

        req = $http.get(url, {params:{'json-response':true}});
        req.success(onSuccess);

        return {
            getItem: function() {
                return item;
            }
        };
    }]);

    app.factory('expenseStore', ['$http', function($http) {
        var req, onSuccess, store = {};

        onSuccess = function( response ) {
            store.$scope.$emit('afterSave', response);
        };

        return {
            save: function( item, $scope ) {
                store.$scope = $scope;
                item.date = item.displayDate.toISOString().split('T')[0];
                item['json-response'] = true;
                req = $http.put('/expenses/' + item.id, item);
                req.success(onSuccess);
            }
        };
    }]);

    app.controller('EditCtrl', ['$http','$routeParams','$scope','appConfig','expenseStore', 'routeBuilder', function($http, $routeParams, $scope, appConfig, store, routeBuilder) {
        var onSuccess, req;
        $scope.config = appConfig;

        $scope.item = {
            title: null,
            owner: null
        };

        onSuccess = function(response) {
            $scope.item = response;
            $scope.item.displayDate = new Date(response.date);
        };

        $scope.save = function() {
            store.save( this.item, this );
        };

        $scope.$on('afterSave', function(data) {
            routeBuilder.goto('home');
        });

        req = $http.get('expenses/' + $routeParams.id + '/edit', {params:{'json-response':true}});
        req.success(onSuccess);
    }]);


    app.config(['$routeProvider', function($routeProvider) {
        $routeProvider.when('/expenses/:id/edit', {
            templateUrl: 'partials/edit.html',
            controller: 'EditCtrl'
        })
        .when('/home', {
                controller: 'ListCtrl'
        });
    }]);

    app.filter('typeClass', function optionColorFactory() {
        return function( type ) {
            var typeClass = '';
            switch(type) {
                case 'mat':
                    typeClass = ' label-primary';
                    break;
                case 'restaurang':
                    typeClass = ' label-success';
                    break;
                case 'bar':
                    typeClass = ' label-info';
                    break;
                case 'hem':
                    typeClass = ' label-warning';
                    break;
                case 'resa':
                    typeClass = ' label-danger';
                    break;
                case 'övrigt':
                    typeClass = ' label-default';
                    break;
            }
            return typeClass;
        };
    });


    app.controller('ListCtrl', ['$http', '$log', '$scope', function($http, $log, $scope) {
        var list = this, onResponse;
        list.items = [];
        this.response = $http.get('/', {params:{'json-response':true}});

        $scope.urlTo = function( keyword, id ) {
            switch(keyword) {
                case 'delete':
                    return '/#/expenses/delete/' + id;
                case 'edit':
                    return '/#/expenses/' + id + '/edit';
            }
        };

        onResponse = function(req) {
            list.items = req.data;
            list.summary = 1337;
        };
        this.response.success(onResponse);
    }]);

    app.filter('isActive', function() {
        return function(input, compareValue) {
            return (input === compareValue) ? " active":"";
        };
    });

    app.controller('ListItemCtrl', ['$log', '$scope', 'CSRF_TOKEN', function($log, $scope, CSRF_TOKEN) {
        $scope.actionState = 'closed';

        $scope.toggleActions = function() {
            $scope.actionState = ($scope.actionState === 'open') ? 'closed':'open';
        };

        $scope.clickHandler = function() {
            $scope.toggleActions();
        };

    }]);

    //-- Directives --//
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

    app.filter('statusClass', function() {
        return function(input) {
            switch( input ) {
                case 'success':
                    return 'label-success';
                case 'error':
                    return 'label-danger';
            }
        }
    });

    app.controller('MessageCtrl', ['$scope','$interval', function($scope, $interval) {
        var intervalPromise, diminish, hide;

        diminish = function() {
            intervalPromise = $interval(hide, 4000, 1);
        };

        hide = function() {
            $scope.hidden = true;
        };

        $scope.$on('afterSave', function(e,data) {
            // Data should contain msg and status
            $scope.hidden = false;
            $scope.data = data;
            diminish();
        });

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

})();