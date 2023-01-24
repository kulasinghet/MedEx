<?php

namespace app\controllers;

use app\core\Controller;
use app\core\ExceptionHandler;
use app\core\Logger;
use app\core\Request;
use app\models\LoginModel;
use app\models\PharmacyModel;

class LoginAuthController extends Controller
{
    const defaultView = 'general/login.php';
    public function login(Request $request)
    {
        if ($request->isPost()) {
            $login = new LoginModel();
            $login->loadData($request->getBody());


            if ($login->validate()) {
                $userType = $login->login();
                if ($userType != 'unassigned') {
                    $_SESSION['userType'] = $userType;
                    $_SESSION['username'] = $request->getBody()['username'];
                    return header('Location: /dashboard');
                }
            }

            echo (new \app\core\ExceptionHandler)->userNameOrPasswordIncorrect($request->getBody()['username']);
            $_SESSION['userType'] = null;
            return $this->render(self::defaultView);
        }
        return $this->render(self::defaultView);
    }
}
