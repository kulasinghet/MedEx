<?php

namespace app\controllers\Lab;

use app\core\Controller;
use app\core\Request;
use app\models\LabModel;

class LabAuthController extends Controller
{
    public function labRegister(Request $request)
    {
        if ($request->isPost()) {

            $lab = new LabModel();
            $id = $request->getBody()['id'];



            return 'Handling auth data';
        }
        return $this->render('registerPage/deliregister.php');
    }

}
