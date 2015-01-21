'user strict';

app.controller('authCtrl', function ($scope, $rootScope, $routeParams, $location, $http, authService) {
    //initially set those objects to null to avoid undefined error
    $scope.login = {};
    $scope.signup = {};
    $scope.doLogin = function (user) {
        authService.login(user);
    };
//    $scope.signup = {email: '', password: '', name: '', phone: '', address: ''};
    $scope.signUp = function (user) {
        authService.signup(user);
    };

});

app.controller('HomeCtrl', ['$scope', '$location', 'authService', function ($scope, $location, authService) {
        $scope.txt = "Home Text";
        $scope.logout = function () {
            authService.logout();
        }
    }]);