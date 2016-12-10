var app = angular.module('routeAppControllers');
app.controller('connexionCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceConnection',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceConnection) {

    $scope.connection = {
        email : "",
        password : ""
    };

    serviceConnection.getConnectionStatus()
        .success(function (data) {
            $scope.connected = data == 1 ? true : false;
        });

    // function to connect a user
    $scope.toConnect = function() {
        // ajax with datas send in server
        $http({
            method: 'POST',
            data: {
                password: $scope.connection.password,
                email : $scope.connection.email
            },
            url: 'connexion'
        })
        .success(function (data, status, headers, config) {
            if(data != 1) {
                $scope.connectionError = "Invalid email / password"
            }
            else {
                location.reload();
                $location.path('/home');
            }
        });
    }
}]);