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
	<link href="css/style.css" rel="stylesheet">
	<script src="js/jquery-1.8.3.js"></script>
	<script src="js/jquery-ui-1.9.2.custom.js"></script>
</head>
<body>
	<div ng-controller="productoFormController">
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
						<li class="active"><a href="listadoProductos.php">Productos<span class="sr-only">(current)</span></a></li>
						<li ><a href="listadoOrdenes.php">Ordenes<span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="page-header">
				<h1>Listado de Productos</h1>
			</div>
			<form method="POST" action="submitProducto.php" enctype="multipart/form-data">
			 	<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
				<input type="hidden" name="id"
				value="<?php
				echo $id;
				?>">
				<div class="form-group">
					<input type="text" name="descripcion" class="form-control" placeholder="Descripcion" required
					value="<?php
					echo $descripcion;
					?>">
				</div>
				<div class="form-group">
					<input type="text" name="precio" class="form-control" placeholder="Precio" required
					value="<?php
					echo $precio;
					?>">
				</div>
				<div class="form-group">
					<input type="file" name="imagen"/>
				</div>
				<input class="btn btn-success pull-right" type="submit" value="Save" />
			</form>
		</div>
	</div>
</body>
</html>

