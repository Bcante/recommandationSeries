var app = angular.module('routeAppControllers');

app.controller('seriesCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceAjax',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceAjax) {

    $scope.idSerie = localStorage.getItem('idSerie');

    $http({
        method: 'GET',
        url: 'series/' + $scope.idSerie
    }).success(function (data, status, headers, config) {
        $scope.serieName = data[0].name;
        console.log(data[0].name);
    });

}]);