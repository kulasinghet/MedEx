<?php

namespace app\stores;

use app\models\EmployeeModel;
use app\models\HyperEntities\HyperDeliveryModel;
use app\models\HyperEntities\HyperEntityModel;
use app\models\HyperEntities\HyperLabModel;
use app\models\HyperEntities\HyperPharmacyModel;
use app\models\HyperEntities\HyperSupplierModel;
use Exception;

class EmployeeStore
{
    public string $username;

    // general page variables
    public string $flag_g_t;
    public int $flag_g_st;
    public array $list_g;

    // approve-one page variables
    public string $flag_aprv_one_usr;
    public string $flag_aprv_one_act;
    public HyperPharmacyModel|HyperDeliveryModel|HyperLabModel|HyperSupplierModel|null $aprv_one_obj;

    /**
     * @throws Exception
     */
    private final function __construct()
    {
        $this->list_g = [];
        $this->flag_g_t = '';
        $this->flag_g_st = 0;
        $this->flag_aprv_one_usr = '';
        $this->flag_aprv_one_act = '';
        $this->aprv_one_obj = null;

        // retrieve user details from session
        if (isset($_SESSION['username'])) {
            $this->username = $_SESSION['username'];
        } else {
            throw new Exception('Username not set in session');
        }
    }

    public static function getEmployeeStore() {
        if (!isset($_SESSION['employee_store'])) {
            $_SESSION['employee_store'] = new EmployeeStore();
        }

        return $_SESSION['employee_store'];
    }

    /**
     * @throws Exception
     */
    public function getUser(): ?EmployeeModel
    {
        if (isset($this->username)) {
            return EmployeeModel::getByUsername($this->username);
        } else {
            throw new Exception('Username not set in session');
        }
    }
}