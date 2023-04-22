<?php

namespace app\controllers\employee;

use app\core\Controller;
use app\core\Request;
use app\models\EmpApprovalsModel;
use app\stores\EmployeeStore;

class EmployeeApprovalsController extends Controller
{
    const login = 'Location: /login';
    const approval_flags = ['all', 'pharmacy', 'supplier', 'lab', 'delivery'];


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

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $store->flag_aprv_t = $this->getFilter($request);
        $store->flag_aprv_st = $this->getSetNo($request);

        if (in_array($store->flag_aprv_t, self::approval_flags)) {
            $this -> render("employee/approvals.php");
        } else {
            header('Location: /employee');
        }
    }

    public function getFilter(Request $request): ?string
    {
        if ($request->isGet()) {
            $params = $request->getBody();

            if (array_key_exists('f', $params)) {
                return (string)$params['f'];
            } else {
                return 'all';
            }
        }

        return null;
    }

    public function getSetNo(Request $request): ?int
    {
        if ($request->isGet()) {
            $params = $request->getBody();

            if (array_key_exists('st', $params)) {
                return (int)$params['st'];
            } else {
                return 0;
            }
        }

        return null;
    }

    public function getAllApprovals(int $set_size, $set_number = 0): array
    {
        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        if ($set_number > 0 && $store->approval_list != []) {
            // retrieve the list from the store
            $list = $store->approval_list;
        } else {
            $model = new EmpApprovalsModel();
            // creating an array of all approvals
            $list = $model->getAll();
            shuffle($list);
            // storing the list in the store
            $store->approval_list = $list;
        }

        // slicing the list to the set size
        return array_slice($list, $set_number * 9, $set_size);
    }
}