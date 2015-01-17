//angular.module('ecommerceApp.controllers', []).controller('RegistrationCtrl',function($scope, User){
//  $scope.user = new User();  //Create New user
// 
//  
//});

angular.module('ecommerceApp.controllers',[]).controller('UsersCtrl', function($scope){
  $scope.users.name = ['feroj','anup'];
  $scope.users.email = ['feroj','anup'];
});
