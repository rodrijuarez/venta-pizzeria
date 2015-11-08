angular.module('venta-pizzeria').controllerProvider.register('SucursalCreationController', function($scope, $http,$location,uiGmapIsReady,$timeout){
    $scope.guardar = function(sucursal){
        sucursal.alta =1;
        $http.post('/venta-pizzeria/submitSucursal.php',sucursal).then($scope.mostrarMensaje);
    }

    $scope.mostrarMensaje = function(response){
        $location.path('/sucursales');
        $location.replace();
    }
    $scope.init = function(){
        $scope.map = {center: {latitude: -34.6122402, longitude: -58.394864 }, zoom: 14, bounds: {} };
        $scope.options = {scrollwheel: true};
        $scope.locales = [];
        $scope.locales.push({id:1,latitude:-34.6122402,longitude:-58.394864,title:'Ugi'});
    }
    $scope.init();
});
