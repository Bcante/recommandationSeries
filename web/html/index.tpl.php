<?php
/**
 * Created by PhpStorm.
 * User: benja
 * Date: 11/11/2016
 * Time: 15:49
 */
?>

<!DOCTYPE html>
<html lang="fr" ng-app="MyApp">
<head>
    <!-- CSS -->
    <link rel="stylesheet"
          href="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0-rc2/angular-material.min.css">

    <!-- Angular Material requires Angular.js Libraries -->
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.js"></script>
    <script src="https://code.angularjs.org/1.5.5/angular-route.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-sanitize.js"></script>

    <!-- Angular Material Library -->
    <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>

    <!-- Custom Script -->
    <script src="web/js/app.js"></script>

    <script src="web/js/Controller/indexCtrl.js"></script>

    <script src="web/js/Controller/connexionCtrl.js"></script>


</head>
<body ng-controller="indexCtrl">
    <div>
        <md-content class="md-padding" layout-xs="column" layout="row">
        <md-card class="md-primary">
            <md-card-title>
                <md-card-titile-text>
                    {{hello}}
                </md-card-titile-text>
            </md-card-title>
            <md-card-actions>
                <md-button class="md-primary" ng-click="toConnect()">
                    Se connecter
                </md-button>
            </md-card-actions>
        </md-card>
        </md-content>
    </div>

    <div class="view" ng-view flex>
    </div>
</body>
</html>
