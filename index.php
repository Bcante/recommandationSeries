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
    // getGenreSeries
});

$app->get('/home/informationsSeries', function() {
    // getNamesImagesSeries
});

$app->run();

?>