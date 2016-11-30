var app = angular.module('routeAppControllers');

app.controller('homeCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceAjax',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceAjax) {

    $http({
        method: 'GET',
        url : 'home/genres'
    })
    .success(function(data, status, headers, config) {
        $scope.genresArray = data;

        $http({
            method: 'GET',
            url: 'home/allSeries'
        })
        .success(function(data, status, headers, config) {
            $scope.allSeries = data;
        });
    });

    $scope.displaySeriesByGenre = function (genreId) {
        $http({
            method: 'GET',
            url: 'home/infoSeriesByGenre/'+genreId
        })
        .success(function(data, status, headers, config) {
            $scope.infoSeriesGenres = data;
        });
    };

    $scope.displayASerie = function (serieId) {
        localStorage.setItem('idSerie',serieId);
        $location.path('/series');
    }

}]);