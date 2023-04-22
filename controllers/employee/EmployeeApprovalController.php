<?php

namespace app\controllers\employee;

use app\core\Controller;
use app\core\Request;
use app\models\InvalidEntity\InvalidDeliveryModel;
use app\models\InvalidEntity\InvalidLabModel;
use app\models\InvalidEntity\InvalidPharmacyModel;
use app\models\InvalidEntity\InvalidSupplierModel;
use app\stores\EmployeeStore;

class EmployeeApprovalController extends Controller
{
    const login = 'Location: /login';

    private function validate(): void
    {
        // checking whether the user is logged into the server
        if ($_SESSION['userType'] != 'staff') {
            header(self::login);
        }
    }

    public function getEntityFlag(Request $request): string
    {
        if ($request->isGet()) {
            $params = $request->getBody();

            if (array_key_exists('et', $params)) {
                return (string)$params['et'];
            }
        }

        return '';
    }

    public function getActionFlag(Request $request): string
    {
        if ($request->isGet()) {
            $params = $request->getBody();

            if (array_key_exists('a', $params)) {
                return (string)$params['a'];
            }
        }

        return '';
    }

    public function loadPharmacy(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_aprv_one_usr = $this->getEntityFlag($request);
        $store->flag_aprv_one_act = $this->getActionFlag($request);

        $obj = InvalidPharmacyModel::getByUsername($store->flag_aprv_one_usr);
        if ($obj) {
            $store->aprv_one_obj = $obj;
            $this -> render("employee/approvals/pharmacy.php");
        } else {
            header('Location: /employee/approve');
        }
    }

    public function loadSupplier(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_aprv_one_usr = $this->getEntityFlag($request);
        $store->flag_aprv_one_act = $this->getActionFlag($request);

        $obj = InvalidSupplierModel::getByUsername($store->flag_aprv_one_usr);
        if ($obj) {
            $store->aprv_one_obj = $obj;
            $this -> render("employee/approvals/supplier.php");
        } else {
            header('Location: /employee/approve');
        }
    }

    public function loadDelivery(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_aprv_one_usr = $this->getEntityFlag($request);
        $store->flag_aprv_one_act = $this->getActionFlag($request);

        $obj = InvalidDeliveryModel::getByUsername($store->flag_aprv_one_usr);
        if ($obj) {
            $store->aprv_one_obj = $obj;
            $this -> render("employee/approvals/delivery.php");
        } else {
            header('Location: /employee/approve');
        }
    }

    public function loadLab(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_aprv_one_usr = $this->getEntityFlag($request);
        $store->flag_aprv_one_act = $this->getActionFlag($request);

        $obj = InvalidLabModel::getByUsername($store->flag_aprv_one_usr);
        if ($obj) {
            $store->aprv_one_obj = $obj;
            $this -> render("employee/approvals/lab.php");
        } else {
            header('Location: /employee/approve');
        }
    }
}