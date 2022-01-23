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
     
    public function before()
    {
        
        $this->redirectIfNotAdmin();
    }
    public function indexAction()
    {

        echo 'index';
    }

    public function addAction()
    {
        View::renderTemplate('Backend/Statico/add-page.html');
    }
}
