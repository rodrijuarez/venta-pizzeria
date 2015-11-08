angular.module('venta-pizzeria').controllerProvider.register('UsuarioListController', function($scope, $http){
    $scope.init = function() {
        $http.get('ajax/traerUsuarios.php').
        success(function(response) {
            $scope.results = response;
        }, function(response) {
            alert("hola");
        });
    };

    $scope.eliminarOrden = function(usuario) {
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:200,
            modal: true,
            buttons: {
                "EliminarUsuario": function() {
                    var $this = $(this);
                    var method = 'POST';
                    var url = 'ajax/eliminarUsuario.php';
                    var data = {
                        'usuario' : usuario.usuario
                    };
                    $http({
                        method: method,
                        url: url,
                        data: data
                    }).
                    success(function(response) {
                        $this.dialog("close");
                        if(response == "success"){
                            var index = $scope.results.indexOf(orden);
                            $scope.results.splice(index, 1);
                            $scope.$apply();
                            $( "#dialog-success" ).dialog();
                        }else{
                            $( "#dialog-error" ).dialog();
                        }
                    }, function(response) {
                        $this.dialog( "close" );
                        $( "#dialog" ).dialog();
                    });
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
};
$scope.init();
});
