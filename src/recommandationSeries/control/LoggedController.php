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

    public function hasSeen($userId, $episodeId) {
        $nb = Users::find($userId)
            ->episodes()
            ->where('usersepisodes.episode_id','=',$episodeId)
            ->count();
        return $nb;
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
    public function hasSeenEpisode($userId, $episodeId) {
        //$seen = Users::find($userId)->episodes()->where('episode_id','=',$episodeId)->count();
        $nb = $this->hasSeen($userId,$episodeId);

        $res = $nb === 1 ? json_encode(true) : json_encode(false);
        return $res;
    }

    /**
     * save on database when an episode has been seen
     * @param $userId, user id
     * @param $episodeId, episode id
     */
    public function seenEpisode($userId, $episodeId) {
        // Check if the given episodeID was indeed not seen yet
        if ($this->hasSeen($userId, $episodeId) === 0) {
            Users::find($userId)->episodes()->attach($episodeId);
        }
    }

    /**
     * remove the entry on database
     * @param $userId, user id
     * @param $episodeId, episode id
     */
    public function unseenEpisode($userId, $episodeId) {
        if ($this->hasSeen($userId, $episodeId) === 1) {
            Users::find($userId)->episodes()->detach($episodeId);
        }
    }

    /**
     * For a given user, check his favorites genres 
     * and sort them into an array. The most viewed genres
     * will be at the begin of the array
     * @param $userId, userId
     * @return An array containing the ordered prefered genres
    **/
    public function checkFavGenre($userId) {
        $topGenre = Genres::join('seriesgenres', 'seriesgenres.genre_id', '=', 'genres.id')
            ->join('series', 'seriesgenres.series_id', '=', 'series.id')
            ->join('userseries','series.id','=','userseries.serie_id')
            ->join('users','users.id','=','userseries.user_id')
            ->where('userseries.user_id', '=', $userId)
            ->select('genres.id','genres.name',DB::raw('count(*)'))
            ->orderBy(DB::raw('count(*)'),'DESC')
            ->groupBy('genres.id','genres.name')
            ->get()
            ->toArray();
        return $topGenre;
    }

    /**
    * For a given user, find 5 movies he'll be interested into
    * @param $userId, userId
    * @return an array containing the id of 5 movies who couldn't interest him
    * Explanation: 
    * Firstly, we see what the user is interested into through the series he's following.
    * More specifically, we check which genre is the most common. 
    * For every genres he has interest into, we'll see if we can present them to him (through areSimilarShowAvailable method)
    * Once we had collected enough data (= 5 movies), we trim the array to a max size of 5 (because we can't display more than 5 movies in his user space)
    **/
    public function giveMovieIdea($userId) {
        $genres = $this->checkFavGenre($userId);
        $i = 0;
        $affFinal = array(); 
        $acceptableSize = false;

        while (($acceptableSize !== true) && ( $i < sizeof($genres))) {
            $id = $genres[$i]['id'];
            echo "pour le genre: ".$id;
            $affFinal = $this->areSimilarShowAvailable($userId,$id,$affFinal);
            $i++;
            if (sizeof($affFinal) >= 5) {
                $acceptableSize = true;
                $affFinalId=array_slice($affFinal,0,5);
                $affFinal=Series::select('name','backdrop_path')->findMany($affFinal)->toArray();
                $affFinalJson=json_encode($affFinal);
                return $affFinalJson;
            }
        }

        if ($i === sizeof($genres)) {
            echo "Vous avez tout vu :( ";
        }
    }

    /**
     * For a given userId and genreId, check if there is show that
     * our user haven't seen yet
     * @param userId
     * @param genreId
     * @affArray the previous movies we already had
     *
     * @return a new array, containing both the previous movies found and the new ones.
     * Explanation:
     * We check the movies who are linked to the same genreId . 
     * Then we remove every movies from this previous list, that has already been seen by the user($seenByUser)
     * We take 5 movies (maximum, if there is less than 5 we'll take them all)
     * from those movies, and we append them to the previous movies we selected.
     **/
    public function areSimilarShowAvailable($userId, $genreId, $affArray){
        /**$seenByUser = Genres::where('genres.id','=',$genreId)
                     ->join('seriesgenres','seriesgenres.genre_id','=','genres.id')
                     ->join('series','seriesgenres.series_id','=','series.id')
                     ->join('userseries','userseries.serie_id','=','series.id')
                     ->where([
                            ['userseries.user_id','=',$userId],
                            ['genres.id','=',$genreId]
                      ])
                     ->select('series.id')
                     ->toSql();**/
                     $seenByUser = Genres::where('genres.id','=',$genreId)
                     ->join('seriesgenres','seriesgenres.genre_id','=','genres.id')
                     ->join('series','seriesgenres.series_id','=','series.id')
                     ->join('userseries','userseries.serie_id','=','series.id')
                     ->where('userseries.user_id','=',$userId)
                     ->select('series.id')
                     ->get()
                     ->toArray();
        // At this point we have every ID of the series seen by our users, of the according genres. 
        // Now we take every series of the same genre, and substract all series seen previously.
        
        $relevantSeries = Series::whereNotIn('id', $seenByUser)
                ->join('seriesgenres','seriesgenres.series_id','=','series.id')
                ->select('id')
                ->where('seriesgenres.genre_id','=',$genreId)
                ->orderBy('popularity','DESC')
                ->get()
                ->take(5)
                ->toArray();

        $res = array_merge($affArray, $relevantSeries);
        return $res;
    }

    /**
     * For a given $userId, check if he's following at least one serie.
     */
    public function hasSeenSomething($userId) {
        Users::find($userId)->series();
    }

    public function changePassword($userId, $password) {
        // Your turn Benito !!!
    }

}

?>