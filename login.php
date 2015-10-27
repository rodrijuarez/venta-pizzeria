<?php
include('clases/AccesoDatos.php'); // Includes Login Script
include('logear.php'); // Includes Login Script

if(isset($_SESSION['usuario'])){
  header("location: listadoProductos.php");
}
?>
<!DOCTYPE html>
<html ng-app="venta-pizzeria">
<head>
  <title> Login</title>

  <script src=" http://code.ionicframework.com/1.0.0-beta.14/js/ionic.bundle.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular-sanitize.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Latest compiled JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/angular.min.js"></script>
</head>
<body>
  <div id="main" ng-controller="loginController">
    <h1>Login</h1>
    <div >
      <form action="" method="post">
        <label>Usuario :</label>
        <input id="name" name="usuario" placeholder="Usuario" type="text">
        <label>Password :</label>
        <input id="password" name="password" placeholder="**********" type="password">
        <input name="submit" type="submit" value=" Login ">
        <span><?php echo $error; ?></span>
      </form>
    </div>
  </div>
</body>
</html>
<script type="text/javascript">
  var app = angular.module('venta-pizzeria', []);

  app.controller('loginController', function($scope, $http){
  });
</script>
</html>

