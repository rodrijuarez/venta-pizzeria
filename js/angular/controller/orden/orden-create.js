angular.module('venta-pizzeria').controllerProvider.register('OrdenCreationController', function($scope, $http,$routeParams){
    $scope.productos = [];

    $scope.productosOrden = [];

    $scope.traerOrden = function(id){
        $http.get('/venta-pizzeria/ajax/traerUnaOrden.php?orden=' + id).then($scope.cargarOrden);
        $scope.edicion = true;
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
    };
    $scope.init();

    $scope.addProducto = function(){
        $scope.orden.productosOrden.push({"id_producto" : "",
            cantidad:""})
    };
    if($routeParams.id != undefined){
        $scope.traerOrden($routeParams.id);
    }else{
        $scope.orden = {productosOrden: []};
    }
});
