'user strict';
app.config(['$routeProvider', function ($routeProvider) {
        $routeProvider
                .when('/home', {
                    templateUrl: 'template/home.html',
                    controller: 'HomeCtrl'
                })
                .when('/user', {
                    title: "User Page",
                    templateUrl: 'template/user.html',
                    controller: 'authCtrl'
                });
    }]);