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
        .when('/registration', {
            templateUrl: 'web/html/registration.html',
            controller : 'registrationCtrl'
        })
        .when('/home', {
            templateUrl: 'web/html/home.html',
            controller : 'homeCtrl'
        })
        .otherwise('/', {
            templateUrl : 'web/html/index.tpl.php',
            controller : 'indexCtrl'
        });

    $mdThemingProvider.theme('default').primaryPalette('blue')
        .accentPalette('blue').dark();
}]);