<?php

namespace app\models;
use app\core\Database;
use app\core\ExceptionHandler;
use app\core\Logger;

class InvalidEntityModel extends Model
{
    public string $username;
    public string $name;
    public bool $verified;
    public string $email;
    public string $address;
    public string $mobile;

    public function __construct($params = array()) {
        foreach ($params as $key => $value) {
            $this->{$key} = $value;
        }

        $this->verified = false;
    }
}