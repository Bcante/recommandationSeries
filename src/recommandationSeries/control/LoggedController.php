<?php

namespace recommandationSeries\control;


use recommandationSeries\model\Users;

class LoggedController extends AbstractController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Save in database the serie followed by the user
     * @param $userId, id user
     * @param $serieId, id serie
     */
    public function followASerie($userId, $serieId) {
        /**
         * using series(), which is a method in the Model "Series"
         */
        $users = Users::find($userId);
        $users->series()->attach($serieId);
    }

    /**
     * Check if a User is following a given serie.
     * Return true if there is one row in table user_serie with 
     * the id of the serie, and of the user
    **/
    public function checkIfFollow($userId, $serieId) {
        $users = Users::find($userId)->series()->where('serie_id', '=', $serieId)->count();
        if ($users === 1) {
            $thereIsOne = json_encode(true);
            return $thereIsOne;
        } else if ($users === 0) {
            $thereIsNone = json_encode(false);
            return $thereIsNone;
        }
    }

    /** 
     * For a given $userId, check which series
     * he is currently following 
     **/
    public function seriesFollowed($userId) {
        // need poster_path, id, name of the serie
        $series = Users::find($userId)->series()->select('series.name', 'poster_path', 'series.id')->get();
        $seriesJson = json_encode($series);
        return $seriesJson;
    }

    /**
     * Delete the link between a user and a serie, by 
     * deleting the row in user_serie containing 
     * $userId & $serieId
     **/
    public function unfollowASerie($userId, $serieId) {
        $users = Users::find($userId);
        $users->series()->detach($serieId);
    }
}

?>