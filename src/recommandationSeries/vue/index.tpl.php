<?php

?>

<!DOCTYPE html>
<html lang="fr" ng-app="MyApp" xmlns="http://www.w3.org/1999/html">
<head>

    <!-- CSS -->
    <link rel="stylesheet" href="web/css/angular-material.min.css">
    <link rel="stylesheet" href="web/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- CSS for carousel -->
    <link rel="stylesheet" href="web/angular-carousel/angular-carousel.css">
    <link rel="stylesheet" href="web/angular-carousel/angular-carousel.css.map">
    <link rel="stylesheet" href="web/angular-carousel/angular-carousel.min.css">

    <!-- Angular Material requires Angular.js Libraries -->
    <script src="web/js/angular/angular.js"></script>
    <script src="web/js/angular/angular-route.js"></script>
    <script src="web/js/angular/angular-animate.min.js"></script>
    <script src="web/js/angular/angular-aria.min.js"></script>
    <script src="web/js/angular/angular-messages.min.js"></script>
    <script src="web/js/angular/angular-sanitize.js"></script>

    <!-- Script for carousel -->
    <script src="web/angular-carousel/angular-carousel.js"></script>
    <script src="web/angular-carousel/angular-carousel.min.js"></script>

    <!-- Angular Material Library -->
    <script src="web/js/angular/angular-material.min.js"></script>

    <!-- Custom Script -->
    <script src="web/js/app.js"></script>

    <!-- Controllers -->
    <script src="web/js/controller/indexCtrl.js"></script>
    <script src="web/js/controller/connectionCtrl.js"></script>
    <script src="web/js/controller/registrationCtrl.js"></script>
    <script src="web/js/controller/homeCtrl.js"></script>
    <script src="web/js/controller/seriesCtrl.js"></script>
    <script src="web/js/controller/trackCtrl.js"></script>
    <script src="web/js/controller/profilCtrl.js"></script>

    <!-- Services -->
    <script src="web/js/service/serviceSerie.js"></script>
    <script src="web/js/service/serviceConnection.js"></script>
</head>

<body ng-controller="indexCtrl">
<div class="index">
    <md-toolbar>
        <div class="md-toolbar-tools">
            <md-button aria-label="Accueil" ng-click="toHome()">
                <md-icon>home</md-icon> Home
            </md-button>
            <md-button ng-show="connected" aria-label="My tracking" ng-click="toTrack()">
                <md-icon>list</md-icon> My tracking
            </md-button>
            <md-button aria-label="Find a serie" ng-click="findSerie()">
                <md-icon>search</md-icon> Find a serie
            </md-button>
            <span flex></span>
            <div ng-show="!connected">
                <md-button aria-label="Sign in" ng-click="toConnect()">
                    <md-icon>account_circle</md-icon> Sign in / Sign up
                </md-button>
            </div>
            <div ng-show="connected">
                <md-button aria-label="Profil" ng-click="goToProfil()">
                   <md-icon>perm_identity</md-icon> Profil
                </md-button>
                <md-button aria-label="Sign out" ng-click="disconnect()">
                    <md-icon>exit_to_app</md-icon> Sign out
                </md-button>
            </div>
        </div>
    </md-toolbar>
    <div class="sidenav" layout="row" flex>
        <md-sidenav layout="column" md-component-id="right" md-is-locked-open="true" class="md-sidenav-right" md-whiteframe="2">
            <div ng-show="!connected" class="menu">
                <h3>Most popular series</h3>
                <md-whiteframe ng-repeat="popularSerie in popularSeries" flex-sm="45" flex-gt-sm="35" flex-gt-md="25" layout layout-align="center center">
                    <span class="sideserie" ng-click="displayASerie(popularSerie.id)">
                        <img src="https://image.tmdb.org/t/p/w300{{ popularSerie.poster_path }}"> <br />
                    </span>
                </md-whiteframe>
            </div>
            <div ng-show="connected" class="menu">
                <h3>We recommend you</h3>
                <md-whiteframe ng-repeat="recommandationSerie in recommandationsSeries" flex-sm="45" flex-gt-sm="35" flex-gt-md="25" layout layout-align="center center">
                    <span class="sideserie" ng-click="displayASerie(recommandationSerie.id)">
                        <img src="https://image.tmdb.org/t/p/w300{{ recommandationSerie.poster_path }}"> <br />
                    </span>
                </md-whiteframe>
            </div>
        </md-sidenav>
    </div>

    <md-content class="view" ng-view>
    </md-content>

</div>

</body>
</html>