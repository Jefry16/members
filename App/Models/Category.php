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

    public function save()
    {
        $this->validateCategoryName($_POST['name']);

        if (empty($this->errors)) {
            $sql = 'INSERT INTO category (name) VALUES(:name)';
            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);

            return $stmt->execute();
        }
        return false;
    }

    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT id, name FROM category');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function validateCategoryName($name)
    {
        if (trim($name) == '') {
            $this->errors[] = 'Necesitas un nombre para la categoría';
        }

        if ($this->findByName($name)) {
            $this->errors[] = 'La categoría existe ya';
        }
    }

    public static function findByName($name)
    {
        $sql = 'SELECT name from category WHERE name = :name';
        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\User');
        $stmt->execute();

        return $stmt->fetch();
    }
}
