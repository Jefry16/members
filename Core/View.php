<?php

namespace Core;

use App\Config;

/**
 * View
 *
 * PHP version 7.0
 */
class View
{

    /**
     * Render a view file
     *
     * @param string $view  The view file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "/App/Views/$view";  // relative to Core directory

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    /**
     * Render a view template using Twig
     *
     * @param string $template  The template file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/App/Views');
            $twig = new \Twig\Environment($loader);
            $twig->addGlobal('currentMember', \App\Modules\Auth::getCurrentLoggedInUser(Config::$member_type));
            $twig->addGlobal('currentAdmin', \App\Modules\Auth::getCurrentLoggedInUser(Config::$admin_type));


            //$twig->addGlobal('currentAdmin', \App\Modules\Auth::getCurrentLoggedInUser('admin_id'));
            $twig->addGlobal('categories', \App\Modules\Globaldata::categoryAndPost());


            $twig->addGlobal('flash_notification', \App\Modules\Flashmessage::get());
            
        }
        echo $twig->render($template, $args);
    }
}
