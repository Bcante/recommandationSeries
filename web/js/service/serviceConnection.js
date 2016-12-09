var app = angular.module('routeAppControllers');

app.service("serviceConnection",['$http','$location', function ($http,$location) {

    return {
        /**
         * function which using cookie to display or not HTML elements
         */
        getConnectionStatus : function () {
            var boolean = null;
            if (localStorage.getItem('connected') == null) {
                boolean = false;
                localStorage.setItem('connected', false);
                console.log('not exists ' + localStorage.getItem('connected'));
            }
            else if (localStorage.getItem('connected') == 'false') {
                boolean = false;
                console.log('not connected ' + localStorage.getItem('connected'));
            }
            else if (localStorage.getItem('connected') == 'true') {
                boolean = true;
                console.log('connected ' + localStorage.getItem('connected'));
            }
            return boolean;

            return $http({
                method : 'GET',
                url : '/user/connectionStatus'
            })
            .success(function (data) {
                return data;
            })
        },

        redirectionConnectionPage : function () {
            $location.path('/connexion');
        },

        getUserId : function () {
            return $http({
                method : 'GET',
                url : 'user/id/'
            });
        }
    }
}]);