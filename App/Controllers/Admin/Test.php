<?php

namespace App\Controllers\Admin;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Test extends \Core\Controller
{
    protected function before()
    {
        //Make sure an admin is logged in
        $this->redirectIfNotLoggedInUser();
    }

    public function indexAction()
    {
    }
}
