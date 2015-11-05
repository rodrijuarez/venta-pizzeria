angular.module('venta-pizzeria').controller('usuarioFormController', function($scope, $http,urlUtils){
    $scope.guardar = function(usuario){
        usuario.alta = (urlUtils.getUrlParameter("usuario") != undefined) ? false : true;
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
    if(urlUtils.getUrlParameter("usuario") != undefined){
        $scope.traerUsuario(urlUtils.getUrlParameter("usuario"));
    }
});
