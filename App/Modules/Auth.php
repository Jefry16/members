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
    public static function login($user, $rememberLogin, $userType)
    {
        $_SESSION[$userType] = $user->id;



        session_regenerate_id(true);

        if ($rememberLogin) {
            if ($user->rememberLogin()) {
                setcookie('remember_me', $user->token_value, $user->expiry_timestamp, '/');
            };
        }
        Flashmessage::set('Welcome back!', Flashmessage::SUCCESS);

    }

    public static function logout()
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }
        session_destroy();

        static::deleteLogin();

    }

    public static function getCurrentLoggedInUser($userType)
    {
        if (isset($_SESSION[$userType])) {
            return User::findById($_SESSION[$userType]);
        } else {
            $cookie_for_login = $_COOKIE['remember_me'] ?? false;

            $login_data = Login::getLoginFronCookie($cookie_for_login);

            if (is_object($login_data) && strtotime($login_data->expires_at) > time()) {
                $_SESSION[$userType] = $login_data->user_id;

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

    public static function deleteLogin()
    {
        $auth_cookie = $_COOKIE['remember_me'] ?? false;
        if ($auth_cookie) {
            Login::deleteLoginFromCookie($auth_cookie);
            setcookie('remember_me', '', time() - 36000);

        }
    }
}
