<?php

namespace app\controllers\employee;

use app\core\Controller;
use app\core\ExceptionHandler;
use app\core\Request;
use app\models\EmployeeOrderModel;
use app\models\EmployeeResourcesModel;
use app\stores\EmployeeStore;

class EmployeeOrdersController extends Controller
{
    const login = 'Location: /login';

    private function validate(): void
    {
        // checking whether the user is logged into the server
        if ($_SESSION['userType'] != 'staff') {
            header(self::login);
        }
    }

    public function loadOrderList(Request $request): void
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
            $model = new EmployeeOrderModel();
            // creating an array of all resources
            $list = $model->getAllOrders();
        }

        // slicing the list to the set size
        // return array_slice($list, $set_number * 9, $set_size);
        return $list;
    }

    public function oderStatusChange(Request $request): void
    {
        $this->validate();

        $model = new EmployeeOrderModel();
        $model->changeOrderStatus($request->getBody()['id'], $request->getBody()['st']);
        header('Location: /employee/orders');
    }

    public function orderMedicineDetails(Request $request)
    {
        if ($request->isGet()) {

            $orderId = $request->getParams()['orderId'];

            $order = (new EmployeeOrderModel())->getMedicineByOrderID($orderId);

            header('Content-Type: application/json');
            // Echo the JSON-encoded response
            echo json_encode($order);


        } else {
            echo (new ExceptionHandler)->somethingWentWrong();
            header('Location: /pharmacy/orders');
        }
    }
}