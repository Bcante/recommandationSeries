<?php

require "vendor/autoload.php";

conf\DbConf::init();

$app = new \Slim\Slim(
    array(
        'templates.path' => './web/html/'
    )
);

$app->get('/',function() use ($app){
    $app->render('index.tpl.php');
});

$app->get('/home/genres', function() {
    $contrInvite = new \recommandationSeries\control\GuestController();
    $contrInvite->getGenresSeries();
});

$app->get('/home/informationsSeries', function() {
    // getNamesImagesSeries
});

$app->run();

?>