<?php

namespace SalleSport\utils;

use RandomLib\Factory;
use SalleSport\model\Users;

class Authentication {

    /** 
     * Function used to log in. 
     * @param $email, the email used to log in, specied by the user
     * @param $password, the password used to log in, specied by the user
     *
     * The functio will first check if there is no forbidden characters in
     * the input fields, and if they aren't empty. 
     * If any field is potentially dangerous, the log in process is stopped. 
     * If every fields are ok, we compare the $email with the one stored in the DB. 
     * Then we add salt the salt linked to the provided pass, hashit, and compare it
     * to whatever is stored in the DB. If the mails & passwords match, the user is logged.
     */ 
    public static function authenticate($email, $password) {
        $connexionOK = true;
        // user names are unique therefore we can directly search for a matching username 
        // in the DB

        if (!isset($email) || !isset($password)) {
            $connexionOk = false;
        }

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
                $usrSalt = $usr->salt;
                $hashedPass = $usr->password;
                $saltedPass = $password.$usrSalt;

                if (password_verify($saltedPass,$hashedPass)) {
                    Authentication::loadProfile($usr->id);
                }
                else {
                    $connexionOK = false;
                }
            }
            else {
                $connexionOK = false;
            }
        }
        return $connexionOK;
    }

    /**
     * Destroy any left-over session, and start a new one.
     * @param $id : The newly-logged user.
     * Store the user_id, so it can be used in the other parts
     * of our website
     **/
    public static function loadProfile($id) {
        session_destroy();
        session_start();
        $_SESSION['user_id'] = $id;
    }

    /**
     * Function used to register new users
     * @param $username : the username choosed by the user
     * @param $password : his password
     * @param $password_confirm : to check if he typed the password correctly
     * @param $email : his email
     * If the whole process go through correctly, a new user is saved in the DB.
     */
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
                        // Creating a random salt, 10 char longs (a-zA-Z0-9)
                        $factory = new Factory;
                        $generator = $factory->getLowStrengthGenerator();
                        $salt = $generator->generateString(10);
                        
                        // Hashing the password
                        $saltedPass=$password.$salt;
                        $hashedPass=password_hash($saltedPass, PASSWORD_DEFAULT);
                        
                        $newUser = new Users;
                        $newUser->email=$email;
                        $newUser->name=$username;
                        $newUser->password=$hashedPass;
                        $newUser->salt=$salt;
                        $newUser->save();
                    }
                }
            }
        }
        return $inscOk;
    }

    /**
     * Function used when a user want to update his password
     * @param $userId : The id of the user logged in, who wants to update his password
     * @param $triedPass : His input when asked to confirm what his current password is
     *
     * @return 1 if the operation is a success, 0 if triedPass isn't the excepted password,
     * -1 if the user has no password stored in the DB
     */
    public static function verifyPassword($userId, $triedPass) {
        $pass = Users::select('password','salt')
                ->find($userId)
                ->toArray();
        $res = 0;

        if (filter_var($triedPass,FILTER_SANITIZE_STRING) !== $triedPass) {
            $res = 0;
        }
        else {
            if (isset($pass)) {
                $hashedPass = $pass['password'];
                $salt = $pass['salt'];
                $saltedPass = $triedPass.$salt;

                if (password_verify($saltedPass,$hashedPass)) {
                    $res = 1;
                } 
                else $res = 0;
            }
            else {
                // This shouldn't be the case, and means our system is flawed
                $res = -1;
            }
        }
        return $res;
    }

    /**
    * Function called once we saw that the user know his own password, and
    * is therefore clear to change it.
    * @param $userId: The id of the user logged in, who wants to update his password
    * @param $newPass: The new password he wants to use (who must follow our secutiry policy)
    */
    public static function updatePassword($userId, $newPass) {
        if (filter_var($newPass,FILTER_SANITIZE_STRING) === $newPass) {

            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $newPass)) {
                    echo "The password should be 8 letters long, contain a lowercase and a uppercase letter";
                    $inscOk = false;
                }
            else {
                $usr=Users::find($userId);
                $salt=$usr->salt;
                $newSaltedPass=$newPass.$salt;
                $usr->password = password_hash($newSaltedPass, PASSWORD_DEFAULT);
                $usr->save();
            }

        }
    }

}
?>
