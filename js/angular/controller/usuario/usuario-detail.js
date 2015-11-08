angular.module('venta-pizzeria').controllerProvider.register('UsuarioDetailController', function($scope, $http,$routeParams,$location){
    $scope.guardar = function(usuario){
        usuario.alta = 0;
        $http.post('/venta-pizzeria/submitUsuario.php',usuario).then($scope.mostrarMensaje);
    }

    $scope.traerUsuario = function(usuario){
        $http.get('/venta-pizzeria/ajax/traerUsuario.php?usuario=' + usuario).then($scope.cargarUsuario);
        $scope.edicion = true;
    }

    $scope.cargarUsuario = function(response){
        $scope.usuario = response.data;
    }

    $scope.mostrarMensaje = function(response){
        $location.path('/usuarios');
        $location.replace();
    }
    $scope.traerUsuario($routeParams.id);
});
