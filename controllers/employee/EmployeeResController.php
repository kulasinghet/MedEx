<?php

namespace app\controllers\employee;

use app\core\Request;
use app\models\HyperEntities\HyperDeliveryModel;
use app\models\HyperEntities\HyperLabModel;
use app\models\HyperEntities\HyperPharmacyModel;
use app\models\HyperEntities\HyperSupplierModel;
use app\stores\EmployeeStore;

class EmployeeResController extends MasterCRUDController
{
    public function loadPharmacy(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_g_usr = $this->getEntityFlag($request);
        $store->flag_g_act = $this->getActionFlag($request);

        //identifies the request is NEW or UPDATE
        if ($store->flag_g_usr == '') {
            // loading the new pharmacy page
            $store->g_obj = null; // make sure there is no object in the store
            $this -> render("employee/res/pharmacy.php");
        } else {
            // loading the update pharmacy page
            $obj = HyperPharmacyModel::getByUsername($store->flag_g_usr);
            if ($obj) {
                // checking whether there is a direct action to be performed
                switch ($store->flag_g_act) {
                    case 'delete':
                        $obj->delete();
                        header('Location: /employee/res?f=pharmacy');
                        break;
                    default:
                        // loading the approval details page
                        $store->g_obj = $obj;
                        $this -> render("employee/res/pharmacy.php");
                        break;
                }
            } else {
                header('Location: /employee/res?f=pharmacy');
            }
        }
    }

    public function pushPharmacy(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        // start output buffering
        ob_start();

        // retrieving data from the request
        if ($request->isPost()) {
            $params = $this->getRequestBody($_POST);
            // checking whether the pharmacy exists in the store.
            //If not, it means this is s insert request
            if ($store->g_obj) {
                // updating the pharmacy
                $store->g_obj->name = $params['name'];
                $store->g_obj->owner_name = $params['owner_name'];
                $store->g_obj->city = $params['city'];
                $store->g_obj->phar_reg_no = $params['phar_reg_no'];
                $store->g_obj->business_reg_id = $params['business_reg_id'];
                $store->g_obj->phar_cert_id = $params['phar_cert_id'];
                $store->g_obj->business_cert_name = $params['business_cert_name'];
                $store->g_obj->phar_cert_name = $params['phar_cert_name'];
                $store->g_obj->delivery_time = $params['delivery_time'];
                $store->g_obj->email = $params['email'];
                $store->g_obj->address = $params['address'];
                $store->g_obj->mobile = $params['mobile'];

                $store->g_obj->update();
            } else {
                // creating a new pharmacy
                $tmp = new HyperPharmacyModel(array(
                    'username' => $params['username'],
                    'name' => $params['name'],
                    'owner_name' => $params['owner_name'],
                    'city' => $params['city'],
                    'phar_reg_no' => $params['phar_reg_no'],
                    'business_reg_id' => $params['business_reg_id'],
                    'phar_cert_id' => $params['phar_cert_id'],
                    'business_cert_name' => $params['business_cert_name'],
                    'phar_cert_name' => $params['phar_cert_name'],
                    'delivery_time' => $params['delivery_time'],
                    'email' => $params['email'],
                    'address' => $params['address'],
                    'mobile' => $params['mobile']
                ));

                $tmp->push();
            }
        }

        // flush output buffer and send header
        ob_end_flush();
        header('Location: /employee/res?f=pharmacy');
    }

    public function loadSupplier(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_g_usr = $this->getEntityFlag($request);
        $store->flag_g_act = $this->getActionFlag($request);

        //identifies the request is NEW or UPDATE
        if ($store->flag_g_usr == '') {
            // loading the new supplier page
            $store->g_obj = null; // make sure there is no object in the store
            $this -> render("employee/res/supplier.php");
        } else {
            // loading the update supplier page
            $obj = HyperSupplierModel::getByUsername($store->flag_g_usr);
            if ($obj) {
                // checking whether there is a direct action to be performed
                switch ($store->flag_g_act) {
                    case 'delete':
                        $obj->delete();
                        header('Location: /employee/res?f=supplier');
                        break;
                    default:
                        // loading the approval details page
                        $store->g_obj = $obj;
                        $this -> render("employee/res/supplier.php");
                        break;
                }
            } else {
                header('Location: /employee/res?f=supplier');
            }
        }
    }

    public function pushSupplier(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        // start output buffering
        ob_start();

        // retrieving data from the request
        if ($request->isPost()) {
            $params = $this->getRequestBody($_POST);
            //$params = $request->getBody();
            // checking whether the supplier exists in the store.
            //If not, it means this is s insert request
            if ($store->g_obj) {
                // updating the supplier
                $store->g_obj->name = $params['name'];
                $store->g_obj->supp_reg_no = $params['supp_reg_no'];
                $store->g_obj->business_reg_id = $params['business_reg_id'];
                $store->g_obj->supp_cert_id = $params['supp_cert_id'];
                $store->g_obj->business_cert_name = $params['business_cert_name'];
                $store->g_obj->supp_cert_name = $params['supp_cert_name'];
                $store->g_obj->email = $params['email'];
                $store->g_obj->address = $params['address'];
                $store->g_obj->mobile = $params['mobile'];

                $store->g_obj->update();
            } else {
                // creating a new supplier
                $tmp = new HyperSupplierModel(array(
                    'username' => $params['username'],
                    'name' => $params['name'],
                    'supp_reg_no' => $params['supp_reg_no'],
                    'business_reg_id' => $params['business_reg_id'],
                    'supp_cert_id' => $params['supp_cert_id'],
                    'business_cert_name' => $params['business_cert_name'],
                    'supp_cert_name' => $params['supp_cert_name'],
                    'email' => $params['email'],
                    'address' => $params['address'],
                    'mobile' => $params['mobile']
                ));

                $tmp->push();
            }
        }

        // flush output buffer and send header
        ob_end_flush();
        header('Location: /employee/res?f=supplier');
    }

    public function loadDelivery(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_g_usr = $this->getEntityFlag($request);
        $store->flag_g_act = $this->getActionFlag($request);

        //identifies the request is NEW or UPDATE
        if ($store->flag_g_usr == '') {
            // loading the new delivery page
            $store->g_obj = null; // make sure there is no object in the store
            $this -> render("employee/res/delivery.php");
        } else {
            // loading the update delivery page
            $obj = HyperDeliveryModel::getByUsername($store->flag_g_usr);
            if ($obj) {
                // checking whether there is a direct action to be performed
                switch ($store->flag_g_act) {
                    case 'delete':
                        $obj->delete();
                        header('Location: /employee/res?f=delivery');
                        break;
                    default:
                        // loading the approval details page
                        $store->g_obj = $obj;
                        $this -> render("employee/res/delivery.php");
                        break;
                }
            } else {
                header('Location: /employee/res?f=delivery');
            }
        }
    }

    public function pushDelivery(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        // start output buffering
        ob_start();

        // retrieving data from the request
        if ($request->isPost()) {
            $params = $this->getRequestBody($_POST);
            // checking whether the delivery exists in the store.
            //If not, it means this is s insert request
            if ($store->g_obj) {
                // updating the delivery
                $store->g_obj->name = $params['name'];
                $store->g_obj->city = $params['city'];
                $store->g_obj->age = $params['age'];
                $store->g_obj->license_id = $params['license_id'];
                $store->g_obj->license_name = $params['license_name'];
                $store->g_obj->vehicle_no = $params['vehicle_no'];
                $store->g_obj->vehicle_type = $params['vehicle_type'];
                $store->g_obj->delivery_location = $params['delivery_location'];
                $store->g_obj->max_load = $params['max_load'];
                $store->g_obj->refrigerators = $params['refrigerators'];
                $store->g_obj->license_photo = $params['license_photo'];
                $store->g_obj->vehicle_reg_photo = $params['vehicle_reg_photo'];
                $store->g_obj->vehicle_photo = $params['vehicle_photo'];
                $store->g_obj->email = $params['email'];
                $store->g_obj->address = $params['address'];
                $store->g_obj->mobile = $params['mobile'];

                $store->g_obj->update();
            } else {
                // creating a new delivery
                $tmp = new HyperDeliveryModel(array(
                    'username' => $params['username'],
                    'name' => $params['name'],
                    'city' => $params['city'],
                    'age' => $params['age'],
                    'license_id' => $params['license_id'],
                    'license_name' => $params['license_name'],
                    'vehicle_no' => $params['vehicle_no'],
                    'vehicle_type' => $params['vehicle_type'],
                    'delivery_location' => $params['delivery_location'],
                    'max_load' => $params['max_load'],
                    'refrigerators' => $params['refrigerators'],
                    'license_photo' => $params['license_photo'],
                    'vehicle_reg_photo' => $params['vehicle_reg_photo'],
                    'vehicle_photo' => $params['vehicle_photo'],
                    'email' => $params['email'],
                    'address' => $params['address'],
                    'mobile' => $params['mobile']
                ));

                $tmp->push();
            }
        }

        // flush output buffer and send header
        ob_end_flush();
        header('Location: /employee/res?f=delivery');
    }

    public function loadLab(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_g_usr = $this->getEntityFlag($request);
        $store->flag_g_act = $this->getActionFlag($request);

        //identifies the request is NEW or UPDATE
        if ($store->flag_g_usr == '') {
            // loading the new lab page
            $store->g_obj = null; // make sure there is no object in the store
            $this -> render("employee/res/lab.php");
        } else {
            // loading the update lab page
            $obj = HyperLabModel::getByUsername($store->flag_g_usr);
            if ($obj) {
                // checking whether there is a direct action to be performed
                switch ($store->flag_g_act) {
                    case 'delete':
                        $obj->delete();
                        header('Location: /employee/res?f=lab');
                        break;
                    default:
                        // loading the approval details page
                        $store->g_obj = $obj;
                        $this -> render("employee/res/lab.php");
                        break;
                }
            } else {
                header('Location: /employee/res?f=lab');
            }
        }
    }

    public function pushLab(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        // start output buffering
        ob_start();

        // retrieving data from the request
        if ($request->isPost()) {
            $params = $this->getRequestBody($_POST);
            // checking whether the lab exists in the store.
            //If not, it means this is s insert request
            if ($store->g_obj) {
                // updating the lab
                $store->g_obj->name = $params['name'];
                $store->g_obj->business_reg_id = $params['business_reg_id'];
                $store->g_obj->lab_cert_id = $params['lab_cert_id'];
                $store->g_obj->business_cert_name = $params['business_cert_name'];
                $store->g_obj->lab_cert_name = $params['lab_cert_name'];
                $store->g_obj->email = $params['email'];
                $store->g_obj->address = $params['address'];
                $store->g_obj->mobile = $params['mobile'];

                $store->g_obj->update();
            } else {
                // creating a new lab
                $tmp = new HyperLabModel(array(
                    'username' => $params['username'],
                    'name' => $params['name'],
                    'business_reg_id' => $params['business_reg_id'],
                    'lab_cert_id' => $params['lab_cert_id'],
                    'business_cert_name' => $params['business_cert_name'],
                    'lab_cert_name' => $params['lab_cert_name'],
                    'email' => $params['email'],
                    'address' => $params['address'],
                    'mobile' => $params['mobile']
                ));

                $tmp->push();
            }
        }

        // flush output buffer and send header
        ob_end_flush();
        header('Location: /employee/res?f=lab');
    }
}