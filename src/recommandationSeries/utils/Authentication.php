<?php
namespace recommandationSeries\utils;
use recommandationSeries\model\Users;

class Authentication {
    public static function authenticate($name, $password) {

    }

    public static function register($username, $password, $password_confirm, $email) {
        // Check if the form is correctly filled
        // Username has to be at least 4 chars long
        // Password has to be at least 8 chars long, and contain a number

        $inscOk = true;
        // First level: Check if all inputs are set
        if (!isset($username) || !isset($password) || !isset($password_confirm) || !isset($email)) {
            echo "At least one of the field wasn't filled";
            $inscOk = false;
        }
        // Second level: Filter and sanitize incoming inputs
        else {
            if (!filter_var($username, FILTER_VALDATE_STRING)) {
                echo "Invalid username";
                $inscOk = false;
            }

            if (!filter_var($password, FILTER_VALDATE_STRING)) {
                echo "Invalid password";
                $inscOk = false;
            }

            if (!filter_var($password_confirm, FILTER_VALDATE_STRING)) {
                echo "Invalid password confirmation";
                $inscOk = false;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid mail";
                $inscOk = false;
            }
            // Third level: check if the inputs matches our policies
            if ($inscOk) {
                if(strlen($username) < 4) {
                    echo "Username is not long enough";
                    $inscOk = false;
                }
                if (!$password_confirm === $password) {
                    echo "The two passwords didn't match";
                    $inscOk = false;
                }
                if (!preg_match("^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$", $password)) {
                    echo "The password should be 8 letters long, contain a lowercase and a uppercase letter";
                    $inscOk = false;
                }
            }
        }
        // Now that the inputs are sanitzed, we can check if they meet our policies


        return $inscOk;
    }
}
?>
