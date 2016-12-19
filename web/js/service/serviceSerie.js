var app = angular.module('routeAppControllers');

app.service("serviceSerie",['$http','$location','serviceConnection', function ($http,$location,serviceConnection) {

    return {
        loadSeriePage : function (serieId) {
            localStorage.setItem('idSerie',serieId);
            $location.path('/series');
        }

    }

}]);