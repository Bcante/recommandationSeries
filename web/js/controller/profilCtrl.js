var app = angular.module('routeAppControllers');

app.controller('profilCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceConnection',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceConnection) {

    $scope.getUser = function () {
        $http({
            method: 'GET',
            url : 'user'
        }).success(function (data) {
            $scope.email=data.email;
            $scope.username=data.name;
        })

    };

    serviceConnection.getConnectionStatus()
        .success(function (data) {
            $scope.connected = data == 1 ? true : false;
        });

    if(serviceConnection.getConnectionStatus()) {
        $scope.getUser();
    }



    $scope.connect = function() {
        serviceConnection.redirectionConnectionPage();
    }
}]);