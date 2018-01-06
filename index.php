<?php

require "vendor/autoload.php";

//\conf\DbConf::init();

$app = new \Slim\Slim(
    array(
        'templates.path' => './src/SalleSport/vue'
    )
);

session_start();

include("src/SalleSport/routes/CommonRoutes.php");

if(isset($_SESSION['user_id'])) {
    // routes when user is connected
    // $loggedController

    //include("src/SalleSport/routes/LoggedRoutes.php");

}
else {
    // routes when user is not connected
    // $guestController

    //include("src/SalleSport/routes/GuestRoutes.php");
}

$app->run();

?>