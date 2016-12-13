<?php
/**
 * Created by PhpStorm.
 * User: benja
 * Date: 13/12/2016
 * Time: 13:16
 */

use \recommandationSeries\control\UsersController;
global $usersController;
$usersController = new UsersController();



/*
 * Routes related to user
 */


$app->group('/user',function () use ($app){
    $app->get('', function () use ($app){
        global $usersController;
        $usersController->getUser();
    });

    $app->get('/seriesFollowed/', function() {
        $userId = $_SESSION['user_id'];

        global $loggedController;
        echo $loggedController->seriesFollowed($userId);
    });

});