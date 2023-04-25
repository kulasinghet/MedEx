<?php

namespace app\models\HyperEntities;

use app\models\Model;

abstract class HyperEntityModel extends Model
{
    public string $username;
    public string $name;
    public string $email;
    public string $address;
    public string $mobile;

    abstract public static function getByUsername(string $username) : ?self;
    abstract public function verify(?bool $action) : bool;
}