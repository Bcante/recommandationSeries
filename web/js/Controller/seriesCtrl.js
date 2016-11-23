var app = angular.module('routeAppControllers');

app.controller('seriesCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval) {

    function display(serieId) {
        $http({
            method: 'GET',
            url: 'series/'+serieId
        })
        .success(function (data, status, headers, config) {
            console.log(data);
            $scope.serieName = data.name;
        })
    }

}]);