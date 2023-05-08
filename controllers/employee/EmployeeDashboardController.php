<?php

namespace app\controllers\employee;

use app\core\Controller;
use app\core\Request;
use app\models\EmployeeDashboardModel;
use app\models\EmployeeModel;

class EmployeeDashboardController extends MasterCRUDController
{
    public function getCounters(): array
    {
        $this->validate();

        $model = new EmployeeDashboardModel();
        return $model->readCounters();
    }
}