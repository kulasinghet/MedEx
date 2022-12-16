<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
        return $this->render('homepage/index.php');
    }

    public function _404()
    {
        return $this->render('404.php');
    }

    public function logout(Request $request)
    {
        if ($request->isPost()) {
            session_destroy();
            return header("Location: /");
        } else {
            session_destroy();
            return header("Location: /");
        }
    }


}
