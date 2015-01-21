'user strict';
app.config(['$routeProvider', function ($routeProvider) {
        $routeProvider
                .when('/profile', {
                    templateUrl: 'template/profile.html',
                    controller: 'ProfileCtrl'
                })
                .when('/user', {
                    title: "User Page",
                    templateUrl: 'template/user.html',
                    controller: 'authCtrl'
                })
                 .when('/user/confirmation', {
                    title: "Successfully Registered",
                    templateUrl: 'template/user_success.html',
                    controller: 'authCtrl'
                });
    }]);