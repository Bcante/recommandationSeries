var app = angular.module('routeAppControllers');
app.controller('connexionCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval) {
	$scope.toConnect = function() {
        $http({
            method: 'POST',
            data: {
                password: $scope.password,
                email : $scope.email
            },
            url: 'connexion'
        })
        .success(function (data, status, headers, config) {
            if(data == false) {
                $scope.connexionError = "Invalid email / password"
            }
            else {
                localStorage.setItem('connected', true);
                $location.path('/home');
            }
        });
    }
}]);