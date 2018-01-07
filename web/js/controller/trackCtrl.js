var app = angular.module('routeAppControllers');

app.controller('trackCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceConnection', 'serviceSerie',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceConnection,serviceSerie) {

    serviceConnection.getConnectionStatus()
        .success(function (data) {
            $scope.connected = data == 1 ? true : false;
            if(!$scope.connected){
                $location.path('/home');
            }
        });

    $http({
        method: 'GET',
        url : 'user/seriesFollowed'
    })
    .success(function(data, status, headers, config) {
        $scope.seriesFollowed = data;
    });

    $scope.displayASerie = function (serieId) {
        serviceSerie.loadSeriePage(serieId);
    };

    $scope.connect = function() {
        serviceConnection.redirectionConnectionPage();
    }
}]);