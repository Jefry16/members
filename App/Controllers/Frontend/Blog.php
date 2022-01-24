<?php

namespace App\Controllers\Frontend;

use \Core\View;
use \App\Models\User;

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


    public function viewAction()
    {
        Blog::
        View::renderTemplate('Frontend/Statico/post-view.html');

    }
}
