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
            $lab -> loadData($request->getBody());

            if ($_POST['password'] != $_POST['retypepassword']) {
                echo (new \app\core\ExceptionHandler)->passwordDoesNotMatch();
                return $this->render('registrationPage/laboratory_register_page/register.php');
            }

            if ($lab->validate() && $lab->registerLab()) {
                header("Location: /lab/login");
            } else {
                echo (new \app\core\ExceptionHandler)->somethingWentWrong();
                header("Location: /lab/register");

            }

        }
        return $this->render('registrationPage/laboratory_register_page/register.php');
    }

}
