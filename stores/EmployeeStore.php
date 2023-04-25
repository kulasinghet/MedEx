<?php

namespace app\stores;

use app\models\EmployeeModel;
use Exception;

class EmployeeStore
{
    public string $approval_flag;
    public string $username;

    /**
     * @throws Exception
     */
    private final function __construct()
    {
        $this->approval_flag = '';

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