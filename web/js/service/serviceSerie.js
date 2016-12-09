var app = angular.module('routeAppControllers');

app.service("serviceSerie",['$http','$location','serviceConnection', function ($http,$location,serviceConnection) {

    return {
        loadSeriePage : function (serieId) {
            localStorage.setItem('idSerie',serieId);
            $location.path('/series');
        },

        followASerie : function(serieId) {
            serviceConnection.getUserId()
            .success(function(data) {
                $http({
                    method : 'PUT',
                    data : {
                        serieId : serieId,
                        userId : data
                    },
                    url : 'followASerie/'
                })
                .success(function(data, status, headers, config) {
                    console.log('ok');
                });
            });
        },

        unfollowASerie : function(serieId) {
            var tmp = serviceConnection.getUserId();
            tmp.success(function(data) {
                $http({
                    method : 'PUT',
                    data : {
                        serieId : serieId,
                        userId : data
                    },
                    url : 'unfollowASerie/'
                })
                .success(function(data, status, headers, config) {
                    console.log(data);
                });
            });
        },

        checkIfFollow : function(serieId) {
            var tmp = serviceConnection.getUserId();
            return tmp.success(function(data) {
                $http({
                    method : 'GET',
                    data : {
                        serieId : serieId,
                        userId : data
                    },
                    url : 'checkIfFollow/'
                })
            });
        }

    }

}]);