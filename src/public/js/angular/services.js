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
                Data.post('user/login', {
                    user: user
                }).then(function (results) {
                    if (results.response == "OK") {
                        sessionService.set('user', 1);
                        $location.path('/home');
                    } else {
                        $location.path('/user');
                    }
                });
            },
            signup: function (user) {
                Data.post('signUp', {
                    user: user
                }).then(function (results) {
                    if (results.status == "success") {
                        $location.path('dashboard');
                    }
                });

            },
            logout: function () {
                //        Data.get('logout').then(function (results) {
                sessionService.destroy('user');
                $location.path('user');
                //        });
            },
            isLogged: function () {
               if(sessionService.get('user'))
                   return true;
               else
                   return false;
            }
        }
    }]);
