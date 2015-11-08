angular.module('venta-pizzeria').controllerProvider.register('SucursalCreationController', function($scope, $http,$location){
    $scope.guardar = function(sucursal){
        sucursal.alta =1;
        $http.post('/venta-pizzeria/submitSucursal.php',sucursal).then($scope.mostrarMensaje);
    }

    $scope.mostrarMensaje = function(response){
        $location.path('/sucursales');
        $location.replace();
    }
});
