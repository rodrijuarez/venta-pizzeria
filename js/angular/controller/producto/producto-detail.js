angular.module('venta-pizzeria').controllerProvider.register('ProductoDetailController', function($scope, $http,$routeParams,$location,Upload){
    $scope.guardar = function(producto){
        producto.alta = 0;
        Upload.upload({
            url: '/venta-pizzeria/submitProducto.php',
            data: producto,
            file: producto.imagen,
        }).then($scope.mostrarMensaje);
    }

    $scope.traerProducto = function(producto){
        $http.get('/venta-pizzeria/ajax/traerProducto.php?producto=' + producto).then($scope.cargarProducto);
        $scope.edicion = true;
    }

    $scope.cargarProducto = function(response){
        $scope.producto = response.data;
        $scope.producto.id = $routeParams.id;
    }

    $scope.mostrarMensaje = function(response){
        $location.path('/productos');
        $location.replace();
    }
    $scope.traerProducto($routeParams.id);
});
