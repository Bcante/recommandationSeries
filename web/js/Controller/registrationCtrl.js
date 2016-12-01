var app = angular.module('routeAppControllers');
app.controller('registrationCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval) {

    $scope.toRegistrate = function() {
        $http({
            method: 'POST',
            data: {
                username: $scope.username,
                password: $scope.password,
                password_confirm : $scope.confirm_password,
                email : $scope.email
            },
            url: 'registration'
        })
        .success(function (data, status, headers, config) {
            console.log(data);
        })
    }
}]);