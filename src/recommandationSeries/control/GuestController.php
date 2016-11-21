<?php
namespace recommandationSeries\control;

class GuestController extends AbstractController {
	public function __construct() {
		parent::__construct ();
	}

	public function getGenresSeries() {
		$genres = Genres::select('name')->get();
		$res = json_encode($genres);
		echo $res;
	}

	public function getNamesImagesSeries() {}

}
?>
