<?php

namespace app\models\InvalidEntity;

use app\models\Model;

abstract class InvalidEntityModel extends Model
{
    public string $username;
    public string $name;
    public string $email;
    public string $address;
    public string $mobile;

    abstract public function verify() : bool;
    abstract public function destroy();
}