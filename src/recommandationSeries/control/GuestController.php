<?php

namespace recommandationSeries\control;

use recommandationSeries\model\Genres;
use recommandationSeries\model\Series;

class GuestController extends AbstractController {

	public function __construct() {
		parent::__construct ();
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
		$series = Series::orderBy('name', 'ASC')->get();
        // $series = Series::select('name', 'poster_path')->get();
        $seriesJson = json_encode($series);
        return $seriesJson;
    }

    public function getInfoByGenre($genre) {
        $idGenre = Genres::where( "name", $genre )->get () [0];
        $idGenre = $idGenre->id;

        // select * from `series` inner join `seriesgenres` on `id` = `series_id` where `genre_id` = 16 order by `name` asc
        $series = Series::join('seriesgenres', 'id', '=', 'series_id')->orderBy('name', 'ASC')->where('genre_id', '=', $idGenre)->get();

        $seriesJson = json_encode($series);
        return $seriesJson;
    }

}

?>
