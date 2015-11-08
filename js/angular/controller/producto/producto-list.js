angular.module('venta-pizzeria').controllerProvider.register('ProductoListController', function($scope, $http){
    $scope.init = function() {
        $http.get('ajax/traerProductos.php').
        success(function(response) {
            $scope.results = response;
        }, function(response) {
            alert("hola");
        });
    };

    $scope.eliminarProducto = function(producto) {
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:200,
            modal: true,
            buttons: {
                "Eliminar Producto": function() {
                    var $this = $(this);
                    var method = 'POST';
                    var url = 'ajax/eliminarProducto.php';
                    var data = {
                        'idProducto' : producto.idProducto
                    };
                    $http({
                        method: method,
                        url: url,
                        data: data
                    }).
                    success(function(response) {
                        $this.dialog("close");
                        if(response == "success"){
                            var index = $scope.results.indexOf(producto);
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
