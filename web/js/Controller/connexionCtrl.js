var app = angular.module('routeAppControllers');
app.controller('connexionCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval) {
	$scope.toConnexion = function() {
        $http({
            method: 'POST',
            data: {
                password: $scope.password,
                email : $scope.email
            },
            url: 'connexion'
        })
        .success(function (data, status, headers, config) {
            console.log(data);
        })
    }
}]);