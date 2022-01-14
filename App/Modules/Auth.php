<?php

namespace App\Modules;

use App\Models\Login;
use App\Models\User;

/**
 * Ajax controller
 *
 * PHP version 7.0
 */
class Auth 
{
    public static function login($user, $rememberLogin)
    {

        $_SESSION['user_id'] = $user->id;
        
        session_regenerate_id(true);

        if ($rememberLogin) {

            if ($user->rememberLogin()) {
                setcookie('remember_me', $user->token_value, $user->expiry_timestamp, '/');
            };
        }

        Flashmessage::set('Welcome');
    }

    public static function logout()
    {
        $_SESSION = array();

            if (ini_get("session.use_cookies")) {

                $params = session_get_cookie_params();

                setcookie(session_name(), '', time() - 42000,

                $params["path"], $params["domain"],

                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }



    public static function getCurrentLoggedInUser()
    {
       if (isset($_SESSION['user_id'])) {

        return User::findById($_SESSION['user_id']);

       } else {

           $cookie_for_login = $_COOKIE['remember_me'] ?? false;
           
           $login_data = Login::getLoginFronCookie($cookie_for_login);

           if($login_data) {
               
               $_SESSION['user_id'] = $login_data->user_id;
           }
       }
    }

    public static function setLastPage()
    {
        $_SESSION['last_page'] = $_SERVER['REQUEST_URI'];
    }

    public static function getLastPage()
    {
        return $_SESSION['last_page'] ?? '/';
    }

}
