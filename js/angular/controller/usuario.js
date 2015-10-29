var app = angular.module('venta-pizzeria', []);

app.controller('usuarioFormController', function($scope, $http,$location){
$scope.guardar = function(usuario){
usuario.alta = ($location.search.usuario != undefined) ? false : true;
$http.post('/venta-pizzeria/submitUsuario.php',usuario).then($scope.mostrarMensaje);
}
$scope.mostrarMensaje = function(response){
alert(response.data);
}
});
