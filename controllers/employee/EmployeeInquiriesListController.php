<?php

namespace app\controllers\employee;

use app\core\EmailServer;
use app\core\Request;
use app\models\EmployeeInquiriesListModel;
use app\models\InquiryModel;
use app\models\LoginModel;
use app\stores\EmployeeStore;
use PHPMailer\PHPMailer\Exception;

class EmployeeInquiriesListController extends MasterCRUDController
{
    /**
     * @throws Exception
     */
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

                // sending the email
                $email = new EmailServer();
                $result = $email->sendEmail((new LoginModel())->getUserEmail($report->username), "Inquiry update", "Your inquiry (".$report->inquiry_id.") is accepted by staff.");

                if ($result) {
                    $store->setNotification('An email has been sent', $report->username . ' will receive an email about the verification.', 'success');
                } else {
                    $store->setNotification('Couldn\'t send an email', $report->username . ' won\'t receive an email about the verification.', 'error');
                }

                echo json_encode(array(
                    'username' => $store->username,
                    'inquiry_id' => $store->flag_g_usr,
                    'success' => true
                ));
                return; // Return to stop further execution
            default:
                $this -> render("employee/inquiries.php");
                break;
        }
    }

    public function getAllReports(): array
    {
        $model = new EmployeeInquiriesListModel();
        // creating an array of all reports
        return $model->getAllReports();
    }
}