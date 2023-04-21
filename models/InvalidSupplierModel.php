<?php

namespace app\models;
use app\core\Database;
use app\core\ExceptionHandler;
use app\core\Logger;

class InvalidSupplierModel extends InvalidEntityModel
{
    public string $supp_reg_no;
    public string $business_reg_id;
    public string $business_cert_name;
    public string $supp_cert_id;
    public string $supp_cert_name;
    public string $reg_date;

    public function __construct($params = array()) {
        parent::__construct();

        foreach ($params as $key => $value) {
            $this->{$key} = $value;
        }
    }
}