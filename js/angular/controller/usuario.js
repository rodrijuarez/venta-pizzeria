var app = angular.module('venta-pizzeria', []);

app.controller('usuarioFormController', function($scope, $http){
        $scope.guardar = function(usuario){
                $http.post('/venta-pizzeria/probandoUsuario.php',usuario).then($scope.mostrarMensaje);
        }
        $scope.mostrarMensaje = function(response){
            alert(response.data);
        }
});
