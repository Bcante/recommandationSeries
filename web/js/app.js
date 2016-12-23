var app = angular.module('MyApp',[
    'ngMaterial',
    'ngSanitize',
    'ngRoute',
    'routeAppControllers',
    'ngMessages',
    'ngAnimate'
]);

/**
 * Routes
 */
app.config(['$routeProvider', '$mdThemingProvider',function($routeProvider, $mdThemingProvider){
    $routeProvider
        .when('/', {
            templateUrl: 'web/html/home.html',
            controller : 'homeCtrl'
        })
        .when('/connection',{
            templateUrl: 'web/html/connection.html',
            controller : 'connectionCtrl'
        })
        .when('/registration', {
            templateUrl: 'web/html/registration.html',
            controller : 'registrationCtrl'
        })
        .when('/home', {
            templateUrl: 'web/html/home.html',
            controller : 'homeCtrl'
        })
        .when('/series/:id', {
            templateUrl: 'web/html/series.html',
            controller : 'seriesCtrl'
        })
        .when('/myTracking', {
            templateUrl : 'web/html/myTracking.html',
            controller : 'trackCtrl'
        })
        .when('/myProfil', {
            templateUrl : 'web/html/myProfil.html',
            controller : 'profilCtrl'
        })
        .otherwise('/', {
            templateUrl : 'web/html/index.tpl.php',
            controller : 'indexCtrl'
        });

    /**
     * Theme and colors
     */
    $mdThemingProvider.theme('default')
        .primaryPalette('indigo', {
            'default' : '600',
            'hue-1' : '700',
            'hue-2' : '800',
            'hue-3' : '900'
        })
        .accentPalette('grey', {
            'default' : '100',
            'hue-1' : '100',
            'hue-2' : '300',
            'hue-3' : '400'
        });
}]);