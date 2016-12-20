var app = angular.module('routeAppControllers');

app.controller('profilCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceConnection',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceConnection) {

    $scope.getUser = function () {
        $http({
            method: 'GET',
            url : 'user'
        }).success(function (data) {
            $scope.email=data.email;
            $scope.username=data.name;
        })

    };

    serviceConnection.getConnectionStatus()
        .success(function (data) {
            $scope.connected = data == 1 ? true : false;
        });

    $scope.toModify = function() {
        $http({
            method : 'POST',
            data : {
                password : $scope.modification.password
            },
            url : 'user/changePassoword'
        })
        .success(function (data, status, headers, config) {
            $scope.successMessages = "Password has been changed";
        });
    };

    if(serviceConnection.getConnectionStatus()) {
        $scope.getUser();
    }

    $scope.connect = function() {
        serviceConnection.redirectionConnectionPage();
    }
}]);

/**
 * directive for inscription form
 * check if password and confirm_password are equals
 */
app.directive('equalsTo', [function () {
    return {
        restrict: 'A',
        scope: true,
        require: 'ngModel',
        link: function (scope, elem, attrs, control) {
            var check = function () {
                var v1 = scope.$eval(attrs.ngModel); // attrs.ngModel = "confirm_password"
                var v2 = scope.$eval(attrs.equalsTo).$viewValue; // attrs.equalsTo = "password"
                return v1 == v2;
            };

            scope.$watch(check, function (isValid) {
                // Define if field is valid
                control.$setValidity("equalsTo", isValid);
            });
        }
    };
}]);