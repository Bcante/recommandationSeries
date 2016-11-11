<?php

require "vendor/autoload.php";

$app = new \Slim\App();

$app->get("/",function(){

    echo "Hello World";
});

$app->run();

?>
