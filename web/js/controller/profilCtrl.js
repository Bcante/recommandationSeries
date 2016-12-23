var app = angular.module('routeAppControllers');

app.controller('profilCtrl',['$templateCache','$scope','$location','$http','$rootScope','$window','$mdSidenav','$mdDialog','$route','$interval','serviceConnection',function ($templateCache, $scope,$location,$http,$rootScope,$window,$mdSidenav,$mdDialog,$route,$interval,serviceConnection) {

    /**
     * saving the template for the dialog box to change the password
     */
    app.run(function ($templateCache) {
        $templateCache.put('../../html/templates/dialogChangePassword.tmpl.html');
    });

    /**
     * function to get the user connected
     */
    $scope.getUser = function () {
        $http({
            method: 'GET',
            url: 'user'
        }).success(function (data) {
            $scope.email = data.email;
            $scope.username = data.name;
        })
    };

    /**
     * function to get the connection status
     * using serviceConnection
     */
    if (serviceConnection.getConnectionStatus()) {
        $scope.getUser();
    }


    /**
     * function to check if the current password is good
     * @param currentPassword, current password
     */
    var checkCurrentPassword = function (currentPassword) {
        return $http({
            method: 'POST',
            data: {
                password: currentPassword
            },
            url: 'user/currentPassword'
        });
    };

    /**
     * function to change the password in database
     * @param newPassword, new password
     */
    var changePassword = function (newPassword) {
        console.log("new pass is: "+newPassword);
        // undefined
        return $http({
            method: 'POST',
            data: {
                password: newPassword
            },
            url: 'user/changePassword'
        })
    };

    /*
     *
     ********* DIALOG *********
     *
     */
    /**
     * function to change the password
     * @param ev, event
     */
    $scope.changePassword = function (ev) {
        $mdDialog.show({
                controller: DialogController,
                templateUrl: 'web/html/templates/dialogChangePassword.tmpl.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose: false
            })
            .then(function() {
            });
    };

    /**
     * Controller use for the dialog box
     * @param $scope, scope
     * @param $mdDialog, md-dialog
     * @constructor
     */
    function DialogController($scope, $mdDialog) {
        $scope.cancel = function() {
            $mdDialog.cancel();
        };

        $scope.answer = function(currentPassword, newPassword, newPasswordConfirm) {
            $mdDialog.hide();
            changePasswordSubmit(currentPassword, newPassword, newPasswordConfirm);
        };
    }

    $scope.successMessage = false;
    $scope.wrongPassword = false;
    var changePasswordSubmit = function(currentPassword, newPassword, newPasswordConfirm) {
        checkCurrentPassword(currentPassword)
            .success(function (data, status, headers, config) {
                if (data == "true") {
                    changePassword(newPassword)
                        .success(function (data, status, headers, config) {
                            $scope.wrongPassword = false;
                            $scope.successMessage = true;
                        });
                }
                else {
                    $scope.successMessage = false;
                    $scope.wrongPassword = true;
                }
            })
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
                if(scope.$eval(attrs.equalsTo) != null) {
                    var v1 = scope.$eval(attrs.ngModel); // attrs.ngModel = "confirm_password"
                    var v2 = scope.$eval(attrs.equalsTo).$viewValue; // attrs.equalsTo = "password"
                    return v1 == v2;
                }
            };

            scope.$watch(check, function (isValid) {
                // Define if field is valid
                control.$setValidity("equalsTo", isValid);
            });
        }
    };
}]);