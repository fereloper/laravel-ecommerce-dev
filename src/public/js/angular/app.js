var app = angular.module('ecommerceApp', ['ngResource']);


app.factory("Users", function ($resource) {
    return $resource("api/v1/user");
});


app.controller("UsersCtrl", function ($scope, Users) {
    Users.query(function (data) {
        $scope.posts = data;
        console.log($scope.posts);
    });
});
