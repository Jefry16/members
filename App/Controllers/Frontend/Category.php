<?php

namespace App\Controllers\Frontend;

use App\Models\Post;
use Core\View;

/**
 * Ajax controller
 *
 * PHP version 7.0
 */
class Category extends \Core\Controller
{
    public function viewAction()
    {
        $slug = $this->route_params['category'];
        $title = ucfirst(implode(' ', explode('-', $slug)));
        $posts = Post::getAllByCategory($slug);
        View::renderTemplate('Frontend/Category/index.html', [
            'posts' => $posts,
            'title' => $title
        ]);
    }
}
