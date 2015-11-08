angular.module('venta-pizzeria').controllerProvider.register('OrdenDetailController', function($scope, $http,$routeParams,$location){
    $scope.productos = [];

    $scope.productosOrden = [];

    $scope.guardar = function(orden){
        orden.alta = 0;
        $http.post('/venta-pizzeria/submitOrden.php',orden).then($scope.mostrarMensaje);
    }

    $scope.mostrarMensaje = function(response){
        alert(response.data);
        $location.path('/ordenes');
        $location.replace();
    }

    $scope.traerOrden = function(id){
        $http.get('/venta-pizzeria/ajax/traerUnaOrden.php?orden=' + id).then($scope.cargarOrden);
    }

    $scope.cargarOrden = function(response){
        $scope.orden = response.data;
    }

    $scope.init = function() {
        $http.get('ajax/traerProductos.php').
        success(function(response) {
            $scope.productos = response;
            $scope.productoSeleccionado = $scope.productos[0];
        }, function(response) {
            alert("hola");
        });
        $scope.traerOrden($routeParams.id);
    };
    $scope.init();

    $scope.addProducto = function(){
        $scope.orden.productosOrden.push({"idProducto" : "",
            cantidad:""})
    };
});
