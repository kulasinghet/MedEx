<?php

namespace app\controllers\delivery;

use app\core\Controller;
use app\core\Request;
use app\models\DeliveryContactusModel;
use app\models\DeliveryModel;

class DeliveryContactusController extends Controller
{
    public function delivery_contact_us(Request $request)
    {
        if ($request->isPost()) {

            $deliverycontactus = new DeliveryContactusModel();
            $deliverycontactus -> loadData($request->getBody());

            if ($deliverycontactus->validate() && $deliverycontactus->delivey_contact_us()) {
                header("Location:/delvery/dashbord");
            }


            return $this->render('delivery/contact_us.php');
        }
        return $this->render('delivery/contact_us.php');
    }

}