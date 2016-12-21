var app = angular.module('routeAppControllers',[]);
app.controller('indexCtrl',['$scope','$location','$http','$mdDialog','$rootScope','$window','$mdSidenav','$route','$interval','serviceConnection','serviceSerie',function ($scope,$location,$http,$mdDialog,$rootScope,$window,$mdSidenav,$route,$interval,serviceConnection, serviceSerie) {

    serviceConnection.getConnectionStatus()
        .success(function (data) {
            $scope.connected = data == 1 ? true : false;

            // for sidebar
            if(data != 1) {
                /**
                 * most popular series
                 */
                $http({
                    method: 'GET',
                    url : 'home/popularSeries'
                })
                .success(function(data, status, headers, config) {
                    $scope.popularSeries = data;
                });

                // check if it's his first connection
                if(sessionStorage.getItem("firstConnection") == null) {
                    console.log('premiere co');
                    sessionStorage.setItem("firstConnection","false");

                    $mdDialog.show({
                        controller: DialogController,
                        templateUrl: 'web/html/templates/dialogFirstConnection.tmpl.html',
                        parent: angular.element(document.body),
                        clickOutsideToClose: false
                    })
                    .then(function() {
                        $location.path('/connection')
                    });
                }
            }
            else {
                /**
                 * recommandations
                 */
                $http({
                    method:'GET',
                    url:'user/recommandations'
                })
                .success(function(data, status, headers, config) {
                    $scope.recommandationsSeries = data;
                });
            }
        });

    $scope.connect = false;
    $scope.toConnect = function () {
        $location.path('/connection');
    };

    $scope.home = false;
    $scope.toHome = function () {
        $location.path('/');
    };

    $scope.toTrack = function () {
        $location.path('/myTracking');
    };

    $scope.goToProfil = function () {
        $location.path('/myProfil');
    };

    //
    $scope.inputSearchChange = function () {
        if($scope.inputSearch != "") {
            $http({
                method: 'GET',
                url: 'serie/serieSearch/' + $scope.inputSearch
            })
            .success(function (data, status, headers, config) {
                $scope.serieSearch = data;
                console.log(data);
            });
        }
    };

    $scope.disconnect = function () {
        serviceConnection.disconnect();
        location.reload();
        $location.path('/home');
    };

    $scope.displayASerie = function (serieId) {
        serviceSerie.loadSeriePage(serieId);
    };

    /**
     * Controller use for the dialog box
     * @param $scope, scope
     * @param $mdDialog, md-dialog
     * @constructor
     */
    function DialogController($scope, $mdDialog) {
        $scope.guest = function() {
            $mdDialog.cancel();
        };

        $scope.connect = function() {
            $mdDialog.hide();
        };
    }

}]);

