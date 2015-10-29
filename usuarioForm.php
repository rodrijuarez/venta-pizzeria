<!DOCTYPE html>
<html ng-app="venta-pizzeria">
<head>
	<title> Formulario de Usuario</title>

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
	<script src="js/angular/controller/usuario.js"></script>


	<link href="css/ui-lightness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script src="js/jquery-1.8.3.js"></script>
	<script src="js/jquery-ui-1.9.2.custom.js"></script>
</head>
<body>
	<div ng-controller="usuarioFormController">
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
						<li ><a href="listadoOrdenes.php">Ordenes<span class="sr-only">(current)</span></a></li>
						<li class="active"><a href="listadoUsuarios.php">Usuarios<span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="page-header">
				<h1>Formulario de Usuario</h1>
			</div>
			<form>
				<div class="form-group">
					<input type="text" ng-model="usuario.usuario" class="form-control" placeholder="Usuario">
				</div>
				<div class="form-group">
					<input type="text" ng-model="usuario.password" class="form-control" placeholder="Contraseña">
				</div>
				<div class="form-group">
					<input type="text" ng-model="usuario.nombre" class="form-control" placeholder="Nombre">
				</div>
				<div class="form-group">
					<fieldset id="sexo">
						<div class="radio">
							<label><input type="radio" ng-model="usuario.sexo" value="F">Femenino</label>
						</div>
						<div class="radio">
							<label><input type="radio" ng-model="usuario.sexo" value="M">Masculino</label>
						</div>
					</fieldset>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" ng-model="usuario.tieneCelular">Tiene celular</label>
				</div>
				<div class="form-group" ng-show="usuario.tieneCelular">
					<input type="text" ng-model="usuario.celular" class="form-control" placeholder="Celular">
				</div>
				<div class="form-group">
					<fieldset id="rol">
						<div class="radio">
							<label>
								<input type="radio" ng-model="usuario.rol" name="rol" value="U"/>Usuario
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" ng-model="usuario.rol" name="rol" value="A">Administrador
							</label>
						</div>
					</fieldset>
				</div>
				<div class="form-group">
					<input type="text" ng-model="usuario.sucursal" class="form-control" placeholder="Sucursal">
				</div>
				<pre>user = {{usuario | json}}</pre>
				<input class="btn btn-success pull-right" ng-click="guardar(usuario)" value="Guardar" />
			</form>
		</div>
	</div>
</body>
</html>

