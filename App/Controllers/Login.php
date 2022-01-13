<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Modules\Auth;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Login extends \Core\Controller
{

   
    public function newAction()
    {
        View::renderTemplate('Login/index.html');
    }


    public function createAction()
    {
        $this->redirectIfNotRequestMethod('POST', '/');

        $user = User::authenticate($_POST['email'], $_POST['password']);

       if ($user) {
           Auth::login($user);
           $this->redirect('/');
       } else {
        View::renderTemplate('Login/index.html', [
            'email' => $_POST['email'],
        ]);
       }
    }

    public function destroyAction()
    {
        Auth::logout();
        $this->redirect('/');
    }
}
