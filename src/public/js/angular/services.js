'user strict';

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

app.factory('sessionService', ['$http', function ($http) {
        return {
            set: function (key, value) {
                return sessionStorage.setItem(key, value);
            },
            get: function (key) {
                return sessionStorage.getItem(key);
            },
            destroy: function (key) {
                return sessionStorage.removeItem(key);
            }
        }
    }]);
app.factory('authService', ['$http', '$location', 'sessionService', 'Data', function ($http, $location, sessionService, Data) {
        return{
            login: function (user) {
                Data.post('user/login', user).then(function (results) {
                    if (results.response == "OK") {
                        sessionService.set('user_id', results.message.id.$id);
                        $location.path('/profile');
                    } else {
                        sessionService.set('message', results.message);
                        $location.path('/user/confirmation');
                    }
                });
            },
            signup: function (user) {
                Data.post('user', user).then(function (results) {
                    sessionService.set('message', results.message);
                    $location.path('user/confirmation');

                });

            },
            logout: function () {
                Data.get('auth/logout').then(function (results) {
                    sessionService.destroy('user_id');
                    $location.path('user');
                });
            },
            isLogged: function () {
                if (sessionService.get('user_id'))
                    return true;
                else
                    return false;
            }
        }
    }]);
