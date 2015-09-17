<!DOCTYPE html>
<html ng-app="venta-pizzeria"> 
<head>
  <title> Login</title>

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
  <div ng-controller="loginController">
    <div class="container">
      <div class="page-header">
        <h1>Login</h1>      
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">
  var app = angular.module('venta-pizzeria', []);

  app.controller('loginController', function($scope, $http){

    $scope.init = function() {
      alert("tuto bon tuto legal");
    };
    $scope.init();

  });
</script>
</html>

