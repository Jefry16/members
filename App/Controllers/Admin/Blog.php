<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Blog extends \Core\Controller
{
    protected function before()
    {
        //Make sure an admin is logged in
        $this->redirectIfNotLoggedInUser();
    }

    public function indexAction()
    {
        View::renderTemplate('Admin/blog.html', [
            'posts' => Post::getAll()
        ]);
    }

    public function nuevoAction()
    {
        View::renderTemplate('Admin/blog-new.html');
    }

    public function saveAction()
    {
        $post = new Post($_POST);

        $post->save();

    }
}
