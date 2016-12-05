var app = angular.module('routeAppControllers');

app.controller('homeCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceAjax',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceAjax) {

    /**
     * function to display series by block of 20
     */
    $scope.loadMore = function () {
        $scope.totalDisplayed += 20;
    };

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

    /**
     * function which using cookie to display or not HTML elements
     */
    if(localStorage.getItem('connected') == null) {
        $scope.connected = false;
        localStorage.setItem('connected', false);
        console.log('not exists '+ localStorage.getItem('connected'));
    }
    else if (localStorage.getItem('connected') == 'false') {
        $scope.connected = false;
        console.log('not connected ' + localStorage.getItem('connected'));
    }
    else if (localStorage.getItem('connected') == 'true') {
        $scope.connected = true;
        console.log('connected ' + localStorage.getItem('connected'));
    }
}]);