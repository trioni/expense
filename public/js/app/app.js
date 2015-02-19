// Polyfills
if (!String.prototype.includes) {
    String.prototype.includes = function() {'use strict';
        return String.prototype.indexOf.apply(this, arguments) !== -1;
    };
}

var app = angular.module('expenses', ['ngRoute','ui.bootstrap','googlechart', function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}]);

app.constant('CSRF_TOKEN', window.app.csrf_token);

app.config(['$routeProvider', function($routeProvider) {

    $routeProvider
        .when('/expenses/:id/edit', {
            template: '',
            controller: 'EditCtrl'
        })
        .when('/expenses/create', {
            templateUrl: '/partials/create.html',
            controller: 'CreateCtrl'
        })
        .when('/filter', {
            template: '',
            controller: 'FilterCtrl'
        })
        .when('/statistics', {
            template: '',
            controller: 'StatisticsCtrl'
        })
        .otherwise({
            redirectTo: '/home'
        });
}]);
