<?php

use \recommandationSeries\control\CommonController;

global $commonController;
$commonController = new CommonController();

/*
 * default route
 */
$app->get('/',function() use ($app){
    $app->render('index.tpl.php');
});




/*
 * Routes related to home page
 */
$app->get('/home/popularSeries', function () {
    global $commonController;
    echo $commonController->getPopularSeries();
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




/*
 * Routes related to user
 */
$app->get('/user/connectionStatus', function() {
    if(isset($_SESSION['user_id'])) echo true;
    else echo false;
});




/*
 * Routes related to series
 */
$app->get('/series/all', function() {
    global $commonController;
    echo $commonController->getSeries();
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

$app->get('/serie/serieSearch/:serieName', function($serieName) {
    global $commonController;
    echo $commonController->getSearchSerie($serieName);
});




/*
 * Routes related to episodes
 */
$app->get('/episode/:episodeId', function($episodeId) {
    global $commonController;
    // var_dump($commonController->getEpisodeInfo($episodeId));
    echo $commonController->getEpisodeInfo($episodeId);
});




/*
 * Routes related to seasons
 */
$app->get('/serie/seasons/details/:seasonId', function($seasonId) {
    global $commonController;
    echo $commonController->getSeasonsDetails($seasonId);
});