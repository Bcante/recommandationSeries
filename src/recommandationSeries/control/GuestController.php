<?php

namespace recommandationSeries\control;


use recommandationSeries\utils\Authentication;


class GuestController extends AbstractController {

	public function __construct() {
		parent::__construct ();
	}

    public function registration($username, $password, $password_confirm, $email) {
	    // Remplir le register par tous le post
        Authentication::register($username, $password, $password_confirm, $email);
    }

    public function authentication($email, $password) {
        // Remplir le authenticate par tous le post
        Authentication::authenticate($email, $password);
    }

}

?>