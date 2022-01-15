<?php

namespace App\Controllers\Admin;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Precios extends \Core\Controller
{
    protected function before()
    {
        //Make sure an admin is logged in
        $this->redirectIfNotLoggedInUser();
    }

    public function indexAction()
    {
        View::renderTemplate('Admin/precios.html');
    }
}
