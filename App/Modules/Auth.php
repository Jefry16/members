<?php

namespace App\Modules;



/**
 * Ajax controller
 *
 * PHP version 7.0
 */
class Auth 
{
    public static function login($user)
    {

        $_SESSION['user_id'] = $user->id;
        
        session_regenerate_id(true);
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

    public static function isLoggedIn()
    {

        return isset($_SESSION['user_id']);

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
