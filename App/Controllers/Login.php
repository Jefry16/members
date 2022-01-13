<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Login extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function newAction()
    {
        View::renderTemplate('Login/index.html');
    }


    public function createAction()
    {
        $user = User::findByEmail($_POST['email']);
        var_dump($user);
    }

   
}
