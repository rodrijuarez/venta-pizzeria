angular.module('venta-pizzeria').controllerProvider.register('SucursalDetailController', function($scope, $http,$routeParams,$location){
    $scope.guardar = function(sucursal){
        sucursal.alta = 0;
        $http.post('/venta-pizzeria/submitSucursal.php',sucursal).then($scope.mostrarMensaje);
    }

    $scope.traerSucursal = function(sucursal){
        $http.get('/venta-pizzeria/ajax/traerSucursal.php?sucursal=' + sucursal).then($scope.cargarSucursal);
        $scope.edicion = true;
    }

    $scope.cargarSucursal = function(response){
        $scope.sucursal = response.data;
    }

    $scope.mostrarMensaje = function(response){
        $location.path('/sucursales');
        $location.replace();
    }
    $scope.traerSucursal($routeParams.id);
});
