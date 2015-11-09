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

    $scope.calcularRuta = function(){
      var start = "your start latlng here";
      var end = "your destinationl latlng here";
      var request = {
          origin:start,
          destination:end,
          travelMode: google.maps.TravelMode.DRIVING
      };
      directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(response);
      }
  });
  }

  $scope.init = function(){
    $scope.map = {center: {latitude: -34.6122402, longitude: -58.394864 }, zoom: 14, bounds: {} };
    $scope.options = {scrollwheel: true};
    $scope.locales = [];
    $scope.locales.push({id:1,latitude:-34.6122402,longitude:-58.394864,title:'Ugi'});
    $scope.events = {
        places_changed: function (searchBox) {
            var place = searchBox.getPlaces();
            if (!place || place == 'undefined' || place.length == 0) {
                console.log('no place data :(');
                    return;
                }

                $scope.map = {
                    "center": {
                        "latitude": place[0].geometry.location.lat(),
                        "longitude": place[0].geometry.location.lng()
                    },
                    "zoom": 18
                };
                $scope.marker = {
                    id: 0,
                    coords: {
                        latitude: place[0].geometry.location.lat(),
                        longitude: place[0].geometry.location.lng()
                    }
                };
            }
        };
    }
    $scope.init();
    $scope.traerSucursal($routeParams.id);
});
