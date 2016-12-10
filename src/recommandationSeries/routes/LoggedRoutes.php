<?php

use \recommandationSeries\control\LoggedController;

global $loggedController;
$loggedController = new LoggedController();

$app->get('/disconnect', function() {
    session_destroy();
});

$app->get('/user/id/', function() {
    echo $_SESSION['user_id'];
});

$app->put('/followASerie/:serieId', function($serieId) {
    $userId = $_SESSION['user_id'];

    global $loggedController;
    $loggedController->followASerie($userId, $serieId);
});

$app->get('/checkIfFollow/:serieId', function($serieId) {
    $userId = $_SESSION['user_id'];

    global $loggedController;
    echo $loggedController->checkIfFollow($userId, $serieId);
});

$app->get('/user/seriesFollowed/', function() {
    $userId = $_SESSION['user_id'];

    global $loggedController;
    echo $loggedController->seriesFollowed($userId);
});