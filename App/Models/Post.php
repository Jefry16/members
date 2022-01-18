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
            $sql = 'INSERT INTO post (title, content, thumbnail, status, category, tags) VALUES(:title, :content, :thumbnail, :status, :category, :tags)';
            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
            $stmt->bindValue(':thumbnail', $this->thumbnail, PDO::PARAM_STR);
            $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);
            $stmt->bindValue(':category', $this->category, PDO::PARAM_STR);
            $stmt->bindValue(':tags', $this->tags, PDO::PARAM_STR);

            return $stmt->execute();
        }
        return false;
    }

    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT post.id, title, post.created_at, name, status, category FROM post INNER JOIN category ON post.id = category.id');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function validate($username, $email, $password)
    {
    }

    private function validateTitle($title)
    {
        if (empty($title)) {
            $this->errors[] = 'El titulo no puede estar vacío';
        }

        if (strlen($title) > 255) {
            $this->errors[] = 'El titulo no puede contener más de 255 caracteres';
        }
    }

    private function validateContent($content)
    {
        if (empty($content)) {
            $content = 'Sin contenido';
        }
    }
}
