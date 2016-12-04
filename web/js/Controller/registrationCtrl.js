var app = angular.module('routeAppControllers');

app.controller('registrationCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval) {

    $scope.registration = {
        username : "",
        email : "",
        password : "",
        confirm_password : ""
    };

    $scope.toRegistrate = function() {
        /*console.log($scope.registration.username);
        console.log($scope.registration.password);
        console.log($scope.registration.confirm_password);
        console.log($scope.registration.email);*/
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

app.directive('equalsTo', [function () {
    /*
     * <input ng-minlength="8" ng-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/" ng-model="password" name="password" type="password" required>
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