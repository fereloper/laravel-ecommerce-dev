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
                    controller: 'ConfirmCtrl'
                })
                .when('/user/edit', {
                    title: "Profile Edit",
                    templateUrl: 'template/profile_edit.html',
                    controller: 'ProfileEditCtrl'
                })
                .when('/user/verify/:token/:id', {
                    title: "Verify your account",
                    templateUrl: 'template/verify.html',
                    controller: 'verifyCtrl'
                })
                .when('/product/uplaod', {
                    title: "Verify your account",
                    templateUrl: 'template/product/produt-view.html',
                    controller: 'UploadCtrl'
                })
                .when('/category/:cat_name/sub/:sub_name', {
                    title: "Product Listing",
                    templateUrl: 'template/product/produt-list.html',
                    controller: 'CategoryCtrl'
                })
                .otherwise({
                    redirectTo: 'user'
                });
    }]);

