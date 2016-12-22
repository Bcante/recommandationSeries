<?php

namespace recommandationSeries\control;

use recommandationSeries\model\Actors;
use recommandationSeries\model\Genres;
use recommandationSeries\model\Seasons;
use recommandationSeries\model\Series;
use recommandationSeries\model\Episodes;


class CommonController extends AbstractController {

    public function __construct() {
        parent::__construct ();
    }

    public function getAllSeries() {
        $series = Series::orderBy('name', 'ASC')
            ->select('name', 'poster_path', 'id')
            ->get();
        $seriesJson = json_encode($series);
        return $seriesJson;
    }

    public function getPopularSeries() {
        $popularSeries = Series::orderBy('popularity', 'DESC')
            ->select('name', 'poster_path', 'id')
            ->take(5)
            ->get();
        $popularSeriesJson = json_encode($popularSeries);
        return $popularSeriesJson;
    }

    public function getSearchSerie($serieName) {
        $searchSerie = Series::orderBy('name', 'ASC')
            ->where('name', 'LIKE', $serieName.'%')
            ->select('name','id')
            ->take(10)
            ->get();
        $searchSerieJson = json_encode($searchSerie);
        return $searchSerieJson;
    }

    public function getGenresSeries() {
        $genres = Genres::orderBy('name', 'ASC')
            ->get();
        $genreJson = json_encode($genres);
        return $genreJson;
    }

    public function getByGenre($genreId) {
        $series = Series::join('seriesgenres', 'id', '=', 'series_id')
            ->select('name', 'poster_path', 'id')
            ->where('genre_id', '=', $genreId)
            ->orderBy('name', 'ASC')
            ->get();
        $seriesJson = json_encode($series);
        return $seriesJson;
    }

    public function getInfoSerie($serieId) {
        $serie = Series::where('series.id', '=', $serieId)
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
            ->orderBy('seasons.number', 'ASC')
            ->select('seasons.name', 'seasons.id')
            ->where('series.id', '=', $serieId)
            ->get();
        $seasonJson = json_encode($season);
        return $seasonJson;
    }

    public function getSeasonsDetails($seasonId) {
        $season = Seasons::select('id', 'name', 'overview', 'poster_path', 'air_date')
                        ->where('id', '=', $seasonId)
                        ->get();
        $seasonJson = json_encode($season);
        return $seasonJson;
    }

    public function getEpisodes($seasonId) {
        $episodes = Seasons::join('seasonsepisodes', 'seasons.id', '=', 'seasonsepisodes.season_id')
            ->join('episodes', 'seasonsepisodes.episode_id', '=', 'episodes.id')
            ->orderBy('episodes.number', 'ASC')
            ->select('episodes.name', 'episodes.air_date', 'episodes.id', 'episodes.number')
            ->where('seasons.id', '=', $seasonId)
            ->get();
        $episodesJson = json_encode($episodes);
        return $episodesJson;
    }

    public function getActors($episodeId) {
        $actors = Actors::join('episodesactors', 'actors.id', '=', 'episodesactors.actor_id')
            ->join('episodes', 'episodesactors.episode_id', '=', 'episodes.id')
            ->select('actors.name')
            ->where('episode_id', '=', $episodeId)
            ->get();
        $actorsJson = json_encode($actors);
        return $actorsJson;
    }

    public function getEpisodeInfo($episodeId) {
        $episode = Episodes::select('name', 'overview', 'air_date', 'still_path', 'id')
                            ->where('id', '=', $episodeId)
                            ->get();
        $episodeJson = json_encode($episode);
        return $episodeJson;
    }

    public function getSeries() {
        $series = Series::order_by('name', 'ASC')->get();
        $seriesJson = json_encode($series);
        return $seriesJson;
    }

}