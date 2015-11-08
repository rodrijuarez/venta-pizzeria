angular.module('venta-pizzeria').controllerProvider.register('SucursalListController', function($scope, $http){
    $scope.init = function() {
        $http.get('ajax/traerSucursales.php').
        success(function(response) {
            $scope.results = response;
        }, function(response) {
            alert("hola");
        });
    };

    $scope.eliminarSucursal = function(sucursal) {
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:200,
            modal: true,
            buttons: {
                "Eliminar Sucursal": function() {
                    var $this = $(this);
                    var method = 'POST';
                    var url = 'ajax/eliminarSucursal.php';
                    var data = {
                        'sucursal' : sucursal.sucursal
                    };
                    $http({
                        method: method,
                        url: url,
                        data: data
                    }).
                    success(function(response) {
                        $this.dialog("close");
                        if(response == "success"){
                            var index = $scope.results.indexOf(sucursal);
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
