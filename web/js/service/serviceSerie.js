var app = angular.module('routeAppControllers');

app.service("serviceSerie",['$http','$location','serviceConnection', function ($http,$location,serviceConnection) {

    return {
        loadSeriePage : function (serieId) {
            localStorage.setItem('idSerie',serieId);
            $location.path('/series');
        },

        followASerie : function(serieId) {
            $http({
                method : 'PUT',
                url : 'serie/followASerie/'+serieId
            });
        },

        unfollowASerie : function(serieId) {
            $http({
                method : 'PUT',
                url : 'serie/unfollowASerie/'+serieId
            });
        },

        checkIfFollow : function(serieId) {
            $http({
                method : 'GET',
                url : 'serie/checkIfFollow/'+serieId
            })
        }

    }

}]);