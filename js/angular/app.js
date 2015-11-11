angular.module('Authentication', []);
var app = angular.module('venta-pizzeria', ['ngRoute','ngFileUpload','ngCookies','Authentication', 'ngCsv','uiGmapgoogle-maps']);

app.config(function($routeProvider,$controllerProvider, $compileProvider, $filterProvider, $provide,uiGmapGoogleMapApiProvider) {
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

    uiGmapGoogleMapApiProvider.configure({
        key : 'AIzaSyCxb37T9TC2xma21OAQ5mptPDQXNi-n_uA',
                v : '3.20', // defaults to latest 3.X anyhow
                libraries : 'weather,geometry,visualization,places'
            });

    $routeProvider.when('/login', {
        controller: 'Login',
        templateUrl: 'partials/authentication/login.html',
        resolve:controllerLoadingFactory(['js/angular/controller/authentication/login.js'])
    })

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
        controller : 'SucursalCreationController', resolve:controllerLoadingFactory(['js/angular/controller/sucursal/sucursal-create.js','https://maps.googleapis.com/maps/api/js?key=AIzaSyCxb37T9TC2xma21OAQ5mptPDQXNi-n_uA&libraries=places'])
    });
    $routeProvider.when('/sucursal/detalle/:id', {
        templateUrl : 'partials/sucursal/sucursal-detail.html',
        controller : 'SucursalDetailController', resolve:controllerLoadingFactory(['js/angular/controller/sucursal/sucursal-detail.js','https://maps.googleapis.com/maps/api/js?key=AIzaSyCxb37T9TC2xma21OAQ5mptPDQXNi-n_uA&libraries=places'])
    });

    $routeProvider.otherwise({
        redirectTo : '/ordenes'
    });
} ).run(['$rootScope', '$location', '$cookies', '$http',
function ($rootScope, $location, $cookies, $http) {
        // keep user logged in after page refresh
        $rootScope.globals = $cookies.get('globals') || {};
        if ($rootScope.globals.currentUser) {
            $http.defaults.headers.common['Authorization'] = 'Basic ' + $rootScope.globals.currentUser.authdata; // jshint ignore:line
        }

        $rootScope.$on('$locationChangeStart', function (event, next, current) {
            // redirect to login page if not logged in
            if ($location.path() !== '/login' && !$rootScope.globals.currentUser) {
                $location.path('/login');
            }
        });
    }]);
