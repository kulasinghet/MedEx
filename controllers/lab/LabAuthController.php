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
            $lab->loadData($request->getBody());

            if ($_POST['password'] != $_POST['confirmPassword']) {
                echo (new \app\core\ExceptionHandler)->passwordDoesNotMatch();
                return $this->render('registrationPage/laboratory_register_page/register.php');
            }

            if ($_POST['userName'] == '' || $_POST['password'] == '' || $_POST['confirmPassword'] == '' || $_POST['email'] == '' || $_POST['laboratory_name'] == '' || $_POST['address'] == '' || $_POST['contactNumber'] == '') {
                echo (new \app\core\ExceptionHandler)->emptyFields();
                return $this->render('registrationPage/laboratory_register_page/register.php');
            }

            if ($lab->validate() && $lab->registerLab()) {
                return header("Location: /lab/login");
            }

            return $this->render('registrationPage/laboratory_register_page/register.php');
        }
        return $this->render('registrationPage/laboratory_register_page/register.php');
    }

}
