<?php

require "vendor/autoload.php";

use \recommandationSeries\control\GuestController;

\conf\DbConf::init();

$app = new \Slim\Slim(
    array(
        'templates.path' => './src/recommandationSeries/vue'
    )
);

$app->get('/',function() use ($app){
    $app->render('index.tpl.php');
});

$app->get('/home/popularSeries', function () {
    $guestContr = new GuestController();
    echo $guestContr->getPopularSeries();
});

$app->get('/serieSearch/:serieName', function($serieName) {
    $guestContr = new GuestController();
    echo $guestContr->getSearchSerie($serieName);
});

$app->get('/home/genres', function() {
    $guestContr = new GuestController();
    echo $guestContr->getGenresSeries();
	//echo $guestContr->testGetSeriesEtGenres();
});

$app->get('/home/allSeries', function() {
    $guestContr = new GuestController();
    echo $guestContr->getAllSeries();
});

$app->get('/home/infoSeriesByGenre/:genre', function($genre) {
    $guestContr = new GuestController();
    echo $guestContr->getInfoByGenre($genre);
});

$app->get('/series/:serieId', function($serieId) {
    $guestContr = new GuestController();
    echo $guestContr->getInfoSerie($serieId);
});

$app->get('/series/creator/:serieId', function($serieId) {
    $guestContr = new GuestController();
    echo $guestContr->getCreator($serieId);
});

$app->get('/series/seasons/:serieId', function($serieId) {
    $guestContr = new GuestController();
    echo $guestContr->getSeasons($serieId);
});

$app->get('/series/episodes/:seasonId', function($seasonId) {
    $guestContr = new GuestController();
    echo $guestContr->getEpisodes($seasonId);
});

$app->get('/series/actors/:episodeId', function($episodeId) {
    $guestContr = new GuestController();
    echo $guestContr->getActors($episodeId);
});

$app->post('/registration', function() use ($app) {
    $param = json_decode($app->request->getBody());
    $username = $param->username;
    $password = $param->password;
    $password_confirm = $param->password_confirm;
    $email = $param->email;

    $guestContr = new GuestController();
    echo $guestContr->registration($username, $password, $password_confirm, $email);
});

$app->post('/connexion', function() use ($app) {
    $param = json_decode($app->request->getBody());
    $password = $param->password;
    $email = $param->email;

    $guestContr = new GuestController();
    $guestContr->authentication($mail,$password);
});

$app->run();

?>