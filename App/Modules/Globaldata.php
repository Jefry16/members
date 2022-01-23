<?php

namespace App\Modules;

use App\Models\Category;

class Globaldata
{
    public static function categoryAndPost()
    {
        return Category::getAllWithPostCounted();
    }

    private static function create_slug($string){
        $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($string));
        return $slug;
     }
}
