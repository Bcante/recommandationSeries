var app = angular.module('MyApp',[
    'ngMaterial',
    'ngSanitize',
    'ngRoute',
    'routeAppControllers',
    'ngMessages',
    'ngAnimate'
]);
app.config(['$routeProvider', '$mdThemingProvider',function($routeProvider, $mdThemingProvider){
    $routeProvider
        .when('/connexion',{
            templateUrl: 'web/html/connexion.html',
            controller : 'connexionCtrl'
        })
        .otherwise('/',{
            templateUrl: 'web/html/index.tpl.php',
            controller : 'indexCtrl'
        });

    $routeProvider
        .when('/registration', {
            templateUrl: 'web/html/registration.html',
            controller : 'registrationCtrl'
        })
        .otherwise('/', {
            templateUrl : 'web/html/index.tpl.php',
            controller : 'indexCtrl'
        });

    $routeProvider
        .when('/home', {
            templateUrl: 'web/html/home.html',
            controller : 'homeCtrl'
        })
        .otherwise('/', {
            templateUrl : 'web/html/home',
            controller : 'indexCtrl'
        });

    $mdThemingProvider.theme('default').primaryPalette('blue')
        .accentPalette('blue').dark();
}]);