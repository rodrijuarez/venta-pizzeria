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
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
      });
    }
    $scope.init();
});
