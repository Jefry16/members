<?php

namespace App\Models;

use PDO;
use App\Modules\Token;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Login extends \Core\Model
{

    public static function getLoginFronCookie($cookie)
    {
        $token = new Token($cookie);
        $sql = 'SELECT user_id, expires_at from remembered_logins WHERE token_hash = :cookie';

        
        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':cookie', $token->getHash(), PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\User');
        
        $stmt->execute();

        return $stmt->fetch();
    }


    public static function deleteLoginFromCookie($cookie)
    {
        $token = new Token($cookie);
        $sql = 'DELETE from remembered_logins WHERE token_hash = :HASH';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':HASH', $token->getHash(), PDO::PARAM_STR);

        $stmt->execute();
    }

}
