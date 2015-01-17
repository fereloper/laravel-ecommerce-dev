angular.module('ecommerceApp', ['ngResource'])
        .controller('UsersCtrl', function($scope, Users) {
          $scope.users = Users.query();
        })
        .factory('Users', function($resource) {
          return $resource('http://codewarriors.me/api/v1/user');
        });

