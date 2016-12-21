var app = angular.module('routeAppControllers',[]);
app.controller('indexCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceConnection','serviceSerie',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceConnection, serviceSerie) {

    serviceConnection.getConnectionStatus()
        .success(function (data) {
            $scope.connected = data == 1 ? true : false;
        });

    $scope.connect = false;
    $scope.toConnect = function () {
        $location.path('/connection');
    };

    $scope.home = false;
    $scope.toHome = function () {
        $location.path('/home');
    };

    $scope.toTrack = function () {
        $location.path('/myTracking');
    };

    $scope.goToProfil = function () {
        $location.path('/myProfil');
    };

    //
    $scope.inputSearchChange = function () {
        if($scope.inputSearch != "") {
            $http({
                method: 'GET',
                url: 'serie/serieSearch/' + $scope.inputSearch
            })
            .success(function (data, status, headers, config) {
                $scope.serieSearch = data;
                console.log(data);
            });
        }
    };

    $scope.disconnect = function () {
        serviceConnection.disconnect();
        location.reload();
        $location.path('/home');
    };

    $scope.displayASerie = function (serieId) {
        serviceSerie.loadSeriePage(serieId);
    };
    /**
     * most popular series
     */
    $http({
        method: 'GET',
        url : 'home/popularSeries'
    })
        .success(function(data, status, headers, config) {
            $scope.popularSeries = data;
        });

}]);

