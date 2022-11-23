<?php

namespace app\controllers;

use app\base\Controller;
use app\base\Request;
use app\models\LabModel;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isPost()) {
            return 'Handling auth data';
        }
        return $this->render('loginPage/loginPage.php');
    }
}
