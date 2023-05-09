<?php

namespace app\controllers\employee;

use app\core\Controller;
use app\core\Request;
use app\models\EmployeeDashboardModel;

class EmployeeDashboardController extends Controller
{
    public function getCounters(): array
    {
        $model = new EmployeeDashboardModel();
        return $model->readCounters();
    }

    public function getDailyRevenue(Request $request): void
    {
        $model = new EmployeeDashboardModel();

        header('Content-Type: application/json');
        echo json_encode($model->selectDailyRevenue());
    }

    public  function getPharmacyOrders(): array
    {
        $model = new EmployeeDashboardModel();
        return $model->selectPharmacyOrders();
    }
}