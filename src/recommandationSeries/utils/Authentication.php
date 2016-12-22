<?php

namespace recommandationSeries\utils;

use recommandationSeries\model\Users;

class Authentication {

    public static function authenticate($email, $password) {
        $connexionOK = true;
        // user names are unique therefore we can directly search for a matching username 
        // in the DB
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // echo "Invalid mail";
            $connexionOK = false;
        }

        if (filter_var($password,FILTER_SANITIZE_STRING) !== $password) {
            // echo "Invalid password";
            $connexionOK = false;
        }

        if ($connexionOK) {
            $found = Users::where('email', '=', "$email")->count();
            if ($found === 1 ) {
                $usr = Users::where('email', '=', "$email")->first();
                if ($password === $usr->password) {
                    // echo "Successful loggin";
                    Authentication::loadProfile($usr->id);
                    // Define what do we want to store in the session variable
                }
                else {
                    // echo "Invalide email / password";
                    $connexionOK = false;
                }
            }
            else {
                $connexionOK = false;
            }
        }
        return $connexionOK;
    }

    public static function loadProfile($id) {
        session_destroy();
        session_start();
        $_SESSION['user_id'] = $id;
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
            if (filter_var($username,FILTER_SANITIZE_STRING) !== $username) {
                echo "Invalid username";
                $inscOk = false;
            }

            if (filter_var($password,FILTER_SANITIZE_STRING) !== $password) {
                echo "Invalid password";
                $inscOk = false;
            }

            if (filter_var($password_confirm,FILTER_SANITIZE_STRING) !== $password_confirm) {
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
                if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $password)) {
                    echo "The password should be 8 letters long, contain a lowercase and a uppercase letter";
                    $inscOk = false;
                }

                if ($inscOk) {
                    // Final check: Both emails and username can't be found in our DB
                    $sameName = Users::where('name', '=', $username)->count();
                    $sameMail = Users::where('email', '=', $email)->count();

                    if($sameName == 1 or $sameMail ==1) {
                        echo "This username or mail is already in use";
                        $inscOk = false;
                    }
                    else {
                        $newUser = new Users;
                        $newUser->email=$email;
                        $newUser->name=$username;
                        $newUser->password=$password;
                        $newUser->save();
                    }
                }
            }
        }
        return $inscOk;
    }

    public static function verifyPassword($userId, $triedPass) {
        $pass = Users::select('password')
                ->find($userId)
                ->toArray();
        if (isset($pass)) {
            $pass = $pass['password'];
            $res = $pass === $triedPass ? 1 : 0;
            return $res;    
        }
        else {
            // This shouldn't be the case, and means our system is flawed
            echo "alerte intrus";
        }

         
    }
}
?>
