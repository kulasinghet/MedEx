<?php

namespace app\controllers\Delivery;

use app\core\Controller;
use app\core\Request;
use app\models\DeliveryModel;


class DeliveryAuthController extends Controller
{
    public function deliveryRegister(Request $request)
    {
        if ($request->isPost()) {

            $delivery = new DeliveryModel();
            $delivery -> loadData($request->getBody());

            if ($delivery->validate() && $delivery->registerDeliveryPartner()) {
                return header('Location: /delivery/login');
            }

            return $this->render('registerPage/deliregister.php');
        }
        return $this->render('registerPage/deliregister.php');
    }

    public function deliveryLogin(Request $request)
    {
        if ($request->isPost()) {
            return 'Handling auth data';
        }
        return $this->render('loginPage/loginPage.php');
    }


}
