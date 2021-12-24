<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Blog extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Blog/index.html');
    }

    public function categoriasAction()
    {
        View::renderTemplate('Blog/cathegories.html');
    }
}
