angular.module('venta-pizzeria').controllerProvider.register('UsuarioCreationController', function($scope, $http){
    $scope.guardar = function(usuario){
        usuario.alta =0;
        $http.post('/venta-pizzeria/submitUsuario.php',usuario).then($scope.mostrarMensaje);
    }

    $scope.mostrarMensaje = function(response){
        $location.path('/usuarios');
        $location.replace();
    }
});
