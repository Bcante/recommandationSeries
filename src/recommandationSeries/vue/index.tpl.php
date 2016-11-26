<?php

?>

<!DOCTYPE html>
<html lang="fr" ng-app="MyApp" xmlns="http://www.w3.org/1999/html">
<head>

    <!-- CSS -->
    <link rel="stylesheet" href="web/css/angular-material.min.css">
    <link rel="stylesheet" href="web/css/style.css">

    <!-- Angular Material requires Angular.js Libraries -->
    <script src="web/js/angular/angular.js"></script>
    <script src="web/js/angular/angular-route.js"></script>
    <script src="web/js/angular/angular-animate.min.js"></script>
    <script src="web/js/angular/angular-aria.min.js"></script>
    <script src="web/js/angular/angular-messages.min.js"></script>
    <script src="web/js/angular/angular-sanitize.js"></script>

    <!-- Angular Material Library -->
    <script src="web/js/angular/angular-material.min.js"></script>

    <!-- Custom Script -->
    <script src="web/js/app.js"></script>

    <script src="web/js/Controller/indexCtrl.js"></script>
    <script src="web/js/Controller/connexionCtrl.js"></script>
    <script src="web/js/Controller/registrationCtrl.js"></script>
    <script src="web/js/Controller/homeCtrl.js"></script>
    <script src="web/js/Controller/seriesCtrl.js"></script>
</head>
<body ng-controller="indexCtrl">
<div class="index">
    <div>
        <md-content>
            <md-toolbar>
                <div class="md-toolbar-tools">
                    <md-button aria-label="Accueil" ng-click="toHome()">
                        Home
                    </md-button>
                    <md-input-container>
                        <label>Find a serie</label>
                        <input type="text"/>
                    </md-input-container>
                    <md-button class="md-raised" aria-label="Connexion" ng-click="toConnect()" style="margin-left: 50%">
                        Sign in
                    </md-button>
                    <md-button class="md-raised" aria-label="Inscription" ng-click="toRegistrate()">
                        Sign up
                    </md-button>
                </div>
            </md-toolbar>
        </md-content>
    </div>
    <div class="sidenav" layout="row" flex>
        <md-sidenav layout="column" md-component-id="right" md-is-locked-open="true" class="md-sidenav-right" md-whiteframe="2">
            <div class="menu">
                <h3>Séries les plus populaires</h3>
                <md-whiteframe ng-repeat="popularSerie in popularSeries" flex-sm="45" flex-gt-sm="35" flex-gt-md="25" layout layout-align="center center">
                    <span ng-click="displayASerie(popularSerie.id)">
                        <img src="https://image.tmdb.org/t/p/w300{{ popularSerie.poster_path }}"> <br />
                        {{ popularSerie.name }}
                    </span>
                </md-whiteframe>
            </div>
        </md-sidenav>
    </div>
</div>
    <div class="view" ng-view>
    </div>
</body>
</html>