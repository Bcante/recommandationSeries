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

    /**
     * Check if a User is following a given serie.
     * Return true if there is one line in table user_serie with 
     * the id of the serie, and of the user
    **/
    public function checkIfFollow($userId, $serieId) {
        $users = Users::find($userId)->series()->where('serie_id','=',$serieId)->count();
        if ($users === 1) {
            $thereIsOne = json_encode("true");
            return $thereIsOne;
        }
        else if ($users === 0) {
            $thereIsNone = json_encode("false");
            return $thereIsNone;
        }
    }

    public function seriesFollowed($userId) {
        // need poster_path, id, name of the serie
        $series = Users::find($userId)->series()->select('series.name', 'poster_path', 'series.id')->get();
        $seriesJson = json_encode($series);
        return $seriesJson;
    }

    public function unFollowASerie($userId, $serieId) {

    }
}

?>