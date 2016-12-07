var app = angular.module('routeAppControllers');

app.controller('trackCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceConnection',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceConnection) {

    $scope.connected = serviceConnection.getConnectionStatus();

    if(serviceConnection.getConnectionStatus()) {

    }

    $scope.connect = function() {
        serviceConnection.redirectionConnectionPage();
        // $location.path('/connexion');
    }
}]);