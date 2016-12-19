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
        var errorsArray = []
            , username = $scope.modification.username
            , email = $scope.modification.email
            , password = $scope.modification.password
            , confirm_password = $scope.modification.confirm_password;

        if(username != null) {
            if(username.length < 4) { errorsArray.push("Username is too short (min 4 chars)"); }
        }
        if(email != null) {
            if(!email.test('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)')) {
                errorsArray.push("Email is not valid");
            }
        }
        if(password != null) {
            if(password.length < 8) { errorsArray.push("Password is too short (min 8 chars)"); }
            else if(!password.test("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/")) { errorsArray.push("Password doesn't match with the pattern"); }
            else if (password != confirm_password) { errorsArray.push("Passwords are differents"); }
        }

        if(errorsArray.length == 0) {
            $http({
                method : 'POST',
                data : {
                    username : username,
                    password : password,
                    email : email
                },
                url : 'user/modifiedProfil'
            })
            .success(function (data, status, headers, config) {
                serviceConnection.disconnect();
                serviceConnection.redirectionConnectionPage();
            });
        }
        else {
            var err = "";
            errorsArray.forEach(function(error) {
                console.log(error);
                err += error + " / ";
            });
            $scope.errorsModif = err.substring(0,err.length-3);
        }
    };

    if(serviceConnection.getConnectionStatus()) {
        $scope.getUser();
    }

    $scope.connect = function() {
        serviceConnection.redirectionConnectionPage();
    }
}]);