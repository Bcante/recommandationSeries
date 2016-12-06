var app = angular.module('routeAppControllers');

app.service("serviceSerie",['$http','$location', function ($http,$location) {

    return {
        loadSeriePage : function (serieId) {
            localStorage.setItem('idSerie',serieId);
            $location.path('/series');
        }
    }

}]);