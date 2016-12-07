var app = angular.module('routeAppControllers');
app.controller('connexionCtrl',['$scope','$location','$http','$rootScope','$window','$mdSidenav','$route','$interval','serviceConnection',function ($scope,$location,$http,$rootScope,$window,$mdSidenav,$route,$interval,serviceConnection) {

    $scope.connection = {
        email : "",
        password : ""
    };

    if(serviceConnection.getConnectionStatus()) {
        $scope.connected = true;
    }

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
            console.log(data);
            if(data == false) {
                $scope.connectionError = "Invalid email / password"
            }
            else {
                console.log('ok');
                localStorage.setItem('connected', true);
                location.reload();
                $location.path('/home');
            }
            /*localStorage.setItem('connected', true);
            location.reload();
            $location.path('/home');*/
        });
    }
}]);