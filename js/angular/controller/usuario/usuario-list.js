angular.module('venta-pizzeria').controllerProvider.register('UsuarioListController', function($scope, $http){
    $scope.exportPdf = function(users){
        var doc = new jsPDF();

        doc.setFontSize(40);
        doc.text(35, 25, "Usuarios");
        var height = 45;
        for(user in users){
            doc.text(25,height,"Usuario: ")
            doc.text(80,height,users[user].usuario)
            height+=50;
        }
        doc.save('usuarios.pdf');
    }

    $scope.init = function() {
        $http.get('ajax/traerUsuarios.php').
        success(function(response) {
            $scope.results = response;
        }, function(response) {
            alert("hola");
        });
    };

    $scope.eliminarUsuario = function(usuario) {
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:200,
            modal: true,
            buttons: {
                "Eliminar Usuario": function() {
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
                            var index = $scope.results.indexOf(usuario);
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
