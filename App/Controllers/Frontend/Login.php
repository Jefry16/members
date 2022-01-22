<?php

namespace App\Controllers\Frontend;

use App\Config;
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

    public function createAction()
    {

        $this->redirectIfNotRequestMethod('POST', '/');

        $user = User::authenticate($_POST['email'], $_POST['password']);
        $rememberMe = isset($_POST['rememberMe']);

        if ($user) {
            Auth::login($user, $rememberMe, $user->type . '_id');

            $this->redirect(Auth::getLastPage());
        } else {
            Flashmessage::set('Wrong credentials', Flashmessage::FAIL);

            View::renderTemplate('Frontend/Statico/login.html', [
                'email' => $_POST['email'],
                'rememberMe' => $rememberMe
            ]);
        }
    }

    public function destroyAction()
    {
        Auth::logout();
        $this->redirect('/login/show-log-out-message');
    }

    public function showLogOutMessageAction()
    {
        Flashmessage::set('See you soon');
        $this->redirect('/');
    }
}
