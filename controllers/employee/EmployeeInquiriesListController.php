<?php

namespace app\controllers\employee;

use app\core\Request;
use app\models\InquiriesListModel;
use app\models\InquiryModel;
use app\stores\EmployeeStore;

class EmployeeInquiriesListController extends MasterCRUDController
{
    public function load(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_g_usr = $this->getEntityFlag($request);
        $store->flag_g_act = $this->getActionFlag($request);

        $report = InquiryModel::getByID($store->flag_g_usr);

        // checking whether there is a direct action to be performed
        switch ($store->flag_g_act) {
            case 'seen':
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
                return;
            case 'accept':
                $report->resolve();
                $store->setNotification('Inquiry accepted!', 'Inquiry' . $store->flag_g_usr . ' is accepted!', 'success');
                header('Location: /employee/inquiries');
                return; // Return to stop further execution
            default:
                $this -> render("employee/inquiries.php");
                break;
        }
    }

    public function getAllReports(): array
    {
        $model = new InquiriesListModel();
        // creating an array of all reports
        return $model->getAllReports();
    }
}