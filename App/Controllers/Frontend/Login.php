<?php

namespace App\Controllers\Frontend;

use App\Models\Login as ModelsLogin;
use \Core\View;
use \App\Models\User;
use \App\Modules\Auth;
use App\Modules\Flashmessage;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Login extends \Core\Controller
{
    public function newAction()
    {
        $this->redirectWhenUserLoggedIn('/');
        View::renderTemplate('Login/index.html');
    }

    public function createAction()
    {
        $this->redirectIfNotRequestMethod('POST', '/');

        $user = User::authenticate($_POST['email'], $_POST['password']);

        $rememberMe = isset($_POST['remember_me']);

        if ($user) {
            Auth::login($user, $rememberMe);

            $this->redirect(Auth::getLastPage());
        } else {
            Flashmessage::set('Wrong credentials', Flashmessage::FAIL);

            View::renderTemplate('Login/index.html', [
                'email' => $_POST['email'],
                'remember_me' => $rememberMe
            ]);
        }
    }

    public function destroyAction()
    {
        Auth::logout();

        $this->redirect('/login/showLogOutMessage');
    }

    public function showLogOutMessageAction()
    {
        Flashmessage::set('See you soon');
        $this->redirect('/');
    }
}
