var app = angular.module('routeAppControllers');

app.controller('registrationCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval) {

    $scope.toRegistrate = function() {
        $http({
            method: 'POST',
            data: {
                username: $scope.username,
                password: $scope.password,
                password_confirm : $scope.confirm_password,
                email : $scope.email
            },
            url: 'registration'
        })
        .success(function (data, status, headers, config) {
            console.log(data);
        })
    }
}]);

app.directive('equalsTo', [function () {
    /*
     * <input ng-minlength="6" ng-model="password" type="password" required />
     * <input ng-model="confirm_password" type="password" required>
     */
    return {
        restrict: 'A', // S'utilise uniquement en tant qu'attribut
        scope: true,
        require: 'ngModel',
        link: function (scope, elem, attrs, control) {
            var check = function () {
                var v1 = scope.$eval(attrs.ngModel); // attrs.ngModel = "ConfirmPassword"
                var v2 = scope.$eval(attrs.equalsTo).$viewValue; // attrs.equalsTo = "Password"
                return v1 == v2;
            };

            scope.$watch(check, function (isValid) {
                // Défini si le champ est valide
                control.$setValidity("equalsTo", isValid);
            });
        }
    };
}]);