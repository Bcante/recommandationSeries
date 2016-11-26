<?php

namespace recommandationSeries\control;

use recommandationSeries\model\Genres;
use recommandationSeries\model\Users;
use recommandationSeries\model\Series;
use recommandationSeries\utils\Authentication;

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
        $serie = Series::orderBy('name', 'ASC')->where('id', '=', $serieId)->get();
        $serieJson = json_encode($serie);
        return $serieJson;
    }

    public function registration() {
	    // Remplir le register par tous le post
        Authentication::register();
    }

    public function authentication() {
        // Remplir le authenticate par tous le post
        Authentication::authenticate();
    }

}

?>
