<!DOCTYPE html>
<html ng-app="venta-pizzeria"> 
<?php
$edicion = false;
$precio ="";
$descripcion="";
$id="";
if(isset($_GET["id"])){
	$edicion = true;
	$id = $_GET["id"];
	$precio = $_GET["precio"];
	$descripcion = $_GET["descripcion"];
}
?>
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
	<script src="js/jquery-1.8.3.js"></script>
	<script src="js/jquery-ui-1.9.2.custom.js"></script>
</head>
<body>
	<div ng-controller="productoFormController">
		<div class="container">
			<div class="page-header">
				<h1>Listado de Productos</h1>      
			</div>
			<form method="POST" action="submitProducto.php">
				<input type="hidden" name="id" 
				value="<?php
				echo $id;
				?>">
				<div class="form-group">
					<input type="text" name="descripcion" class="form-control" placeholder="Descripcion"
					value="<?php
					echo $descripcion;
					?>">
				</div>
				<div class="form-group">
					<input type="text" name="precio" class="form-control" placeholder="Precio" 
					value="<?php
					echo $precio;
					?>">
				</div>
				<input class="btn btn-success pull-right" type="submit" value="Save" />
			</form>
		</div>
	</div>
</body>
</html>

