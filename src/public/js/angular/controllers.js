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


    }]);

app.controller('ProfileEditCtrl', ['$scope', '$location', 'authService', 'sessionService', 'Data', function ($scope, $location, authService, sessionService, Data) {
        if (authService.isLogged()) {
            Data.get('user/' + sessionService.get('user_id') + '/edit').then(function (results) {
                if (results.response == "OK") {
                    $scope.profile.country = 4;
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
 