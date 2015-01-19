var app = angular.module('ecommerceApp', ['ngResource']);

app.config(['$httpProvider', function ($httpProvider) {
  //Reset headers to avoid OPTIONS request (aka preflight)
  $httpProvider.defaults.headers.common = {};
  $httpProvider.defaults.headers.post = {};
  $httpProvider.defaults.headers.put = {};
  $httpProvider.defaults.headers.patch = {};
}]);

app.factory("Users", function ($resource) {
    return $resource("http://www.corsproxy.com/codewarriors.me/api/v1/user");
});


app.controller("UsersCtrl", function ($scope, Users) {
    Users.query(function (data) {
        $scope.posts = data;
        console.log($scope.posts);
    });
});
