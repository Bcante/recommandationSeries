<?php

?>

<!DOCTYPE html>
<html lang="fr" ng-app="MyApp" xmlns="http://www.w3.org/1999/html">
<head>

    <!-- CSS -->
    <link rel="stylesheet" href="web/css/angular-material.min.css">
    <link rel="stylesheet" href="web/css/jk-carousel.min.css">
    <link rel="stylesheet" href="web/css/style.css">
    <link href="web/css/material-icons.css" rel="stylesheet">

    <!-- Angular Material requires Angular.js Libraries -->
    <script src="web/js/angular/angular.js"></script>
    <script src="web/js/angular/angular-route.js"></script>
    <script src="web/js/angular/angular-animate.min.js"></script>
    <script src="web/js/angular/angular-aria.min.js"></script>
    <script src="web/js/angular/angular-messages.min.js"></script>
    <script src="web/js/angular/angular-sanitize.js"></script>

    <!-- Angular Material Library -->
    <script src="web/js/angular/angular-material.min.js"></script>

    <!-- Catousel Script -->
    <script src="web/js/angular/jk-carousel.min.js"></script>

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


    <md-content class="view" ng-view>
    </md-content>

</div>

</body>
</html>