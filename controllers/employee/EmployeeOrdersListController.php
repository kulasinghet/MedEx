<?php

namespace app\controllers\employee;

use app\core\Controller;
use app\core\Request;
use app\models\EmployeeResourcesModel;
use app\stores\EmployeeStore;

class EmployeeOrdersListController extends Controller
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

        $this -> render("employee/orders/list.php");
    }

    public function getOrderList(int $set_size, $set_number = 0): array
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
}