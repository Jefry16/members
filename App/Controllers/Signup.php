<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Signup extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Signup/index.html');
    }

    public function createAction()
    {
        $user = new User($_POST);
        if($user->save()){

            View::renderTemplate('Signup/success.html');
        }else{
            View::renderTemplate('Signup/index.html', ['user' => $user]);
        }

    }
}
