var app = angular.module('routeAppControllers');

app.controller('seriesCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceConnection','serviceSerie',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceConnection, serviceSerie) {

    $scope.episodeSeen = 'false';
    serviceConnection.getConnectionStatus()
        .success(function (data) {
            $scope.connected = data == 1 ? true : false;
        });

    // recover idSerie from cookie
    $scope.idSerie = localStorage.getItem('idSerie');

    /**
     * ajax to recover serie info
     */
    $http({
        method: 'GET',
        url: 'serie/' + $scope.idSerie
    }).success(function (data, status, headers, config) {
        data = data[0];

        $scope.serieName = data.name;
        $scope.poster = data.poster_path;
        $scope.numberOfEpisodes = data.number_of_episodes;
        $scope.numberOfSeasons = data.number_of_seasons;
        $scope.overview = data.overview;
        $scope.popularity = data.popularity;
        $scope.serieId = data.id;

        $http({
            method: 'GET',
            url: 'serie/checkIfFollow/' + data.id
        })
        .success(function (data, status, headers, config) {
            console.log(data);
            $scope.followOrNot = data;
        });
    });

    /**
     * ajax to recover serie creator
     */
    $http({
        method: 'GET',
        url : 'serie/creator/'+$scope.idSerie
    })
    .success(function (data, status, headers, config) {
        $scope.creatorName = data.name;
    });

    /**
     * ajax to recover season
     */
    $http({
        method: 'GET',
        url : 'serie/seasons/'+$scope.idSerie
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
            url: 'serie/episodes/'+seasonId
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
            url: 'serie/actors/'+episodeId
        })
        .success(function (data, status, headers, config) {
            console.log(data);
        });
    };

    /**
     * function to follow a serie (using serviceSerie)
     * @param serieId, serie to follow
     */
    $scope.followASerie = function(serieId) {
        $http({
            method : 'PUT',
            url : 'serie/followASerie/'+serieId
        })
        .success(function (data, status, headers, config) {
            location.reload();
        });
     };

    /**
     * function to unfollow a serie (using serviceSerie)
     * @param serieId, serie to unfollow
     */
    $scope.unfollowASerie = function(serieId) {
        $http({
            method : 'DELETE',
            url : 'serie/unfollowASerie/'+serieId
        })
        .success(function (data, status, headers, config) {
            location.reload();
        });
    };

    $scope.seeEpisode = function(episodeId) {
        $scope.episodeSeen = 'true';
    }
}]);