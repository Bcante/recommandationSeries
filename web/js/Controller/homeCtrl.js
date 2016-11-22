var app = angular.module('routeAppControllers');

app.controller('homeCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval) {


    $http({
        method: 'GET',
        url : 'home/genres'
    })
    .success(function(data, status, headers, config) {
        var array = [];
        for(var i=0 in data) {
            array.push(data[i].name);
        }

        $scope.arrayGenres = array.sort();
    });

    $scope.yolo = function () {
        console.log("yolo");
    }
}]);