var app = angular.module('ecommerceApp', ['ngRoute']);

//All configs
app.config(['$routeProvider', function ($routeProvider) {
        $routeProvider
                .when('/', {
                    templateUrl: 'template/home.html'
                })
                .when('/user', {
                    title: "User Page",
                    templateUrl: 'template/user.html',
                    controller: 'authCtrl'
                });
    }]);
//All Services
//app.factory("Users", function ($resource) {
//    return $resource("api/v1/user");
//});
app.factory("Data", ['$http',
    function ($http) { // This service connects to our REST API

        var serviceBase = 'api/v1/';

        var obj = {};
        
        obj.get = function (q) {
            return $http.get(serviceBase + q).then(function (results) {
                return results.data;
            });
        };
        obj.post = function (q, object) {
            
            return $http.post(serviceBase + q, object).then(function (results) {
                return results.data;
            });
        };
        obj.put = function (q, object) {
            return $http.put(serviceBase + q, object).then(function (results) {
                return results.data;
            });
        };
        obj.delete = function (q) {
            return $http.delete(serviceBase + q).then(function (results) {
                return results.data;
            });
        };

        return obj;
    }]);




//All controllers
//app.controller("UsersCtrl", function ($scope, Users) {
//    Users.query(function (data) {
//        $scope.users = data;
//    });
//});

app.controller('authCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data) {
    //initially set those objects to null to avoid undefined error
    $scope.login = {};
    $scope.signup = {};
    $scope.doLogin = function (user) {
        
        console.log(user);
        
        
        Data.post('login', {
            user: user
        }).then(function (results) {
            console.log(results);
//            Data.toast(results);
            if (results.status == "success") {
                $location.path('dashboard');
            }
        });
    };
    $scope.signup = {email:'',password:'',name:'',phone:'',address:''};
    $scope.signUp = function (customer) {
        Data.post('signUp', {
            customer: customer
        }).then(function (results) {
//            Data.toast(results);
            if (results.status == "success") {
                $location.path('dashboard');
            }
        });
    };
    $scope.logout = function () {
        Data.get('logout').then(function (results) {
//            Data.toast(results);
            $location.path('login');
        });
    }
});

app.directive('focus', function() {
    return function(scope, element) {
        element[0].focus();
    }      
});
