'user strict';
app.config(['$routeProvider', function ($routeProvider) {
        $routeProvider
                .when('/', {
                    templateUrl: 'template/home.html',
                    controller: 'HomeCtrl'
                })
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
                    templateUrl: 'template/product/product-view.html',
                    controller: 'UploadCtrl'
                })
                 .when('/product/add', {
                    title: "Add your product",
                    templateUrl: 'template/product/product-post.html',
                    controller: 'ProductCtrl'
                })
                .when('/category/:cat_name/sub/:sub_name', {
                    title: "Product Listing",
                    templateUrl: 'template/product/product-list.html',
                    controller: 'CategoryCtrl'
                })
                .when('/rating', {
                    title: "Product Listing",
                    templateUrl: 'template/product/rating.html',
                    controller: 'RatingDemoCtrl'
                })
                .when('/wishlist', {
                    title: "Wishlist",
                    templateUrl: 'template/product/product-wishlist.html',
                    controller: 'WishlistCtrl'
                })
                .when('/cart', {
                    title: "Cart",
                    templateUrl: 'template/product/product-cart.html',
                    controller: 'CartCtrl'
                })
                .when('/profile/my-selling-product', {
                    title: "My Products",
                    templateUrl: 'template/my-product-list.html',
                    controller: 'ProfileCtrl'
                })
                .otherwise({
                    redirectTo: 'user'
                });
    }]);

