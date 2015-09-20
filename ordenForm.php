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
                    <input type="text" name="domicilioCliente" class="form-control" placeholder="Domicilio del cliente" required
                    value="<?php
                    echo $orden->domicilio_cliente;
                    ?>">
                </div>
                <div class="form-group">
                    <input type="text" name="telefonoCliente" class="form-control" placeholder="Telefono del cliente" required
                    value="<?php
                    echo $orden->telefono_cliente;
                    ?>">
                </div>
                <input class="btn btn-success pull-right" type="submit" value="Save" />
            </form>
        </div>
    </div>
</body>
</html>

