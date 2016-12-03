/**
 * Created by benja on 30/11/2016.
 */

var app = angular.module('routeAppControllers');

app.service("serviceAjax",['$http','$location', function ($http,$location) {

    function displayASerie(serieId) {
        return $http({
            method: 'GET',
            url: 'series/' + serieId
        })
    }


}]);