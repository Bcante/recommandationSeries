<?php

use \recommandationSeries\control\LoggedController;

global $loggedController;
$loggedController = new LoggedController();

/*
 * Route used for disconnection
 */
$app->get('/disconnect', function() {
    session_destroy();
});

/*
 * Routes related to series
 */
$app->put('/serie/followASerie/:serieId', function($serieId) {
    $userId = $_SESSION['user_id'];

    global $loggedController;
    echo $loggedController->followASerie($userId, $serieId);
});

$app->get('/serie/checkIfFollow/:serieId', function($serieId) {
    $userId = $_SESSION['user_id'];

    global $loggedController;
    echo $loggedController->checkIfFollow($userId, $serieId);
});

$app->delete('/serie/unfollowASerie/:serieId', function($serieId) {
    $userId = $_SESSION['user_id'];

    global $loggedController;
    echo $loggedController->unfollowASerie($userId, $serieId);
});

/*
 * Routes related to episodes
 */
$app->put('/episode/checkIfSaw/:episodeId', function($episodeId) {
    $userId = $_SESSION['user_id'];

    global $loggedController;
    echo $loggedController->hasSeenEpisode($userId, $episodeId);
});

$app->put('/episode/seen/:episodeId', function($episodeId) {
    $userId = $_SESSION['user_id'];

    global $loggedController;
    echo $loggedController->seenEpisode($userId, $episodeId);
});

$app->get('/episode/unseen/:episodeId', function($episodeId) {
    $userId = $_SESSION['user_id'];

    global $loggedController;
    echo $loggedController->unseenEpisode($userId, $episodeId);
});

/*
 * Routes related to user
 */
$app->get('/user/seriesFollowed/', function() {
    $userId = $_SESSION['user_id'];

    global $loggedController;
    echo $loggedController->seriesFollowed($userId);
});

$app->post('user/modifiedProfil/', function() {
    //BenitoPepito property
});

$app->get('/user/favoritesSeries/', function() {
    $userId = $_SESSION['user_id'];
    global $loggedController;
    echo $loggedController->checkFavGenre($userId);
});