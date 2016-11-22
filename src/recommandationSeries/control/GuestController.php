<?php

namespace recommandationSeries\control;

use recommandationSeries\model\Genres;
use recommandationSeries\model\Series;

class GuestController extends AbstractController {

	public function __construct() {
		parent::__construct ();
	}

	public function getGenresSeries() {
        $genres = Genres::select('name')->get();
        $genreJson = json_encode($genres);
        return $genreJson;
	}

	/**public function testGetSeriesEtGenres() {
		$series = Series::all();
		$genres = Genres::all();
		$both = $series
		$genreJson = json_encode($series);
		return $genreJson;
	}**/

	/*public function getNamesImagesSeries() {
        $info = Series::select('name', 'backdrop_path')->get();
        $res = json_encode($info);
        return $res;
    }*/

}
?>
