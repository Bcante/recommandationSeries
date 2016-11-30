<?php

namespace recommandationSeries\control;

use recommandationSeries\model\Genres;
use recommandationSeries\model\Users;
use recommandationSeries\model\Series;
use recommandationSeries\utils\Authentication;
use recommandationSeries\model\Seasons;

class GuestController extends AbstractController {

	public function __construct() {
		parent::__construct ();
	}

    public function getPopularSeries() {
        $popularSeries = Series::orderBy('popularity', 'DESC')->take(5)->get();
        $popularSeriesJson = json_encode($popularSeries);
        return $popularSeriesJson;
    }

    public function getSearchSerie($serieName) {
        $searchSerie = Series::orderBy('name', 'ASC')->where('name', 'LIKE', $serieName.'%')->take(10)->get();
        $searchSerieJson = json_encode($searchSerie);
        return $searchSerieJson;
    }

	public function getGenresSeries() {
        $genres = Genres::orderBy('name', 'ASC')->get();
        $genreJson = json_encode($genres);
        return $genreJson;
	}

	public function testGetSeriesEtGenres() {
		$series = Series::with('genres')->first();
		
		//$genreJson = json_encode($series);
		return "$series";
	}

    public function getAllSeries() {
		$series = Series::orderBy('name', 'ASC')->select('name', 'poster_path', 'id')->get();
        $seriesJson = json_encode($series);
        return $seriesJson;
    }

    public function getInfoByGenre($genreId) {
        // select * from `series` inner join `seriesgenres` on `id` = `series_id` where `genre_id` = 16 order by `name` asc
        $series = Series::join('seriesgenres', 'id', '=', 'series_id')->orderBy('name', 'ASC')->where('genre_id', '=', $genreId)->get();
        $seriesJson = json_encode($series);
        return $seriesJson;
    }

    public function getInfoSerie($serieId) {
        $serie = Series::/*join('seriescreators', 'series.id', '=', 'seriescreators.series_id')
                            ->join('creators', 'seriescreators.creator_id', '=', 'creators.id')
                            /*->join('seriesseasons', 'seriesseasons.season_id', '=', 'series.id')
                            ->join('seasons', 'seasons.id', '=', 'seriesseasons.season_id')
                            ->join('seasonsepisodes', 'seasons.id', '=', 'seasonsepisodes.season_id')
                            ->join('episodes', 'seasonsepisodes.episode_id', '=', 'episodes.id')*/
                            where('series.id', '=', $serieId)
                            ->get();
        $serieJson = json_encode($serie);
        return $serieJson;
    }

    public function getCreator($serieId) {
        $creator = Series::join('seriescreators', 'series.id', '=', 'seriescreators.series_id')
                            ->join('creators', 'seriescreators.creator_id', '=', 'creators.id')
                            ->select('creators.name')
                            ->where('series.id', '=', $serieId)
                            ->get();
        $creatorJson = json_encode($creator);
        return $creatorJson;
    }

    public function getSeasons($serieId) {
        $season = Series::join('seriesseasons', 'seriesseasons.series_id', '=', 'series.id')
                            ->join('seasons', 'seasons.id', '=', 'seriesseasons.season_id')
                            ->select('seasons.name', 'seasons.id')
                            ->where('series.id', '=', $serieId)
                            ->get();
        $seasonJson = json_encode($season);
        return $seasonJson;
    }

    public function getEpisodes($seasonId) {
        $episodes = Seasons::join('seasonsepisodes', 'seasons.id', '=', 'seasonsepisodes.season_id')
                            ->join('episodes', 'seasonsepisodes.episode_id', '=', 'episodes.id')
                            ->select('episodes.name', 'episodes.air_date')
                            ->where('seasons.id', '=', $seasonId)
                            ->get();
        $episodesJson = json_encode($episodes);
        return $episodesJson;
    }

    public function registration($username, $password, $password_confirm, $email) {
	    // Remplir le register par tous le post
        Authentication::register($username, $password, $password_confirm, $email);
    }

    /*public function authentication() {
        // Remplir le authenticate par tous le post
        Authentication::authenticate();
    }*/

}

?>
