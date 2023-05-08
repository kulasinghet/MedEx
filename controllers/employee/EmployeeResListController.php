<?php

namespace app\controllers\employee;

use app\core\Request;
use app\models\EmployeeResourcesModel;
use app\stores\EmployeeStore;

class EmployeeResListController extends MasterListController
{
    public function load(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_g_t = $this->getFilterFlag($request);
        $store->flag_g_st = $this->getSetNoFlag($request);

        if (in_array($store->flag_g_t, self::approval_flags)) {
            $this -> render("employee/res/list.php");
        } else {
            header('Location: /employee');
        }
    }

    public function getPharmacyList(int $set_size, $set_number = 0): array
    {
        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        if ($set_number > 0 && $store->list_g != []) {
            // retrieve the list from the store
            $list = $store->list_g;
        } else {
            $model = new EmployeeResourcesModel();
            // creating an array of all resources
            $list = $model->getPharmacyList(true);
        }

        // slicing the list to the set size
        return array_slice($list, $set_number * 9, $set_size);
    }

    public function getSupplierList(int $set_size, $set_number = 0): array
    {
        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        if ($set_number > 0 && $store->list_g != []) {
            // retrieve the list from the store
            $list = $store->list_g;
        } else {
            $model = new EmployeeResourcesModel();
            // creating an array of all resources
            $list = $model->getSupplierList(true);
            // storing the list in the store
            $store->list_g = $list;
        }

        // slicing the list to the set size
        return array_slice($list, $set_number * 9, $set_size);
    }

    public function getLabList(int $set_size, $set_number = 0): array
    {
        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        if ($set_number > 0 && $store->list_g != []) {
            // retrieve the list from the store
            $list = $store->list_g;
        } else {
            $model = new EmployeeResourcesModel();
            // creating an array of all resources
            $list = $model->getLabList(true);
            // storing the list in the store
            $store->list_g = $list;
        }

        // slicing the list to the set size
        return array_slice($list, $set_number * 9, $set_size);
    }

    public function getDeliveryList(int $set_size, $set_number = 0): array
    {
        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        if ($set_number > 0 && $store->list_g != []) {
            // retrieve the list from the store
            $list = $store->list_g;
        } else {
            $model = new EmployeeResourcesModel();
            // creating an array of all resources
            $list = $model->getDeliveryGuysList(true);
            // storing the list in the store
            $store->list_g = $list;
        }

        // slicing the list to the set size
        return array_slice($list, $set_number * 9, $set_size);
    }
}