var app = angular.module('venta-pizzeria', ['ngRoute','ngFileUpload']);

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


    $routeProvider.when('/productos', {
        templateUrl : 'partials/producto/producto-list.html',
        controller : 'ProductoListController', resolve:controllerLoadingFactory(['js/angular/controller/producto/producto-list.js'])
    });
    $routeProvider.when('/producto/nuevo', {
        templateUrl : 'partials/producto/producto-create.html',
        controller : 'ProductoCreationController', resolve:controllerLoadingFactory(['js/angular/controller/producto/producto-create.js'])
    });
    $routeProvider.when('/producto/detalle/:id', {
        templateUrl : 'partials/producto/producto-detail.html',
        controller : 'ProductoDetailController', resolve:controllerLoadingFactory(['js/angular/controller/producto/producto-detail.js'])
    });


    $routeProvider.when('/sucursales', {
        templateUrl : 'partials/sucursal/sucursal-list.html',
        controller : 'SucursalListController', resolve:controllerLoadingFactory(['js/angular/controller/sucursal/sucursal-list.js'])
    });
    $routeProvider.when('/sucursal/nueva', {
        templateUrl : 'partials/sucursal/sucursal-create.html',
        controller : 'SucursalCreationController', resolve:controllerLoadingFactory(['js/angular/controller/sucursal/sucursal-create.js'])
    });
    $routeProvider.when('/sucursal/detalle/:id', {
        templateUrl : 'partials/sucursal/sucursal-detail.html',
        controller : 'SucursalDetailController', resolve:controllerLoadingFactory(['js/angular/controller/sucursal/sucursal-detail.js'])
    });

    $routeProvider.otherwise({
        redirectTo : '/ordenes'
    });
} );
