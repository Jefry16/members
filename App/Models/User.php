<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class User extends \Core\Model
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
        $this->validate($this->username, $this->email, $this->password);

        if(empty($this->errors)){
            $password_hashed = password_hash($this->password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password) VALUES(:username, :email, :password)";
            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $password_hashed, PDO::PARAM_STR);

            return $stmt->execute();
        }
        return false;
    }
    
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT id, name FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function validate($username, $email, $password)
    {
        $this->validateUsername($username);
        $this->validateEmail($email);
        $this->validatePassword($password);
    }

    private function validateUsername($username)
    {
        if ($username == '') {

            $this->errors[] = 'Name is required';
            
        }
    }


    private function validateEmail($email)
    {
        if ($email == '') {

            $this->errors[] = 'Email is required';
            
            return;
        }

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {

            $this->errors[] = 'Email is invalid';
           
            return;
        }

        if ($this->emailExist($email)) {

            $this->errors[] = 'Email is in used already';
        }
    }

    private function validatePassword($password)
    {
        if ($password == '') {

            $this->errors[] = 'Password is required';
            
            return;
        }

        if (strlen($password) < 6) {

            $this->errors[] = 'Password length must be 6 caracters at least';
        }
    }

    public static function emailExist($email)
    {
        return static::findByEmail($email) !== false;
    }

    public static function findByEmail($email)
    {
        $sql = "SELECT email, password, id from users WHERE email = :email";
        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\User');
        $stmt->execute();

        return $stmt->fetch();
    }

    public static function authenticate($email, $password)
    {
        $user = static::findByEmail($email);

        if ($user && password_verify($password, $user->password)) {
            
            return $user;

        }

        return false;
    }

    public static function findById($id)
    {
        $sql = "SELECT username from users WHERE id = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\App\Models\User');
        $stmt->execute();

        return $stmt->fetch();
    }
}
