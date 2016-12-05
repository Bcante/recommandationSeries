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
        .when('/connexion',{
            templateUrl: 'web/html/connexion.html',
            controller : 'connexionCtrl'
        })
        .when('/registration', {
            templateUrl: 'web/html/registration.html',
            controller : 'registrationCtrl'
        })
        .when('/home', {
            templateUrl: 'web/html/home.html',
            controller : 'homeCtrl'
        })
        .when('/', {
            templateUrl: 'web/html/home.html',
            controller : 'homeCtrl'
        })
        .when('/series', {
            templateUrl: 'web/html/series.html',
            controller : 'seriesCtrl'
        })
        .otherwise('/', {
            templateUrl : 'web/html/index.tpl.php',
            controller : 'indexCtrl'
        });

    /**
     * Theme and colors
     */
    $mdThemingProvider.theme('default').primaryPalette('teal')
        .accentPalette('amber').dark();
}]);