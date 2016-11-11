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
    <script src="../js/app.js"></script>
    <script src="../js/Controller/indexCtrl.js"></script>


</head>
<body ng-controller="indexCtrl">
    <div>
        {{hello}}
    </div>
</body>
</html>
