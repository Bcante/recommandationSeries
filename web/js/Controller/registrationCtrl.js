var app = angular.module('routeAppControllers');

app.controller('registrationCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval) {

    $scope.toRegistrate = function() {
        // console.log($scope.registrationForm.confirm_password);
        $http({
            method: 'POST',
            data: {
                username: username,
                password: password,
                password_confirm : confirm_password,
                email : email
            },
            url: 'registration'
        })
        .success(function (data, status, headers, config) {
            console.log(data);
        });
    }
}]);

app.directive('equalsTo', [function () {
    /*
     * <input ng-minlength="6" ng-model="password" name="password" type="password" required>
     * <input ng-model="confirm_password" type="password" name="confirm_password" required equals-to="registrationForm.password">
     */
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