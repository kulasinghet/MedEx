<?php

namespace app\controllers\employee;

use app\core\Request;
use app\models\EmpResourcesModel;
use app\stores\EmployeeStore;

class EmployeeApprovalListController extends AbstractListController
{
    public function load(Request $request): void
    {
        $this->validate();

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_g_t = $this->getFilterFlag($request);
        $store->flag_g_st = $this->getSetNoFlag($request);

        if (in_array($store->flag_g_t, self::approval_flags)) {
            $this -> render("employee/approvals/list.php");
        } else {
            header('Location: /employee');
        }
    }

    public function getAllApprovals(int $set_size, $set_number = 0): array
    {
        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        if ($set_number > 0 && $store->list_g != []) {
            // retrieve the list from the store
            $list = $store->list_g;
        } else {
            $model = new EmpResourcesModel();
            // creating an array of all approvals
            $list = $model->getAll(false);
            shuffle($list);
            // storing the list in the store
            $store->list_g = $list;
        }

        // slicing the list to the set size
        return array_slice($list, $set_number * 9, $set_size);
    }

    public function getPharmacyApprovals(int $set_size, $set_number = 0): array
    {
        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        if ($set_number > 0 && $store->list_g != []) {
            // retrieve the list from the store
            $list = $store->list_g;
        } else {
            $model = new EmpResourcesModel();
            // creating an array of all approvals
            $list = $model->getPharmacyList(false);
            // storing the list in the store
            $store->list_g = $list;
        }

        // slicing the list to the set size
        return array_slice($list, $set_number * 9, $set_size);
    }

    public function getSupplierApprovals(int $set_size, $set_number = 0): array
    {
        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        if ($set_number > 0 && $store->list_g != []) {
            // retrieve the list from the store
            $list = $store->list_g;
        } else {
            $model = new EmpResourcesModel();
            // creating an array of all approvals
            $list = $model->getSupplierList(false);
            // storing the list in the store
            $store->list_g = $list;
        }

        // slicing the list to the set size
        return array_slice($list, $set_number * 9, $set_size);
    }

    public function getDeliveryApprovals(int $set_size, $set_number = 0): array
    {
        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        if ($set_number > 0 && $store->list_g != []) {
            // retrieve the list from the store
            $list = $store->list_g;
        } else {
            $model = new EmpResourcesModel();
            // creating an array of all approvals
            $list = $model->getDeliveryGuysList(false);
            // storing the list in the store
            $store->list_g = $list;
        }

        // slicing the list to the set size
        return array_slice($list, $set_number * 9, $set_size);
    }

    public function getLabApprovals(int $set_size, $set_number = 0): array
    {
        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        if ($set_number > 0 && $store->list_g != []) {
            // retrieve the list from the store
            $list = $store->list_g;
        } else {
            $model = new EmpResourcesModel();
            // creating an array of all approvals
            $list = $model->getLabList(false);
            // storing the list in the store
            $store->list_g = $list;
        }

        // slicing the list to the set size
        return array_slice($list, $set_number * 9, $set_size);
    }
}