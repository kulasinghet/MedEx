<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
         return $this->render('homepage/index.php');
//        return header("Location: /login");
    }

    public function _404()
    {
        return $this->render('/general/404.php');
    }

    public function logout(Request $request)
    {
        session_destroy();
        return header("Location: /login");
    }
}
