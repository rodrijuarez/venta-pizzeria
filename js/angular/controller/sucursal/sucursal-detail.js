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
    $scope.cargarMapa();
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

  $scope.init=function(){
    $scope.traerSucursal($routeParams.id);
  }
  $scope.cargarMapa = function(){
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -34.397, lng: 150.644},
      zoom: 8
    });
    geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': $scope.sucursal.direccion}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
        });
      }
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
