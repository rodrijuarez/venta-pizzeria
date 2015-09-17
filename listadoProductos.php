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
</head>
<body>
	<div ng-controller="listadoProductosController">
		<div class="container">
			<div class="page-header">
				<h1>Listado de Productos</h1>      
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
							Stock
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
							{{ producto.stock }}
						</td>
						<td>
							<a href="productoForm.php?id={{ producto.id_producto }}">Modificar</a>
						</td>
						<td>
							<a ng-click="eliminarProducto(producto.id_producto)">Eliminar</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>
<div id="dialog-confirm" title="Eliminar Producto">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta seguro que desea eliminar el producto?</p>
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

		$scope.eliminarProducto = function(idProducto) {
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"Eliminar Producto": function() {
						$http.post('ajax/eliminarProducto.php?id=' + idProducto).
						success(function(response) {
							alert(response);
						}, function(response) {
							alert("hola");
						});
						$( this ).dialog( "close" );
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

