var app = angular.module('routeAppControllers');

app.controller('homeCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceAjax',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceAjax) {

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
            $scope.infoSeriesGenres = data;
        });
    };

    /** using cookie with serieId
     * @param serieId id of the selected serie
     */
    $scope.displayASerie = function (serieId) {
        localStorage.setItem('idSerie',serieId);
        $location.path('/series');
    };

    if(localStorage.getItem('connected')) {
        console.log(localStorage.getItem('connected'));
        $scope.connected = true;
    }

}]);