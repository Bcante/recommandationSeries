<?php
require "vendor/autoload.php";

$app = new \Slim\Slim(
    array(
        'templates.path' => './web/html/'
    )
);

$app->get("/",function() use ($app){
    $app->render('index.tpl.php');
});

$app->run();

?>
