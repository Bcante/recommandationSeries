<?php
/**
 * Created by PhpStorm.
 * User: benja
 * Date: 13/12/2016
 * Time: 13:17
 */

namespace recommandationSeries\control;
use recommandationSeries\model\Users;


class UsersController
{

    function getUser(){
        $userId = $_SESSION['user_id'];
        $info = Users::find($userId);
        echo $info;
    }
}