<?php

namespace recommandationSeries\control;


use recommandationSeries\model\Users;

class LoggedController extends AbstractController {

    public function __construct() {
        parent::__construct();
    }

    public function followASerie($userId, $serieId) {
        /**
         * using series(), which is a method in the Model "Series"
         */
        $users = Users::find($userId);
        $users->series()->attach($serieId);
    }

    public function checkIfFollow($userId, $serieId) {

    }

    public function seriesFollowed($userId) {
        // need poster_path, id, name of the serie
    }

}

?>