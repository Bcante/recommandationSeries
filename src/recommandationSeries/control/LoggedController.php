<?php

namespace recommandationSeries\control;


use recommandationSeries\model\Users;
use recommandationSeries\model\Series;
use recommandationSeries\model\Genres;
use recommandationSeries\model\Episodes;
use recommandationSeries\model\Actors;
use Illuminate\Database\Capsule\Manager as DB;

class LoggedController extends AbstractController {

    public function __construct() {
        parent::__construct();
    }
    
    /** 
     * Handy method used to check if a user is following a given serie
     * Return 1 if he's following the serie, 0 otherwise
     **/
    public function isFollowing($userId, $serieId) {
        return Users::find($userId)->series()->where('serie_id','=',$serieId)->count();
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
        if ($this->isFollowing($userId, $serieId) === 0) {
            $users = Users::find($userId);
            $users->series()->attach($serieId);
        }
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
        $series = Users::find($userId)
                        ->series()
                        ->select('series.name', 'poster_path', 'series.id')
                        ->orderBy('series.name', 'ASC')
                        ->get();
        $seriesJson = json_encode($series);
        return $seriesJson;
    }

    /**
     * Delete the link between a user and a serie, by 
     * deleting the row in user_serie containing 
     * $userId & $serieId
     **/
    public function unfollowASerie($userId, $serieId) {
        if ($this->isFollowing($userId, $serieId) === 1) {
            $users = Users::find($userId);
            $users->series()->detach($serieId);    
        }
    }

    /**
     * Check if an episode is saw
     * @param $userId, user id
     * @param $episodeId, episode id
     * @return string, true or false
     */
    public function checkIfSaw($userId, $episodeId) {
        //$seen = Users::find($userId)->episodes()->where('episode_id','=',$episodeId)->count();
        $nb = Users::find($userId)
            ->episodes()
            ->where('usersepisodes.episode_id','=',$episodeId)
            ->count();

        if ($nb === 0) {
            return json_encode(false);
        }
        else {
            return json_encode(true);
        }
    }

    /**
     * For a given user, check his favorite genre 
     *
     *
    **/
    public function checkFavGenre($userId) {
        /**$a = Users::find($userId)->series()->select('serie_id')->get();
        $b = json_encode($a); 
        
        $resultingArray= array();
        foreach ($a as $p) {
           array_push($resultingArray,$p->serie_id); 
        }
        //var_dump($resultingArray);

        $b = Series::find(36)->users();
        json_encode($b);
        //var_dump($b);
        $c = Users::find(6)->genres()->get();
        json_encode($c);
        var_dump($c);

        //print_r(json_encode(Series::find(36)->genres()->get()));**/
        // Tableau d'users?
        // Pour chaque genre, permet de retrouver le genre le plus vu
        $topGenre = Genres::join('seriesgenres', 'seriesgenres.genre_id', '=', 'genres.id')
            ->join('series', 'seriesgenres.series_id', '=', 'series.id')
            ->join('userseries','series.id','userseries.serie_id')
            ->join('users','users.id','=','userseries.user_id')
            ->where('userseries.user_id', '=', $userId)
            ->select('genres.id')
            ->orderBy(DB::raw('count(*)'),'DESC')
            ->groupBy('genres.id')
            ->get()
            ->toArray();

        $i = 0;
        $foundMatch = false;    
        while (($foundMatch === false) && ( $i < sizeof($topGenre))) {
            $id = $topGenre[$i]['id'];
            $foundMatch = $this->areSimilarShowAvailable($userId,$id);
            $i++;
        }

        if ($i === sizeof($topGenre)) {
            echo "Vous avez tout vu :( ";
        }
    }

    /**
     * For a given userId and genreId, check if there is show that
     * our user haven't seen yet
     **/
    public function areSimilarShowAvailable($userId, $genreId){
        $seenByUser = Genres::where('genres.id','=',$genreId)
                     ->join('seriesgenres','seriesgenres.genre_id','=','genres.id')
                     ->join('series','seriesgenres.series_id','=','series.id')
                     ->join('userseries','userseries.serie_id','=','series.id')
                     ->where([
                            ['userseries.user_id','=',$userId],
                            ['genres.id','=',$genreId]
                      ])
                     ->select('series.id')
                     ->get()
                     ->toArray();
                    
        // At this point we have every ID of the series seen by our users, of the according genres. 
        var_dump(sizeof($seenByUser));
        return false;
    }

}

?>