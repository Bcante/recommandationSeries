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

$app->post('/registration', function() {
    $guestContr = new GuestController();
    echo $guestContr->registration();
});

$app->post('/connexion', function() {
    $guestContr = new GuestController();
    $guestContr->authentication();
});

$app->run();

?>
