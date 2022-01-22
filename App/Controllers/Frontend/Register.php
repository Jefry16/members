<?php

namespace App\Controllers\Frontend;

use \Core\View;
use \App\Models\User;

class Register extends \Core\Controller
{
    public function indexAction()
    {
        View::renderTemplate('Login/index.html');
    }

    public function newAction()
    {
        $this->redirectIfNotRequestMethod('POST', '/register');
        $user = new User($_POST);
        if ($user->save()) {
            $this->redirect('/register/thank-you');
        } else {
            View::renderTemplate('Frontend/Statico/register.html', [
                'errors' => $user->errors,
                'firstName' => $_POST['firstName'],
                'lastName' => $_POST['lastName'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
            ]);
        }
    }

    public function thankyouAction()
    {
        View::renderTemplate('Frontend/Statico/thanks.html');
    }
}
