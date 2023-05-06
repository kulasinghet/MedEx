<?php

namespace app\controllers\employee;

use app\core\Request;
use app\models\ReportListModel;
use app\models\ReportModel;
use app\stores\EmployeeStore;

class EmployeeReportListController extends MasterCRUDController
{
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

    public function reportIsSeen(Request $request): void
    {
        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_g_usr = $this->getEntityFlag($request);

        $report = ReportModel::getByID($store->flag_g_usr);

        if ($report && $report->seenBy($store->username)) {
            echo json_encode(array(
                'username' => $store->username,
                'inquiry_id' => $store->flag_g_usr,
                'success' => true
            ));
            return; // Return to stop further execution
        }

        // operation failed
        echo json_encode(['success' => false]);
    }
}