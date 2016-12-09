<?php

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
    echo $guestController->authentication($email, $password);
});