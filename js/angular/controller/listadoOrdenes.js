angular.module('venta-pizzeria').controllerProvider.register('ListadoOrdenesController', function($scope, $http){
    $scope.init = function() {
        $http.get('ajax/traerOrdenes.php').
        success(function(response) {
            $scope.results = response;
            $scope.$apply();
        }, function(response) {
            alert("hola");
        });
    };

    $scope.eliminarOrden = function(orden) {
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:200,
            modal: true,
            buttons: {
                "Cancelar Orden": function() {
                    var $this = $(this);
                    var method = 'POST';
                    var url = 'ajax/eliminarOrden.php';
                    var data = {
                        'nro_orden' : orden.nro_orden
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
