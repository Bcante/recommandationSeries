var app = angular.module('routeAppControllers');

app.service("serviceConnection",['$http','$location', function ($http,$location) {

    return {
        /**
         * function which using cookie to display or not HTML elements
         */
        getConnectionStatus : function () {
            return $http({
                method : 'GET',
                url : 'user/connectionStatus'
            });
        },

        /**
         * function to redirect on connection page if user is not connected
         */
        redirectionConnectionPage : function () {
            $location.path('/connection');
        },

        /**
         * function to be disconnected
         */
        disconnect : function () {
            $http({
                method: 'GET',
                url : 'disconnect'
            });
        }
    }
}]);