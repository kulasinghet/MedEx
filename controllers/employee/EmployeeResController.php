<?php

namespace app\controllers\employee;

use app\core\Request;
use app\models\HyperEntities\HyperDeliveryModel;
use app\models\HyperEntities\HyperLabModel;
use app\models\HyperEntities\HyperPharmacyModel;
use app\models\HyperEntities\HyperSupplierModel;
use app\stores\EmployeeStore;

class EmployeeResController extends AbstractCRUDController
{
    public function loadPharmacy(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_aprv_one_usr = $this->getEntityFlag($request);
        $store->flag_aprv_one_act = $this->getActionFlag($request);

        $obj = HyperPharmacyModel::getByUsername($store->flag_aprv_one_usr);
        if ($obj) {
            // checking whether there is a direct action to be performed
            switch ($store->flag_aprv_one_act) {
                case 'delete':
                    $obj->verify(true);
                    header('Location: /employee/res?f=pharmacy');
                    break;
                default:
                    // loading the approval details page
                    $store->aprv_one_obj = $obj;
                    $this -> render("employee/res/pharmacy.php");
                    break;
            }
        } else {
            header('Location: /employee/res?f=pharmacy');
        }
    }

    public function loadSupplier(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_aprv_one_usr = $this->getEntityFlag($request);
        $store->flag_aprv_one_act = $this->getActionFlag($request);

        $obj = HyperSupplierModel::getByUsername($store->flag_aprv_one_usr);
        if ($obj) {
            // checking whether there is a direct action to be performed
            switch ($store->flag_aprv_one_act) {
                case 'delete':
                    $obj->verify(true);
                    header('Location: /employee/res?f=supplier');
                    break;
                default:
                    // loading the approval details page
                    $store->aprv_one_obj = $obj;
                    $this -> render("employee/res/supplier.php");
                    break;
            }
        } else {
            header('Location: /employee/res?f=supplier');
        }
    }

    public function loadDelivery(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_aprv_one_usr = $this->getEntityFlag($request);
        $store->flag_aprv_one_act = $this->getActionFlag($request);

        $obj = HyperDeliveryModel::getByUsername($store->flag_aprv_one_usr);
        if ($obj) {
            // checking whether there is a direct action to be performed
            switch ($store->flag_aprv_one_act) {
                case 'delete':
                    $obj->verify(true);
                    header('Location: /employee/res?f=delivery');
                    break;
                default:
                    // loading the approval details page
                    $store->aprv_one_obj = $obj;
                    $this -> render("employee/res/delivery.php");
                    break;
            }
        } else {
            header('Location: /employee/res?f=delivery');
        }
    }

    public function loadLab(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_aprv_one_usr = $this->getEntityFlag($request);
        $store->flag_aprv_one_act = $this->getActionFlag($request);

        $obj = HyperLabModel::getByUsername($store->flag_aprv_one_usr);
        if ($obj) {
            // checking whether there is a direct action to be performed
            switch ($store->flag_aprv_one_act) {
                case 'delete':
                    $obj->verify(true);
                    header('Location: /employee/res?f=lab');
                    break;
                default:
                    // loading the approval details page
                    $store->aprv_one_obj = $obj;
                    $this -> render("employee/res/lab.php");
                    break;
            }
        } else {
            header('Location: /employee/res?f=lab');
        }
    }
}