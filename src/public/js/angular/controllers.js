'user strict';

app.controller('authCtrl', function ($scope, $rootScope, $routeParams, $location, $http, authService) {
    if (authService.isLogged()) {
        $location.path('profile');
    }
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

app.controller('ProfileCtrl', ['$scope', '$location', 'authService', 'sessionService', 'Data', function ($scope, $location, authService, sessionService, Data) {
        if (authService.isLogged()) {
            Data.get('user/' + sessionService.get('user_id')).then(function (results) {
                if (results.response == "OK") {
                    $scope.profile = results;
                    console.log($scope.profile);
                } else {

                }
            });
        } else {
            $location.path('user');
        }


        $scope.logout = function () {
            authService.logout();
        };
        $scope.editProfile = function () {
            if (authService.isLogged()) {
                $location.path('user/edit');
            } else {
                $location.path('user');
            }
        };
        $scope.mySellingProduct = function(){
            if (authService.isLogged()) {
                //$location.path('profile/my-selling-product');
                Data.get('profile/my-selling-product/'+ sessionService.get('user_id')).then(function (results) {
                    $scope.products = results;
                    //console.log(results);
                });
            } else {
                $location.path('user');
            }
        }


    }]);

app.controller('ProfileEditCtrl', ['$scope', '$location', 'authService', 'sessionService', 'Data', function ($scope, $location, authService, sessionService, Data) {
        if (authService.isLogged()) {
            Data.get('user/' + sessionService.get('user_id') + '/edit').then(function (results) {
                if (results.response == "OK") {
//                    $scope.profile.country = "Afghanistan";
                    $scope.profile = results;
                    console.log($scope.profile);
                } else {

                }
            });
        } else {
            $location.path('user');
        }

        $scope.countryChanged = function () {
            $scope.cityItems = $scope.profile.country.cities;
        }
        $scope.update = function (user) {
            if (authService.isLogged()) {
                Data.put('user/' + sessionService.get('user_id'), user).then(function (results) {
                    if (results.response == "OK") {
                        $location.path('profile');
                    }
                });
            } else {
                $location.path('user');
            }
        };


    }]);

app.controller('verifyCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data) {

    Data.get('auth/' + $routeParams.token + '/verify/' + $routeParams.id).then(function (results) {
        $scope.message = results.message;
    });


});

app.controller('ConfirmCtrl', function ($scope, $rootScope, $routeParams, $location, $http, sessionService) {
    if (sessionService.get('message')) {
        $scope.message = sessionService.get('message');
    }

});
app.controller('CategoryCtrl', ['$scope', '$rootScope', '$routeParams', '$http', 'Data', function ($scope, $rootScope, $routeParams, $http, Data) {
        Data.get('products/category/' + $routeParams.cat_name + '/sub/' + $routeParams.sub_name).then(function (results) {
            $scope.products = results;
            console.log($scope.products);

        });

    }]);

app.controller('RatingDemoCtrl', ['$scope', function ($scope) {
        $scope.rate = 3;
        $scope.max = 5;
        $scope.isReadonly = false;

        $scope.hoveringOver = function (value) {
            $scope.overStar = value;
            $scope.percent = 100 * (value / $scope.max);
        };

        $scope.ratingStates = [
            {stateOn: 'glyphicon-ok-sign', stateOff: 'glyphicon-ok-circle'},
            {stateOn: 'glyphicon-star', stateOff: 'glyphicon-star-empty'},
            {stateOn: 'glyphicon-heart', stateOff: 'glyphicon-ban-circle'},
            {stateOn: 'glyphicon-heart'},
            {stateOff: 'glyphicon-off'}
        ];

    }]);
//Image uplaod controller
app.controller('UploadCtrl', ['$scope', 'FileUploader', function ($scope, FileUploader) {
        var uploader = $scope.uploader = new FileUploader({
            url: 'api/v1/product/upload'
        });

        // FILTERS

        uploader.filters.push({
            name: 'customFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                return this.queue.length < 10;
            }
        });

        // CALLBACKS

        uploader.onWhenAddingFileFailed = function (item /*{File|FileLikeObject}*/, filter, options) {
            console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploader.onAfterAddingFile = function (fileItem) {
            console.info('onAfterAddingFile', fileItem);
        };
        uploader.onAfterAddingAll = function (addedFileItems) {
            console.info('onAfterAddingAll', addedFileItems);
        };
        uploader.onBeforeUploadItem = function (item) {
            console.info('onBeforeUploadItem', item);
        };
        uploader.onProgressItem = function (fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
        };
        uploader.onProgressAll = function (progress) {
            console.info('onProgressAll', progress);
        };
        uploader.onSuccessItem = function (fileItem, response, status, headers) {
            console.info('onSuccessItem', fileItem, response, status, headers);
        };
        uploader.onErrorItem = function (fileItem, response, status, headers) {
            console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader.onCancelItem = function (fileItem, response, status, headers) {
            console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploader.onCompleteItem = function (fileItem, response, status, headers) {
            console.info('onCompleteItem', fileItem, response, status, headers);
        };
        uploader.onCompleteAll = function () {
            console.info('onCompleteAll');
        };

        console.info('uploader', uploader);

    }]);
app.controller('CategoryShowCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data) {
    Data.get('category').then(function (results) {
        $scope.categories = results;
    });

});
app.controller('BrandsCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data) {
    Data.get('brand').then(function (results) {
        $scope.brands = results;
    });

});
app.controller('CartCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data) {
    Data.get('cart').then(function (results) {
        $scope.products = results.products;
        console.log(results);
    });

});

app.controller('WishlistCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data) {
    Data.get('wishlist').then(function (results) {
        $scope.products = results.products;
        console.log(results);
    });
    $scope.addToCart = function (item) {
        console.log(item.id.$id);
        var id = {'_id': item.id.$id};
        Data.post('cart', id).then(function (results) {
//            $scope.products = results;
            console.log(results);
        });
    }

});
app.controller('HomeCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data) {
    Data.get('featured-product').then(function (results) {
        $scope.products = results;
//        console.log(results);
    });

    $scope.addToWishList = function (item) {
        var id = {'_id': item._id.$id};
        Data.post('add-to-wishlist', id).then(function (results) {
//            $scope.products = results;
            console.log(results);
        });
    }
    $scope.viewDetails = function (item) {

        Data.post('add-to-wishlist', id).then(function (results) {
//            $scope.products = results;
            console.log(results);
        });
    }

});

app.controller('ProductCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data, FileUploader, authService,sessionService) {
    if (authService.isLogged()) {
        $scope.user_status = true;
    } else {
        $scope.user_status = false;
    }
    Data.get('category').then(function (results) {
        $scope.categories = results;
        console.log(results);
    });
    $scope.categoryChanged = function () {
        Data.get('brand/' + $scope.product.category._id.$id).then(function (results) {
            $scope.brands = results;
        });
        $scope.subCategory = $scope.product.category.child;
    }
    $scope.save = function (user) {      
        var data = {
            'title': user.title,
            'category': user.category.code,
            'sub_category': user.sub.code,
            'brand': user.brand.name,
            'model': user.model,
            'price': user.price,
            'year': user.year,
            'milage': user.milage,
            'seller_id': sessionService.get('user_id')
        };
        
        Data.post('product',data).then(function (results) {
//            $scope.products = results;
            console.log(results);
        });
    }
    var uploader = $scope.uploader = new FileUploader({
        url: 'api/v1/product/upload'
    });

    // FILTERS

    uploader.filters.push({
        name: 'customFilter',
        fn: function (item /*{File|FileLikeObject}*/, options) {
            return this.queue.length < 10;
        }
    });

    // CALLBACKS

    uploader.onWhenAddingFileFailed = function (item /*{File|FileLikeObject}*/, filter, options) {
        console.info('onWhenAddingFileFailed', item, filter, options);
    };
    uploader.onAfterAddingFile = function (fileItem) {
        console.info('onAfterAddingFile', fileItem);
    };
    uploader.onAfterAddingAll = function (addedFileItems) {
        console.info('onAfterAddingAll', addedFileItems);
    };
    uploader.onBeforeUploadItem = function (item) {
        console.info('onBeforeUploadItem', item);
    };
    uploader.onProgressItem = function (fileItem, progress) {
        console.info('onProgressItem', fileItem, progress);
    };
    uploader.onProgressAll = function (progress) {
        console.info('onProgressAll', progress);
    };
    uploader.onSuccessItem = function (fileItem, response, status, headers) {
        console.info('onSuccessItem', fileItem, response, status, headers);
    };
    uploader.onErrorItem = function (fileItem, response, status, headers) {
        console.info('onErrorItem', fileItem, response, status, headers);
    };
    uploader.onCancelItem = function (fileItem, response, status, headers) {
        console.info('onCancelItem', fileItem, response, status, headers);
    };
    uploader.onCompleteItem = function (fileItem, response, status, headers) {
        console.info('onCompleteItem', fileItem, response, status, headers);
    };
    uploader.onCompleteAll = function () {
        console.info('onCompleteAll');
    };

    console.info('uploader', uploader);


});