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
	<div ng-controller="listadoProductosController">
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
						<li><a href="listadoOrdenes.php">Ordenes<span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="page-header">
				<h1>Listado de Productos</h1>
				<a class="btn btn-success pull-right" href="productoForm.php">Nuevo Producto</a>
			</div>
			<table class="table" ng-table="productos">
				<thead>
					<tr>
						<td class="col-md-6">
							Descripcion
						</td>
						<td class="col-md-3">
							Precio
						</td>
						<td class="col-md-3">
						</td>
						<td class="col-md-3">
						</td>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="producto in results">
						<td>
							{{ producto.descripcion }}
						</td>
						<td>
							{{ producto.precio }}
						</td>
						<td>
							<a class="btn btn-warning" href="productoForm.php?id={{ producto.id_producto }}&descripcion={{ producto.descripcion }}&precio={{ producto.precio }}">Modificar</a>
						</td>
						<td>
							<a class="btn btn-danger" ng-click="eliminarProducto(producto)">Eliminar</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>
<div style="display: none;" id="dialog-confirm" title="Eliminar Producto">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta seguro que desea eliminar el producto?</p>
</div>
<div style="display: none;" id="dialog-success" title="Producto Eliminado">
	<p>El producto ha sido eliminado correctamente</p>
</div>
<div style="display: none;" id="dialog-error" title="Error">
	<p>Hubo un problema al eliminar el producto</p>
</div>
<script type="text/javascript">
	var app = angular.module('venta-pizzeria', []);

	app.controller('listadoProductosController', function($scope, $http){

		$scope.init = function() {
			$http.get('ajax/traerProductos.php').
			success(function(response) {
				$scope.results = response;
				$scope.$apply();
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
							'idProducto' : producto.id_producto
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
</script>
</html>

