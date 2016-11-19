/**
 * Created by benja on 11/11/2016.
 */
var app = angular.module('routeAppControllers',[]);
app.controller('indexCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval) {
    $scope.hello = "Hello World";

    $scope.connect = false;
    $scope.toConnect = function () {
        $location.path('/connexion');
    };

    $scope.registrate = false;
    $scope.toRegistrate = function () {
        $location.path('/registration');
    };
}]);
