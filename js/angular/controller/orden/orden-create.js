angular.module('venta-pizzeria').controllerProvider.register('OrdenCreationController', function($scope, $http,$routeParams,$location){
    $scope.productos = [];

    $scope.productosOrden = [];

    $scope.guardar = function(orden){
        orden.alta = 1;
        $http.post('/venta-pizzeria/submitOrden.php',orden).then($scope.mostrarMensaje);
    }

    $scope.mostrarMensaje = function(response){
        $location.path('/ordenes');
        $location.replace();
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
        $scope.orden = {productosOrden: []};
        $scope.orden.pagaConCambio = 1;
    };
    $scope.init();

    $scope.addProducto = function(){
        $scope.orden.productosOrden.push({"id_producto" : "",
            cantidad:""})
    };
});
