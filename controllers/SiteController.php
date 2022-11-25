<?php

namespace app\controllers;

use app\base\Controller;
use app\base\Request;

class SiteController extends Controller
{
    public function home()
    {
        return $this->render('loginPage/loginPage.phphomepage/home.php');
    }

    public function login()
    {
        return $this->render('loginPage/loginPage.php');
    }

    public function _404()
    {
        return $this->render('../views/homepage/404.php');
    }

}
