<?php

namespace app\controllers\employee;

use app\core\Controller;
use app\core\Request;
use app\stores\EmployeeStore;

class EmployeeApprovalsController extends Controller
{
    const login = 'Location: /login';
    const approval_flags = ['all', 'pharmacy', 'supplier', 'lab', 'delivery'];

    private EmployeeStore $store;


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
        $this->store = EmployeeStore::getEmployeeStore();
        $this->store->approval_flag = $this->getFilter($request);

        if (in_array($this->store->approval_flag, self::approval_flags)) {
            $this -> render("employee/approve-all.php");
        } else {
            header('Location: /employee');
        }
    }

    public function getFilter(Request $request) {
        if ($request->isGet()) {
            $params = $request->getBody();

            if (array_key_exists('filter', $params)) {
                return $params['filter'];
            } else {
                return 'all';
            }
        }

        return null;
    }
}