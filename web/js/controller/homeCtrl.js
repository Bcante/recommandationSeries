var app = angular.module('routeAppControllers');

app.controller('homeCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceSerie', 'serviceConnection',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceSerie, serviceConnection) {

    serviceConnection.getConnectionStatus()
    .success(function (data) {
        $scope.connected = data == 1 ? true : false;
    });



    /**
     * ajax to recover genres
     */
    $http({
        method: 'GET',
        url : 'home/genres'
    })
    .success(function(data, status, headers, config) {
        $scope.genresArray = data;
    });

    /**
     * ajax to recover all series
     */
    $http({
        method: 'GET',
        url: 'home/allSeries'
    })
    .success(function(data, status, headers, config) {
        $scope.totalDisplayed = 20;
        $scope.allSeries = data;
    });

    /**
     * ajax to recover all series from a genre
     */
    $scope.displaySeriesByGenre = function (genreId) {
        $http({
            method: 'GET',
            url: 'home/seriesByGenre/'+genreId
        })
        .success(function(data, status, headers, config) {
            $scope.totalDisplayed = 20;
            $scope.seriesByGenre = data;
        });
    };

    /** using serviceSerie to display serie page
     * @param serieId id of the selected serie
     */
    $scope.displayASerie = function (serieId) {
        serviceSerie.loadSeriePage(serieId);
    };

    /**
     * function to display series by block of 20
     */
    $scope.loadMore = function () {
        $scope.totalDisplayed += 20;
    };

}]);