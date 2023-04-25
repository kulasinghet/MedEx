<?php

namespace app\stores;

use app\models\EmployeeModel;
use app\models\HyperEntities\HyperEntityModel;
use Exception;

class EmployeeStore
{
    public string $username;
    //public $controller; // TODO: remove this
    // approval page variables
    public string $flag_aprv_t;
    public int $flag_aprv_st;
    public array $aprv_list;
    // approve-one page variables
    public string $flag_aprv_one_usr;
    public string $flag_aprv_one_act;
    public ?HyperEntityModel $aprv_one_obj;

    /**
     * @throws Exception
     */
    private final function __construct()
    {
        $this->aprv_list = [];
        $this->flag_aprv_t = '';
        $this->flag_aprv_st = 0;
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