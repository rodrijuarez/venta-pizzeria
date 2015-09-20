<!DOCTYPE html>
<html ng-app="venta-pizzeria">
<?php
include_once("clases/AccesoDatos.php");
include_once("clases/orden.php");
$edicion = false;
if(isset($_GET["nro_orden"])){
    $edicion = true;
    $nro_orden = $_GET["nro_orden"];
    $orden = Orden::TraerUnaOrden($nro_orden);
}else{
    $orden = new Orden();
}
?>
<head>
    <title> Orden</title>

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
    <div ng-controller="ordenFormController">
        <div class="container">
            <div class="page-header">
                <h1>Orden</h1>
            </div>
            <form method="POST" action="submitOrden.php">
                <input type="hidden" name="nro_orden"
                value="<?php
                echo $nro_orden;
                ?>">
                <div class="form-group">
                    <label>Domicilio del Cliente</label>
                    <input type="text" name="domicilioCliente" class="form-control" placeholder="Domicilio del cliente" required
                    value="<?php
                    echo $orden->domicilio_cliente;
                    ?>">
                </div>
                <div class="form-group">
                    <label>Telefono del Cliente</label>
                    <input type="text" name="telefonoCliente" class="form-control" placeholder="Telefono del cliente" required
                    value="<?php
                    echo $orden->telefono_cliente;
                    ?>">
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading"> Productos Solicitados
                        <button type="button" class="btn btn-default pull-right add-product" ng-click="addProducto()">+</button>
                    </div>
                    <div class="form-group">
                        <label>Producto</label>
                        <select type="text" name="productos" class="form-control" ng-options="item.id_producto as item.descripcion for item in productos" ng-model="productoSeleccionado">
                            <option value="" ng-if="false"></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cantidad</label>
                        <input type="text" name="Cantidad" class="form-control" placeholder="cantidad">
                    </div>
                </div>
                <input class="btn btn-success pull-right" type="submit" value="Save" />
            </form>
        </div>
    </div>
</body>
<script type="text/javascript">
    var app = angular.module('venta-pizzeria', []);

    app.controller('ordenFormController', function($scope, $http){

        $scope.productos = [];

        $scope.init = function() {
            $http.get('ajax/traerProductos.php').
            success(function(response) {
                $scope.productos = response;
                $scope.productoSeleccionado = $scope.productos[0];
            }, function(response) {
                alert("hola");
            });
        };
        $scope.init();

        $scope.addProducto = function(){
            alert("Hola");
        };

    });
</script>
</html>

