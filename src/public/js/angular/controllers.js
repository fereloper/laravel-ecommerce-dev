'user strict';

app.controller('authCtrl', function($scope, $rootScope, $routeParams, $location, $http, authService) {
  //initially set those objects to null to avoid undefined error
  $scope.login = {};
  $scope.signup = {};
  $scope.doLogin = function(user) {
    authService.login(user);
  };
//    $scope.signup = {email: '', password: '', name: '', phone: '', address: ''};
  $scope.signUp = function(user) {
    authService.signup(user);
  };

});

app.controller('ProfileCtrl', ['$scope', '$location', 'authService', 'sessionService','Data', function($scope, $location, authService, sessionService,Data) {

    Data.get('user/' + sessionService.get('user_id')).then(function(results) {
      if (results.response == "OK") {
        $scope.profile = results;
      } else {
      }
    });
    

    $scope.logout = function() {
      authService.logout();
    }
  }]);
 