<?php


$app->get('/disconnect', function() {
    session_destroy();
});

$app->get('/user/id/', function() {
    echo $_SESSION['user_id'];
});

$app->put('/followASerie/', function() use ($app){
    $param = json_decode($app->request->getBody());
    $userId = $param->userId;
    $serieId = $param->serieId;

    global $loggedController;
    echo $loggedController->followASerie($userId, $serieId);
});

$app->get('/checkIfFollow', function() use ($app) {
    $param = json_decode($app->request->getBody());
    $userId = $param->userId;
    $serieId = $param->serieId;

    global $loggedController;
    echo $loggedController->checkIfFollow($userId, $serieId);
});