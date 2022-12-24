<?php

namespace app\controllers\lab;

use app\core\Controller;
use app\core\Request;
use app\models\DeliveryContactusModel;
use app\models\DeliveryModel;
use app\models\LabContactusModel;

class LabContactusController extends Controller
{
    public function lab_contact_us(Request $request)
    {
        if ($request->isPost()) {

            $labcontactus = new LabContactusModel();
            $labcontactus -> loadData($request->getBody());

            if ($labcontactus->validate() && $labcontactus->lab_contact_us()) {
                header("Location:/dashboard");
            }


            return $this->render('lab/contact_us.php');
        }
        return $this->render('lab/contact_us.php');
    }

}