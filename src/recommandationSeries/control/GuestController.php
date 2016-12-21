<?php

namespace recommandationSeries\control;


use recommandationSeries\model\Genres;
use recommandationSeries\utils\Authentication;


class GuestController extends AbstractController {

	public function __construct() {
		parent::__construct ();
	}

    public function getGenres() {
        $genres = Genres::orderBy('name', 'ASC')
                    ->get();
        $genresJson = json_encode($genres);
        return $genresJson;
    }

    public function registration($username, $password, $password_confirm, $email) {
        Authentication::register($username, $password, $password_confirm, $email);
    }

    public function authentication($email, $password) {
        return Authentication::authenticate($email, $password);
    }

}

?>