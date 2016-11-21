var app = angular.module('routeAppControllers');

app.controller('homeCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval) {

    $http({
        method: 'GET',
        url : 'home/genres'
    })
    .success(function(data, status, headers, config) {
        $scope.arrayGenres = data;

        /*$http({
            method: 'GET',
            url: 'home/informationsSeries'
        })
        .success(function(data, status, headers, config) {
            console.log(data);
        })*/
    });

}]);