var app = angular.module('routeAppControllers');

app.controller('seriesCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceAjax',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceAjax) {

    $scope.idSerie = localStorage.getItem('idSerie');

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

        $http({
            method: 'GET',
            url : 'series/creator/'+$scope.idSerie
        })
        .success(function (data, status, headers, config) {
            $scope.creatorName = data[0].name;

            $http({
                method: 'GET',
                url : 'series/seasons/'+$scope.idSerie
            })
            .success(function (data, status, headers, config) {
                $scope.seasonsArray = data;
            });
        });
    });

    $scope.displayEpisodes = function (seasonId) {
        console.log(seasonId);
        $http({
            method: 'GET',
            url: 'series/seasons/id/'+seasonId
        }).success(function (data, status, headers, config) {
            console.log(data);
            $scope.episodesArray = data;
        });
    }

}]);