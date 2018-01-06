<?php
/**
use \SalleSport\control\CommonController;

global $commonController;
$commonController = new CommonController();
**/
/*
 * default route
 */
$app->get('/',function() use ($app){
    $app->render('index.tpl.php');
});

/*
 * Routes related to home page

$app->get('/home/popularSeries', function () {
    global $commonController;
    echo $commonController->getPopularSeries();
});
 */
