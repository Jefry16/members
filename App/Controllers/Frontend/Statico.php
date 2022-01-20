<?php

namespace App\Controllers\Frontend;

use \Core\View;
use \App\Models\User;
use \App\Modules\Auth;

class Statico extends \Core\Controller
{
    public function indexAction()
    {
        $this->redirect('/');
    }

    public function aboutAction()
    {
        View::renderTemplate('Frontend/Statico/about.html');
    }

    public function contactAction()
    {
        View::renderTemplate('Frontend/Statico/contact.html');
    }

    public function registerAction()
    {
        View::renderTemplate('Frontend/Statico/register.html');
    }
}
