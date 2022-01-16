<?php

namespace App\Controllers\Admin;

use App\Models\Category;

use App\Models\Post;
use App\Modules\Flashmessage;

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
            'posts' => Post::getAll(),
            'categories' => Category::getAll()
        ]);
    }

    public function nuevoAction()
    {
        View::renderTemplate('Admin/blog-new.html', [
            'categories' => Category::getAll()
        ]);

    }

    public function saveAction()
    {
        $post = new Post($_POST);

        var_dump($post);
    }

    public function addCategoryAction()
    {
        $category = new Category($_POST);
        if($category->save()){
            Flashmessage::set('La categoría fue añadida', 'alert alert-success');
        }else{
            Flashmessage::set('La categoría no pudo ser añadida', 'alert alert-warning');
            if ($category->errors) {
                foreach($category->errors as $e){
                    Flashmessage::set($e, 'alert alert-warning');
                }
            }
        }
        $this->redirect('/ccb/admin/blog');
    }
}
