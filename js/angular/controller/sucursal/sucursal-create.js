angular.module('venta-pizzeria').controllerProvider.register('SucursalCreationController', function($scope, $http,$location,uiGmapIsReady,$timeout,$rootScope, $cookies){
  $scope.guardar = function(sucursal){
    sucursal.alta =1;
    $http.post('/venta-pizzeria/submitSucursal.php',sucursal).then($scope.mostrarMensaje);
  }

  $scope.mostrarMensaje = function(response){
    $location.path('/sucursales');
    $location.replace();
  }

  $scope.init = function(){
    $rootScope.globals = $cookies.get('globals');
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -34.397, lng: 150.644},
      zoom: 8
    });
    var input = document.getElementById('searchBox');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
    });

    var markers = [];
    searchBox.addListener('places_changed', function() {
      var places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      }

      markers.forEach(function(marker) {
        marker.setMap(null);
      });
      markers = [];

      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {
        var icon = {
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(25, 25)
        };

        markers.push(new google.maps.Marker({
          map: map,
          icon: icon,
          title: place.name,
          position: place.geometry.location
        }));

        if (place.geometry.viewport) {
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      map.fitBounds(bounds);
    });
  }
  $scope.init();
});
