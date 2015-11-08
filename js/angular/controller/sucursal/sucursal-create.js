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
    });
