<?php

namespace app\models;
use app\core\Database;
use app\core\ExceptionHandler;
use app\core\Logger;

class InvalidLabModel extends InvalidEntityModel
{
    public string $business_reg_id;
    public string $business_cert_name;
    public string $lab_cert_id;
    public string $lab_cert_name;
    public string $reg_date;

    public function __construct($params = array()) {
        parent::__construct();

        foreach ($params as $key => $value) {
            $this->{$key} = $value;
        }
    }
}