var app = angular.module('routeAppControllers');

app.controller('seriesCtrl',['$scope','$mdToast','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceConnection','serviceSerie','$mdDialog', function ($scope,$mdToast,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceConnection, serviceSerie,$mdDialog) {

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
     * ajax to get all series from a creator
     */
    $http({
        method:'GET',
        url : 'serie/creator/series/'+$scope.idSerie,
        data : {
            name : $scope.creatorName
        }
    }).success(function (data) {
        console.log(data);
        $scope.creatorArray = data;
    });

    /*$scope.anotherSeries = function () {
        $mdDialog.show({
            locals : {dataToPass : $scope},
            controller: CarouselController,
            templateUrl: 'web/html/templates/carouselMain.html',
            parent: angular.element(document.body),
            clickOutsideToClose: true
        })
            .then(function() {
                $location.path('/connection')
            });
    };

    function CarouselController ($scope, $mdDialog, dataToPass) {
        $scope.authorArray = dataToPass.authorArray;

    };*/

    $scope.goToSerie=function(serieId){
        console.log("hello");
        serviceSerie.loadSeriePage(serieId);
        $mdDialog.cancel();
    }

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
        $scope.showSeasons = true;
        $http({
            method: 'GET',
            url: 'serie/seasons/details/'+seasonId
        })
        .success(function (data, status, headers, config) {
            $scope.showEpisode = false;

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
            });
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

            $scope.episodeName = data.name;
            $scope.episodeAirDate = data.air_date;
            $scope.episodeOverview = data.overview;
            $scope.episodePoster = data.still_path;
            $scope.episodeId = data.id;

            /*
            * Check if an episode has been see
             */
            $http({
                method: 'GET',
                url: 'episode/checkIfSaw/' + episodeId
            })
            .success(function (data) {
                $scope.episodeSeen = data == "true" ? true : false;
            });

            /*
            * Actors playing on this episode
             */
            $http({
                method : 'GET',
                url: 'serie/actors/'+data.id
            })
            .success(function (data, status, headers, config) {
                var name = "";
                data.forEach(function(actorName) {
                    name += actorName.name + ", "
                });
                $scope.episodeActors = name.substring(0, name.length-2);
            });
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

    /**
     * function to save an episode seen
     * @param episodeId, id episode
     */
    $scope.seeEpisode = function(episodeId) {
        $http({
            method : 'PUT',
            url : 'episode/seen/'+episodeId
        })
        .success(function (data, status, headers, config) {
            $scope.episodeSeen = true;
        });
    };

    /**
     * function to remove the entry on database
     * @param episodeId, id episode
     */
    $scope.unseenEpisode = function(episodeId) {
        $http({
            method : 'PUT',
            url : 'episode/unseen/'+episodeId
        })
        .success(function(data, status, headers, config) {
            $scope.episodeSeen = false;
        });
    }


}]);