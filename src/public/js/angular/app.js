'user strict';

var app = angular.module('ecommerceApp', ['ngRoute']);


app.directive('focus', function() {
  return function(scope, element) {
    element[0].focus();
  }
});


app.run(function($rootScope, $location, authService) {
  var routePermission = ['/home'];
  $rootScope.$on('$routeChangeStart', function() {
    if (routePermission.indexOf($location.path()) != -1 && !authService.isLogged()) {
      $location.path('user');
    }
  });
});
