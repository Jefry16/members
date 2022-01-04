<?php

namespace App\Models;

use PDO;
use Faker;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Post extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT id, name FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function testData(){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO post (title, content, topics) values('one', 'v', 'd')");
        $stmt->execute();
    }
}
