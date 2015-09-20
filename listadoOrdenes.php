<!DOCTYPE html>
<html ng-app="venta-pizzeria">
<head>
    <title> Listado de Productos</title>

    <meta charset="utf-8">
    <script src=" http://code.ionicframework.com/1.0.0-beta.14/js/ionic.bundle.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular-sanitize.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>

    <link href="css/ui-lightness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery-1.8.3.js"></script>
    <script src="js/jquery-ui-1.9.2.custom.js"></script>
</head>
<body>
    <div ng-controller="listadoOrdenesController">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Pizzeria</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="listadoProductos.php">Productos<span class="sr-only">(current)</span></a></li>
                        <li class="active"><a href="listadoOrdenes.php">Ordenes<span class="sr-only">(current)</span></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="page-header">
                <h1>Listado de Ordenes</h1>
                <a class="btn btn-success pull-right" href="ordenForm.php">Nueva Orden</a>
            </div>
            <table class="table" ng-table="ordenes">
                <thead>
                    <tr>
                        <td class="col-md-4">
                            Domicilio del Cliente
                        </td>
                        <td class="col-md-4">
                            Telefono del Cliente
                        </td>
                        <td class="col-md-3">
                        </td>
                        <td class="col-md-2">
                        </td>
                        <td class="col-md-2">

                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="orden in results">
                        <td>
                            {{ orden.domicilio_cliente }}
                        </td>
                        <td>
                            {{ orden.telefono_cliente }}
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn">Productos</button>
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li ng-repeat="producto in orden.productos"><a href="#">{{producto.descripcion}}</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <a class="btn btn-warning" href="ordenForm.php?nro_orden={{ orden.nro_orden }}">Modificar</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" ng-click="eliminarOrden(orden)">Cancelar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
<div style="display: none;" id="dialog-confirm" title="Cancelar Orden">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta seguro que desea cancelar la orden?</p>
</div>
<div style="display: none;" id="dialog-success" title="Orden Cancelada">
    <p>La orden ha sido eliminada correctamente</p>
</div>
<div style="display: none;" id="dialog-error" title="Error">
    <p>Hubo un problema al cancelar la orden</p>
</div>
<script type="text/javascript">
    var app = angular.module('venta-pizzeria', []);

    app.controller('listadoOrdenesController', function($scope, $http){

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
</script>
</html>

