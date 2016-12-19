var app = angular.module('routeAppControllers');

app.controller('seriesCtrl',['$scope','$mdToast','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceConnection','serviceSerie',function ($scope,$mdToast,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceConnection, serviceSerie) {

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

        if($scope.connected) {
            $http({
                method: 'GET',
                url: 'serie/checkIfFollow/' + data.id
            })
                .success(function (data, status, headers, config) {
                    $scope.followOrNot = data;
                });
        }
    });

    /**
     * ajax to recover serie creator
     */
    $http({
        method: 'GET',
        url : 'serie/creator/'+$scope.idSerie
    })
    .success(function (data, status, headers, config) {
        var creator = "";
        data.forEach(function(d) {
            creator += d.name + ", ";
        });
        $scope.creatorName = creator.substring(0,creator.length-2);
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
     * Function to display seasons details
     * @param seasonId, id season
     */
    $scope.displaySeasonsDetails = function (seasonId) {
        $http({
            method: 'GET',
            url: 'serie/seasons/details/'+seasonId
        })
        .success(function (data, status, headers, config) {
            data = data[0];
            $scope.seasonOverview = data.overview;
            $scope.seasonPoster = data.poster_path;
            $scope.seasonName = data.name;
            $scope.seasonAirDate = data.air_date;

            /**
             * Viewing episodes from a sesaon
             * @param seasonId id of the selected season
             */
            $http({
                method: 'GET',
                url: 'serie/episodes/'+seasonId
            })
            .success(function (data, status, headers, config) {
                $scope.episodes = data;
            })
        });
    };

    /**
     * function to display episodes details
     * @param episodeId, episode id
     */
    $scope.showEpisode = false;
    $scope.displayEpisode = function(episodeId) {
        $http({
            method: 'GET',
            url: 'episode/'+episodeId
        })
        .success(function (data, status, headers, config) {
            $scope.showEpisode = true;
            data = data[0];
            $scope.episodes = data;
        })
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

    /**
     * function which checked if an episode has benn see
     */
    if($scope.connected) {
        $scope.checkIfSaw = function (episodeId) {
            $http({
                method: 'GET',
                url: 'episode/checkIfSaw/' + episodeId
            })
                .success(function (data) {
                    var res;
                    if (data == "false") res = false;
                    else if (data == "true") res = true;
                    return res;
                });
        };
    }

    /**
     * function to save if a episode has been see
     * @param episodeId, id episode
     */
    $scope.seeEpisode = function(episodeId) {
        $http({
            method : 'PUT',
            url : 'episode/checkIfSaw/'+episodeId
        })
        .success(function (data, status, headers, config) {
            location.reload();
        });
    }

    /**
     *
     */
    $scope.episodeMoreInfo = function(episodeId) {
        $http({
            method: 'GET',
            url : 'episode/'+episodeId
        })
        .success(function (data) {
            $rootScope.episodeData = data;
            $rootScope.episodeTitle = data[0].name;

            $http({
                method : 'GET',
                url: 'serie/actors/'+episodeId
            })
            .success(function (data, status, headers, config) {
                var name = "";
                data.forEach(function(actorName) {
                    name += actorName.name + ", "
                });
                $rootScope.episodeActors = name.substring(0, name.length-2);
            });

            $mdToast.show({
                hideDelay: '5000',
                position: 'top right',
                controller: 'ToastCtrl',
                templateUrl: 'toast-template.html'
            });
        });
    }
}])

.controller('ToastCtrl', function($scope,$rootScope, $mdToast, $mdDialog) {

    var isDlgOpen;

    $scope.closeToast = function() {
        if (isDlgOpen) return;

        $mdToast
            .hide()
            .then(function() {
                isDlgOpen = false;
            });
    };

    $scope.openActors = function(e) {
        if ( isDlgOpen ) return;
        isDlgOpen = true;

        $mdDialog
            .show($mdDialog
                .alert()
                .title($rootScope.episodeTitle + 'Actors')
                .textContent($rootScope.episodeActors)
                .ok('Ok')
                .targetEvent(e)
            )
            .then(function() {
                isDlgOpen = false;
            })
    };

    $scope.openMoreInfo = function(e) {
        if ( isDlgOpen ) return;
        isDlgOpen = true;

        $mdDialog
            .show($mdDialog
                .alert()
                .title($rootScope.episodeTitle + ' : Synopsis')
                .textContent($rootScope.episodeData[0].overview)
                .ok('Ok')
                .targetEvent(e)
            )
            .then(function() {
                isDlgOpen = false;
            })
    };
});