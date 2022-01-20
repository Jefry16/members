<?php

namespace App\Controllers\Frontend;

use \Core\View;
use \App\Models\User;
use \App\Modules\Auth;

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
        $this->redirectWhenUserLoggedIn('/');
        View::renderTemplate('Signup/index.html');
    }

    public function createAction()
    {
        $this->redirectIfNotRequestMethod('POST', '/');

        $user = new User($_POST);

        if ($user->save()) {
            $this->redirect('/signup/success');
        } else {
            View::renderTemplate('Signup/index.html', ['user' => $user]);
        }
    }

    public function successAction()
    {
        View::renderTemplate('Signup/success.html');
    }
}
