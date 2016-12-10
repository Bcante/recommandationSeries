<?php

use \recommandationSeries\control\CommonController;

global $commonController;
$commonController = new CommonController();

$app->get('/user/connectionStatus', function() {
    if(isset($_SESSION['user_id'])) echo true;
    else echo false;
});

$app->get('/',function() use ($app){
    $app->render('index.tpl.php');
});

$app->get('/home/popularSeries', function () {
    global $commonController;
    echo $commonController->getPopularSeries();
});

$app->get('serie/serieSearch/:serieName', function($serieName) {
    global $commonController;
    echo $commonController->getSearchSerie($serieName);
});

$app->get('/home/genres', function() {
    global $commonController;
    echo $commonController->getGenresSeries();
});

$app->get('/home/allSeries', function() {
    global $commonController;
    echo $commonController->getAllSeries();
});

$app->get('/home/seriesByGenre/:genre', function($genre) {
    global $commonController;
    echo $commonController->getByGenre($genre);
});

$app->get('/serie/:serieId', function($serieId) {
    global $commonController;
    echo $commonController->getInfoSerie($serieId);
});

$app->get('/serie/creator/:serieId', function($serieId) {
    global $commonController;
    echo $commonController->getCreator($serieId);
});

$app->get('/serie/seasons/:serieId', function($serieId) {
    global $commonController;
    echo $commonController->getSeasons($serieId);
});

$app->get('/serie/episodes/:seasonId', function($seasonId) {
    global $commonController;
    echo $commonController->getEpisodes($seasonId);
});

$app->get('/serie/actors/:episodeId', function($episodeId) {
    global $commonController;
    echo $commonController->getActors($episodeId);
});