<?php

namespace App\Modules;

use App\Models\Category;

class Globaldata
{
    public static function categoryAndPost()
    {
        return Category::getAllWithPostCounted();
    }
}
