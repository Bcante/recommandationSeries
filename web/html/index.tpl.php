<?php

?>

<!DOCTYPE html>
<html lang="fr" ng-app="MyApp">
<head>
    <!-- CSS -->
    <link rel="stylesheet" href="web/css/angular-material.min.css">

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
</head>
<body ng-controller="indexCtrl">
    <div>
        <md-content class="md-padding">
            <md-nav-bar md-selected-nav-item="currentNavItem" nav-bar-aria-label="navigation links" class="nav-bar">
                <md-nav-item md-nav-click="goto('pageAccueil')" name="pageAccueil">Accueil</md-nav-item>
                <form ng-submit="$event.preventDefault()" name="searchForm">
                    <div layout-gt-sm="row">
                        <md-input-container flex>
                            <label>Rechercher une serie</label>
                            <input type="text"/>
                        </md-input-container>
                    </div>
                </form>
                <md-nav-item ng-click="toRegistrate()" md-nav-click="goto('pageInscription')" name="pageConnexion">Inscription</md-nav-item>
                <md-nav-item ng-click="toConnect()" md-nav-click="goto('pageConnexion')" name="pageInscription">Connexion</md-nav-item>
            </md-nav-bar>
        </md-content>
    </div>

    <div class="view" ng-view flex>
    </div>
</body>
</html>