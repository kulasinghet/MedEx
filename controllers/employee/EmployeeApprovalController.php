<?php

namespace app\controllers\employee;

use app\core\EmailServer;
use app\core\Request;
use app\models\HyperEntities\HyperDeliveryModel;
use app\models\HyperEntities\HyperLabModel;
use app\models\HyperEntities\HyperPharmacyModel;
use app\models\HyperEntities\HyperSupplierModel;
use app\stores\EmployeeStore;
use PHPMailer\PHPMailer\Exception;

class EmployeeApprovalController extends MasterCRUDController
{
    /**
     * @throws Exception
     */
    public function loadPharmacy(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_g_usr = $this->getEntityFlag($request);
        $store->flag_g_act = $this->getActionFlag($request);

        $obj = HyperPharmacyModel::getByUsername($store->flag_g_usr);
        if ($obj) {
            // checking whether there is a direct action to be performed
            switch ($store->flag_g_act) {
                case 'approve':
                    $obj->verify(true);

                    // sending the email
                    $email = new EmailServer();
                    $result = $email->sendEmail($obj->email, "Account Verification", "Your Medex account is verified by staff!");

                    if ($result) {
                        $store->setNotification('An email has been sent', $obj->username . ' will receive an email about the verification.', 'success');
                    } else {
                        $store->setNotification('Couldn\'t send an email', $obj->username . ' won\'t receive an email about the verification.', 'error');
                    }

                    header('Location: /employee/approve');
                    break;
                case 'ignore':
                    $obj->verify(null);

                    // sending the email
                    $email = new EmailServer();
                    $result = $email->sendEmail($obj->email, "Account Verification", "Your Medex account is rejected by staff!");

                    if ($result) {
                        $store->setNotification('An email has been sent', $obj->username . ' will receive an email about the verification.', 'success');
                    } else {
                        $store->setNotification('Couldn\'t send an email', $obj->username . ' won\'t receive an email about the verification.', 'error');
                    }

                    header('Location: /employee/approve');
                    break;
                default:
                    // loading the approval details page
                    $store->g_obj = $obj;
                    $this -> render("employee/approvals/pharmacy.php");
                    break;
            }
        } else {
            header('Location: /employee/approve');
        }
    }

    /**
     * @throws Exception
     */
    public function loadSupplier(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_g_usr = $this->getEntityFlag($request);
        $store->flag_g_act = $this->getActionFlag($request);

        $obj = HyperSupplierModel::getByUsername($store->flag_g_usr);
        if ($obj) {
            // checking whether there is a direct action to be performed
            switch ($store->flag_g_act) {
                case 'approve':
                    $obj->verify(true);

                    // sending the email
                    $email = new EmailServer();
                    $result = $email->sendEmail($obj->email, "Account Verification", "Your Medex account is verified by staff!");

                    if ($result) {
                        $store->setNotification('An email has been sent', $obj->username . ' will receive an email about the verification.', 'success');
                    } else {
                        $store->setNotification('Couldn\'t send an email', $obj->username . ' won\'t receive an email about the verification.', 'error');
                    }

                    header('Location: /employee/approve');
                    break;
                case 'ignore':
                    $obj->verify(null);

                    // sending the email
                    $email = new EmailServer();
                    $result = $email->sendEmail($obj->email, "Account Verification", "Your Medex account is rejected by staff!");

                    if ($result) {
                        $store->setNotification('An email has been sent', $obj->username . ' will receive an email about the verification.', 'success');
                    } else {
                        $store->setNotification('Couldn\'t send an email', $obj->username . ' won\'t receive an email about the verification.', 'error');
                    }

                    header('Location: /employee/approve');
                    break;
                default:
                    // loading the approval details page
                    $store->g_obj = $obj;
                    $this -> render("employee/approvals/supplier.php");
                    break;
            }
        } else {
            header('Location: /employee/approve');
        }
    }

    /**
     * @throws Exception
     */
    public function loadDelivery(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_g_usr = $this->getEntityFlag($request);
        $store->flag_g_act = $this->getActionFlag($request);

        $obj = HyperDeliveryModel::getByUsername($store->flag_g_usr);
        if ($obj) {
            // checking whether there is a direct action to be performed
            switch ($store->flag_g_act) {
                case 'approve':
                    $obj->verify(true);

                    // sending the email
                    $email = new EmailServer();
                    $result = $email->sendEmail($obj->email, "Account Verification", "Your Medex account is verified by staff!");

                    if ($result) {
                        $store->setNotification('An email has been sent', $obj->username . ' will receive an email about the verification.', 'success');
                    } else {
                        $store->setNotification('Couldn\'t send an email', $obj->username . ' won\'t receive an email about the verification.', 'error');
                    }

                    header('Location: /employee/approve');
                    break;
                case 'ignore':
                    $obj->verify(null);

                    // sending the email
                    $email = new EmailServer();
                    $result = $email->sendEmail($obj->email, "Account Verification", "Your Medex account is rejected by staff!");

                    if ($result) {
                        $store->setNotification('An email has been sent', $obj->username . ' will receive an email about the verification.', 'success');
                    } else {
                        $store->setNotification('Couldn\'t send an email', $obj->username . ' won\'t receive an email about the verification.', 'error');
                    }

                    header('Location: /employee/approve');
                    break;
                default:
                    // loading the approval details page
                    $store->g_obj = $obj;
                    $this -> render("employee/approvals/delivery.php");
                    break;
            }
        } else {
            header('Location: /employee/approve');
        }
    }

    /**
     * @throws Exception
     */
    public function loadLab(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_g_usr = $this->getEntityFlag($request);
        $store->flag_g_act = $this->getActionFlag($request);

        $obj = HyperLabModel::getByUsername($store->flag_g_usr);
        if ($obj) {
            // checking whether there is a direct action to be performed
            switch ($store->flag_g_act) {
                case 'approve':
                    $obj->verify(true);

                    // sending the email
                    $email = new EmailServer();
                    $result = $email->sendEmail($obj->email, "Account Verification", "Your Medex account is verified by staff!");

                    if ($result) {
                        $store->setNotification('An email has been sent', $obj->username . ' will receive an email about the verification.', 'success');
                    } else {
                        $store->setNotification('Couldn\'t send an email', $obj->username . ' won\'t receive an email about the verification.', 'error');
                    }

                    header('Location: /employee/approve');
                    break;
                case 'ignore':
                    $obj->verify(null);

                    // sending the email
                    $email = new EmailServer();
                    $result = $email->sendEmail($obj->email, "Account Verification", "Your Medex account is rejected by staff!");

                    if ($result) {
                        $store->setNotification('An email has been sent', $obj->username . ' will receive an email about the verification.', 'success');
                    } else {
                        $store->setNotification('Couldn\'t send an email', $obj->username . ' won\'t receive an email about the verification.', 'error');
                    }

                    header('Location: /employee/approve');
                    break;
                default:
                    // loading the approval details page
                    $store->g_obj = $obj;
                    $this -> render("employee/approvals/lab.php");
                    break;
            }
        } else {
            header('Location: /employee/approve');
        }
    }
}