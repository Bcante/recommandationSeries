<?php

use \recommandationSeries\control\GuestController;

global $guestController;
$guestController = new GuestController();

/*
 * Route used for registration
 */
$app->put('/registration', function() use ($app) {
    $param = json_decode($app->request->getBody());
    $username = $param->username;
    $password = $param->password;
    $password_confirm = $param->password_confirm;
    $email = $param->email;

    global $guestController;
    echo $guestController->registration($username, $password, $password_confirm, $email);
});

/*
 * Route used for connection
 */
$app->post('/connection', function() use ($app) {
    $param = json_decode($app->request->getBody());
    $password = $param->password;
    $email = $param->email;

    global $guestController;
    echo $guestController->authentication($email, $password);
});