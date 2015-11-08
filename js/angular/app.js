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
        controller : 'OrdenListController', resolve:controllerLoadingFactory(['js/angular/controller/orden/orden-list.js'])
    });
    $routeProvider.when('/orden/nueva', {
        templateUrl : 'partials/orden/orden-create.html',
        controller : 'OrdenCreationController', resolve:controllerLoadingFactory(['js/angular/controller/orden/orden-create.js'])
    });
    $routeProvider.when('/orden/detalle/:id', {
        templateUrl : 'partials/orden/orden-detail.html',
        controller : 'OrdenDetailController', resolve:controllerLoadingFactory(['js/angular/controller/orden/orden-detail.js'])
    });

    $routeProvider.when('/usuarios', {
        templateUrl : 'partials/usuario/usuario-list.html',
        controller : 'UsuarioListController', resolve:controllerLoadingFactory(['js/angular/controller/usuario/usuario-list.js'])
    });
    $routeProvider.when('/usuario/nuevo', {
        templateUrl : 'partials/usuario/usuario-create.html',
        controller : 'UsuarioCreationController', resolve:controllerLoadingFactory(['js/angular/controller/usuario/usuario-create.js'])
    });
    $routeProvider.when('/usuario/detalle/:id', {
        templateUrl : 'partials/usuario/usuario-detail.html',
        controller : 'UsuarioDetailController', resolve:controllerLoadingFactory(['js/angular/controller/usuario/usuario-detail.js'])
    });
    $routeProvider.otherwise({
        redirectTo : '/ordenes'
    });
} );
