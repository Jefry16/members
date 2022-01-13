<?php

namespace App\Modules;

use App\Models\User;

/**
 * Ajax controller
 *
 * PHP version 7.0
 */
class Flashmessage 
{

    public static function set($message) 
    {
        if ( !isset($_SESSION['flash_notification']) ) {
            $_SESSION['flash_notification'] = [];
        }
        $_SESSION['flash_notification'][] = $message;
    }

    public static function get()
    {
        if(isset($_SESSION['flash_notification'])) {
            $message = $_SESSION['flash_notification'];
            unset($_SESSION['flash_notification']);
            return $message;
        }
    }
}