/**
 * Created by benja on 11/11/2016.
 */
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
    $mdThemingProvider.theme('default').primaryPalette('green')
        .accentPalette('red').dark();
}]);