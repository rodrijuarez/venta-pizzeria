var app = angular.module('venta-pizzeria', []);

app.controller('usuarioFormController', function($scope, $http){
    $scope.guardar = function(usuario){
        usuario.alta = (getUrlParameter("usuario") != undefined) ? false : true;
        $http.post('/venta-pizzeria/submitUsuario.php',usuario).then($scope.mostrarMensaje);
    }

    $scope.traerUsuario = function(usuario){
        $http.get('/venta-pizzeria/ajax/traerUsuario.php?usuario=' + usuario).then($scope.cargarUsuario);
    }

    $scope.cargarUsuario = function(response){
        $scope.usuario = response.data;
    }

    $scope.mostrarMensaje = function(response){
        alert(response.data);
    }


    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

    if(getUrlParameter("usuario") != undefined){
        $scope.traerUsuario(getUrlParameter("usuario"));
    }
});
