<?php

namespace recommandationSeries\control;


use recommandationSeries\model\Users;

class LoggedController extends AbstractController {

    public function __construct() {
        parent::__construct();
    }

    public function followASerie($userId, $serieId) {
        /** Utilisation :
        Pour attacher un utilisateur i a une série s
         */
        $users = Users::find($userId);
        $users->series()->attach($serieId);
    }

}

?>