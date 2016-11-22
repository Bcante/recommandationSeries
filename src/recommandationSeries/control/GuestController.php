<?php

namespace recommandationSeries\control;

use recommandationSeries\model\Genres;

class GuestController extends AbstractController {

	public function __construct() {
		parent::__construct ();
	}

	public function getGenresSeries() {
        $genres = Genres::select('name')->get();
        $genreJson = json_encode($genres);
        return $genreJson;
	}

	/*public function getNamesImagesSeries() {
        $info = Series::select('name', 'backdrop_path')->get();
        $res = json_encode($info);
        return $res;
    }*/

}
?>
