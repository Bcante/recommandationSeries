var app = angular.module('routeAppControllers');

app.controller('trackCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceConnection',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceConnection) {

    serviceConnection.getConnectionStatus()
        .success(function (data) {
            $scope.connected = data == 1 ? true : false;
        });

    if(serviceConnection.getConnectionStatus()) {

    }

    $scope.connect = function() {
        serviceConnection.redirectionConnectionPage();
    }
}]);