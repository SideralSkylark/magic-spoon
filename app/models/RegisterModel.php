<?php

namespace app\models;
use app\core\Model;

class RegisterModel extends Model{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;


    public function validate() {

    }

    public function register() {

    }
}