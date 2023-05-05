<?php

namespace app\controllers\employee;

use app\core\Controller;
use app\core\Request;
use app\models\ReportListModel;
use app\stores\EmployeeStore;

class EmployeeReportListController extends Controller
{
    const login = 'Location: /login';

    private function validate(): void
    {
        // checking whether the user is logged into the server
        if ($_SESSION['userType'] != 'staff') {
            header(self::login);
        }
    }

    public function load(Request $request): void
    {
        $this->validate();

        if ($request->isGet()) {
            if ($_SESSION['userType'] == 'staff') {
                $this -> render("employee/reports.php");
            } else {
                header(self::login);
            }
        } else {
            header(self::login);
        }
    }

    public function getAllReports(): array
    {
        $model = new ReportListModel();
        // creating an array of all reports
        return $model->getAllReports();
    }

    public function sortBySeen($list): array
    {
        $seen = array();
        $unseen = array();
        foreach ($list as $report) {
            if ($report->is_employee_noticed) {
                $seen[] = $report;
            } else {
                $unseen[] = $report;
            }
        }
        return array_merge($seen, $unseen);
    }
}