angular.module('venta-pizzeria').controllerProvider.register('ProductoCreationController', function($scope, $http,$routeParams,$location,Upload){
    $scope.guardar = function(producto){
        producto.alta = 1;
        Upload.upload({
            url: '/venta-pizzeria/submitProducto.php',
            data: producto,
            file: producto.imagen,
        }).then($scope.mostrarMensaje);
    }

    $scope.mostrarMensaje = function(response){
        $location.path('/productos');
        $location.replace();
    }
});
