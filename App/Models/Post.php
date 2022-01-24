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
    public $errors = [];

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function save()
    {


        if (empty($this->errors)) {
            $sql = 'INSERT INTO pages ()VALUES()';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':un', $this->username, PDO::PARAM_STR);
            
            return $stmt->execute();

        }
        return false;
    }


    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT *  FROM pages');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllByCategory($slug)
    {
        $db = static::getDB();
        $stmt = $db->prepare(' SELECT title, description, category FROM pages INNER JOIN categories ON pages.categories_id = categories.id WHERE slug = :slug');

        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Post');

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function validateTitle($title){
        if(trim($title) == ''){
            $this->errors['title'] = 'Title can\' be empty';
            return;
        }

        if(strlen($title) > 100) {
            $this->errors['title'] = 'The length of the title cannot be longer than 100 characters';
            return;
        }
    }

    private function validateCategory()
    {

    }

    public static function updater($id, $slug)
    {
        $sql = "UPDATE pages SET slug = :slug WHERE id = :id";
            $db = static::getDB();

            $stmt = $db->prepare($sql);
            $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

             $stmt->execute();
    }
}
