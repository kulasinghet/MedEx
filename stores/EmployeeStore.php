<?php

namespace app\stores;

class EmployeeStore
{
    public string $approval_flag;
    public string $username;

    private final function __construct()
    {
        $this->approval_flag = '';
        $this->username = $_SESSION['username'];
    }

    public static function getEmployeeStore() {
        if ($_SESSION['employee_store'] == null) {
            $_SESSION['employee_store'] = new EmployeeStore();
        }

        return $_SESSION['employee_store'];
    }
}