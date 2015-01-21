'user strict';
app.config(['$routeProvider', function($routeProvider) {
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
            })
            .when('/user/edit', {
              title: "Profile Edit",
              templateUrl: 'template/profile_edit.html',
              controller: 'ProfileCtrl'
            })
            .when('/user/verify/:token/:id', {
              title: "Verify your account",
              templateUrl: 'template/verify.html',
              controller: 'verifyCtrl'
            });
  }]);

