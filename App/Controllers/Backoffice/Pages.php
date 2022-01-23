<?php

namespace App\Controllers\Backoffice;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Pages extends \Core\Controller
{
    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $this->redirectIfNotAdmin();

        View::renderTemplate('Frontend/Home/index.html');
    }
}
