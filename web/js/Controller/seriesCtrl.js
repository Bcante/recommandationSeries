var app = angular.module('routeAppControllers');

app.controller('seriesCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceConnection','serviceSerie',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceConnection, serviceSerie) {

    // recover idSerie from cookie
    $scope.idSerie = localStorage.getItem('idSerie');

    /**
     * ajax to recover serie info
     */
    $http({
        method: 'GET',
        url: 'series/' + $scope.idSerie
    }).success(function (data, status, headers, config) {
        data = data[0];

        $scope.serieName = data.name;
        $scope.poster = data.poster_path;
        $scope.numberOfEpisodes = data.number_of_episodes;
        $scope.numberOfSeasons = data.number_of_seasons;
        $scope.overview = data.overview;
        $scope.popularity = data.popularity;
    });

    /**
     * ajax to recover serie creator
     */
    $http({
        method: 'GET',
        url : 'series/creator/'+$scope.idSerie
    })
    .success(function (data, status, headers, config) {
        $scope.creatorName = data[0].name;
    });

    /**
     * ajax to recover season
     */
    $http({
        method: 'GET',
        url : 'series/seasons/'+$scope.idSerie
    })
    .success(function (data, status, headers, config) {
        $scope.seasonsArray = data;
    });


    /**
     * Viewing episodes from a sesaon
     * @param seasonId id of the selected season
     */
    $scope.displayEpisodes = function (seasonId) {
        $http({
            method: 'GET',
            url: 'series/episodes/'+seasonId
        })
        .success(function (data, status, headers, config) {
            $scope.episodesArray = data;
        });
    };

    /**
     * Viewing actors from an episode
     * @param episodeId id of the selected episode
     */
    $scope.displayActors = function (episodeId) {
        $http({
            method : 'GET',
            url: 'series/actors/'+episodeId
        })
        .success(function (data, status, headers, config) {
            console.log(data);
        });
    };

    $scope.connected = serviceConnection.getConnectionStatus();
}]);