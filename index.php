<?php

require "vendor/autoload.php";

conf\DbConf::init();

$app = new \Slim\Slim(
    array(
        'templates.path' => './src/recommandationSeries/vue'
    )
);

$app->get('/',function() use ($app){
    $app->render('index.tpl.php');
});

$app->get('/home/genres', function() {
    $guestContr = new \recommandationSeries\control\GuestController();
    $guestContr->getGenresSeries();
});

/*$app->get('/home/informationsSeries', function() {
    $guestContr = new \recommandationSeries\control\GuestController();
    $guestContr->getNamesImagesSeries();
});*/

$app->run();

?>