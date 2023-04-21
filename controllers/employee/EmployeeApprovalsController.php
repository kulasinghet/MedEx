<?php

namespace app\controllers\employee;

use app\core\Controller;
use app\core\Request;

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

        // storing in the session
        $_SESSION['approval_filter'] = $this->getFilter($request);
//        switch ($_SESSION['approval_filter']) {
//            case 'pharmacy':
//                $this -> render("employee/approve-pharmacy.php");
//                break;
//            case 'supplier':
//                $this -> render("employee/approve-supplier.php");
//                break;
//            case 'lab':
//                $this -> render("employee/approve-lab.php");
//                break;
//            case 'delivery':
//                $this -> render("employee/approve-delivery.php");
//                break;
//            case 'all':
//                $this -> render("employee/approve-all.php");
//                break;
//            default:
//                header('Location: /employee');
//        }

        if (in_array($_SESSION['approval_filter'], self::approval_flags)) {
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