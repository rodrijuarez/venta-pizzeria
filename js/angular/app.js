var app = angular.module('venta-pizzeria', ['ngRoute']);

app.config(function($routeProvider,$controllerProvider, $compileProvider, $filterProvider, $provide) {
    app.controllerProvider = $controllerProvider;
    app.compileProvider = $compileProvider;
    app.routeProvider = $routeProvider;
    app.filterProvider = $filterProvider;
    app.provide = $provide;

    var controllerLoadingFactory = function(deps) {
        return ['$q', '$rootScope', function($q, $rootScope) {
            var deferred = $q.defer();
            $script(deps, function() {
                $rootScope.$apply(function() { deferred.resolve(); });
            });
            return deferred.promise;
        }];
    };

    $routeProvider.when('/ordenes', {
        templateUrl : 'partials/orden/orden-list.html',
        controller : 'ListadoOrdenesController', resolve:controllerLoadingFactory(['js/angular/controller/orden/listadoOrdenes.js?v2'])
    });
    $routeProvider.when('/orden/nueva', {
        templateUrl : 'partials/orden/orden-create.html',
        controller : 'OrdenCreationController', resolve:controllerLoadingFactory(['js/angular/controller/orden/orden-create.js?v3'])
    });
    $routeProvider.when('/orden/detalle/:id', {
        templateUrl : 'partials/orden/orden-create.html',
        controller : 'OrdenCreationController', resolve:controllerLoadingFactory(['js/angular/controller/orden/orden-create.js?v3'])
    });
    $routeProvider.otherwise({
        redirectTo : '/ordenes'
    });
} );
