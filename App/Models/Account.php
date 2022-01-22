<?php

namespace App\Models;

use App\Config;
use PDO;
use App\Modules\Token;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Account extends \Core\Model
{
    public $errors = [];

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function findById()
    {
        return User::findById($_SESSION[Config::$member_type]);
    }

    private function validateNewPassword($password)
    {
        if (strlen($password) < 6) {
            $this->errors['password'] = 'Password length must be 6 caracters at least';
        }
    }

    public function save()
    {
        $this->validateNewPassword($_POST['npassword']);

        if (empty($this->errors)) {
            $id = $_SESSION[Config::$member_type];
            $hashed_password = password_hash($_POST['npassword'], PASSWORD_DEFAULT);

            $sql = "UPDATE users SET pass = :pass WHERE id = $id";
            $db = static::getDB();

            $stmt = $db->prepare($sql);
            $stmt->bindValue(':pass', $hashed_password, PDO::PARAM_STR);

            return $stmt->execute();
        }
        return false;
    }
}
