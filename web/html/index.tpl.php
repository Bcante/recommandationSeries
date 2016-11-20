<?php

?>

<!DOCTYPE html>
<html lang="fr" ng-app="MyApp">
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
</head>
<body ng-controller="indexCtrl">
    <div>
       <md-content>
           <md-toolbar style="height: 80px">
               <div class="md-toolbar-tools" layout="row">
                   <md-button aria-label="Accueil">
                       Accueil
                   </md-button>
                   <md-input-container style="margin-top: 40px">
                       <label>Rechercher une serie</label>
                       <input type="text"/>
                   </md-input-container>
                   <md-button class="md-raised" aria-label="Connexion" ng-click="toConnect()">
                       Connexion
                   </md-button>
                   <md-button class="md-raised" aria-label="Inscription" ng-click="toRegistrate()">
                       Inscription
                   </md-button>
               </div>
           </md-toolbar>
       </md-content>
    </div>
    <div class="view" ng-view flex>
    </div>
</body>
</html>