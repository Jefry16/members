<?php

namespace App\Controllers;

use App\Modules\Auth;


class Items extends \Core\Controller
{

    public function indexAction()
    {
        if (!Auth::isLoggedIn()) {

            Auth::setLastPage();
            
            $this->redirect('/login');
        }
        echo 'You are auth';
    }

}
