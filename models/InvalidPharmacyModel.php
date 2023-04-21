<?php

namespace app\models;
use app\core\Database;
use app\core\ExceptionHandler;
use app\core\Logger;

class InvalidPharmacyModel extends InvalidEntityModel
{
    public string $ownerName;
    public string $city;
    public string $phar_reg_no;
    public string $business_reg_id;
    public string $business_cert_name;
    public string $phar_cert_id;
    public string $phar_cert_name;
    public string $delivery_time;

    public function __construct($params = array()) {
        parent::__construct();

        foreach ($params as $key => $value) {
            $this->{$key} = $value;
        }
    }
}