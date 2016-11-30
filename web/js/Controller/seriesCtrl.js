var app = angular.module('routeAppControllers');

app.controller('seriesCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceAjax',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceAjax) {


        serviceAjax.display.success(function (data, status, headers, config) {
            console.log(data);
            $scope.serieName = data.name;
        });

}]);