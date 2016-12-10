var app = angular.module('routeAppControllers');

app.controller('registrationCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceConnection',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval, serviceConnection) {

    serviceConnection.getConnectionStatus()
        .success(function (data) {
            $scope.connected = data == 1 ? true : false;
        });

    /**
     * for ng-model
     * @type {{username: string, email: string, password: string, confirm_password: string}}
     */
    $scope.registration = {
        username : "",
        email : "",
        password : "",
        confirm_password : ""
    };

    /**
     * function with register datas
     */
    $scope.toRegistrate = function() {
        // ajax with datas send in server
        $http({
            method: 'POST',
            data: {
                username: $scope.registration.username,
                password: $scope.registration.password,
                password_confirm : $scope.registration.confirm_password,
                email : $scope.registration.email
            },
            url: 'registration'
        })
        .success(function (data, status, headers, config) {
            console.log(data);
        });
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