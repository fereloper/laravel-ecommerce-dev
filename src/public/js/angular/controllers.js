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
        $scope.update = function (user) {
            if (authService.isLogged()) {
                Data.put('user/' + sessionService.get('user_id'), user).then(function (results) {
                    console.log(results);
                    if (results.response == "OK") {
                        $location.path('profile');
                    }
                });
            } else {
                $location.path('user');
            }
        }
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
app.controller('UploadCtrl', ['$scope', '$upload', function ($scope, $upload) {
        $scope.$watch('file', function () {
            $scope.upload = $upload.upload({
                url: 'api/v1/product/upload',
                data: {myObj: $scope.myModelObj},
                file: $scope.files
            }).progress(function (evt) {
                console.log('progress: ' + parseInt(100.0 * evt.loaded / evt.total) + '% file :' + evt.config.file.name);
            }).success(function (data, status, headers, config) {
                console.log('file ' + config.file.name + 'is uploaded successfully. Response: ' + data);
            });
        });

    }]);
 