var app = angular.module('routeAppControllers');
app.controller('connexionCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval) {

    $scope.connection = {
        email : "",
        password : ""
    };

    $scope.toConnect = function() {
        $http({
            method: 'POST',
            data: {
                password: $scope.connection.password,
                email : $scope.connection.email
            },
            url: 'connexion'
        })
        .success(function (data, status, headers, config) {
            if(data == false) {
                $scope.connectionError = "Invalid email / password"
            }
            else {
                localStorage.setItem('connected', true);
                $location.path('/home');
            }
        });
    }
}]);