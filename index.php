<?php

require "vendor/autoload.php";

use \recommandationSeries\control\GuestController;
use \recommandationSeries\control\CommonController;
use recommandationSeries\control\LoggedController;

\conf\DbConf::init();

$app = new \Slim\Slim(
    array(
        'templates.path' => './src/recommandationSeries/vue'
    )
);

global $commonController;
$commonController = new CommonController();

global $guestController;
$guestController = new GuestController();

global $loggedController;
$loggedController = new LoggedController();

if(isset($_SESSION['user_id'])) {
    // routes when user is connected
    // $loggedController
    global $loggedController;
}
else {
    // routes when user is not connected
    // $guestController

    $app->post('/registration', function() use ($app) {
        $param = json_decode($app->request->getBody());
        $username = $param->username;
        $password = $param->password;
        $password_confirm = $param->password_confirm;
        $email = $param->email;

        global $guestController;
        echo $guestController->registration($username, $password, $password_confirm, $email);
    });

    $app->post('/connexion', function() use ($app) {
        $param = json_decode($app->request->getBody());
        $password = $param->password;
        $email = $param->email;

        global $guestController;
        $guestController->authentication($email,$password);
    });
}


// common routes
$app->get('/',function() use ($app){
    $app->render('index.tpl.php');
});

$app->get('/home/popularSeries', function () {
    global $commonController;
    echo $commonController->getPopularSeries();
});

$app->get('/serieSearch/:serieName', function($serieName) {
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

$app->get('/series/:serieId', function($serieId) {
    global $commonController;
    echo $commonController->getInfoSerie($serieId);
});

$app->get('/series/creator/:serieId', function($serieId) {
    global $commonController;
    echo $commonController->getCreator($serieId);
});

$app->get('/series/seasons/:serieId', function($serieId) {
    global $commonController;
    echo $commonController->getSeasons($serieId);
});

$app->get('/series/episodes/:seasonId', function($seasonId) {
    global $commonController;
    echo $commonController->getEpisodes($seasonId);
});

$app->get('/series/actors/:episodeId', function($episodeId) {
    global $commonController;
    echo $commonController->getActors($episodeId);
});

$app->run();

?>