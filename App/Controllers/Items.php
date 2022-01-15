<?php

namespace App\Controllers;

use App\Modules\Auth;


class Items extends \Core\Controller
{

    public function indexAction()
    {
        $this->redirectIfNotLoggedInUser();
        echo 'You are auth';
    }

}
