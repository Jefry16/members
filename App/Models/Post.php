<?php

namespace App\Models;

use PDO;
use App\Modules\Token;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Post extends \Core\Model
{
    public static function getAllByCategory($slug)
    {
        $db = static::getDB();
        $stmt = $db->prepare(' SELECT title, description, category FROM pages INNER JOIN categories ON pages.categories_id = categories.id WHERE slug = :slug');

        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Post');

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
