var app = angular.module('routeAppControllers');

app.controller('homeCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval) {

    $http({
        method: 'GET',
        url : 'home/genres'
    })
    .success(function(data, status, headers, config) {
        $scope.genresArray = arraySortByName(data);

        $http({
            method: 'GET',
            url: 'home/allSeries'
        })
        .success(function(data, status, headers, config) {
            $scope.allSeries = data;
        });
    });

    $scope.displayInfoSerie = function (genre) {
        console.log(genre);
    };


    // homeController functions
    function arraySortByName(data) {
        var array = [];
        for(var i = 0 in data) {
            array.push(data[i].name);
        }
        return array.sort();
    }

}]);