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
        .when('/home',{
            templateUrl: 'html/home.html',
            controller : 'homeCtrl'
        });
    $mdThemingProvider.theme('dark').primaryPalette('green')
        .accentPalette('red');
}]);