<?php

namespace App\Models;

use PDO;
use App\Modules\Token;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Category extends \Core\Model
{
    public $errors = [];

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function getAllWithPostCounted()
    {
        $db = static::getDB();
        $stmt = $db->query(
            ' SELECT category, COUNT(pages.id) as total FROM categories
            LEFT JOIN pages ON  categories.id = pages.categories_id
            GROUP by category;'
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
