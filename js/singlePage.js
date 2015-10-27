
var app = angular.module('venta-pizzeria', []);

app.controller('single-page-controller', function($scope, $http,$anchorScroll,$location){
    $scope.gotoBlog = function() {
      $location.hash('blog');
      $anchorScroll();
  }
      $scope.gotoHome = function() {
      $location.hash('Home');
      $anchorScroll();
  }
      $scope.gotoSuscribe = function() {
      $location.hash('suscribe');
      $anchorScroll();
  }
      $scope.gotoContactUs = function() {
      $location.hash('contact-us');
      $anchorScroll();
  }
      $scope.gotoAboutUs = function() {
      $location.hash('about-us');
      $anchorScroll();
  }
      $scope.gotoPrice = function() {
      $location.hash('price');
      $anchorScroll();
  }
});
