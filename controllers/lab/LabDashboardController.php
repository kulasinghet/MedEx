<?php

namespace app\controllers\lab;

use app\core\Controller;
use app\core\Request;

class LabDashboardController extends Controller
{
    public function orders(Request $request){
        if ($_SESSION['isDelivery']) {
//            TODO: add sell medicine route in index php
            if ($request -> isGet()) {
                $this -> render("delivery/orders.php");
            } else if ($request -> isPost()) {
                $this -> render("delivery/orders.php");
            } else {
                return header('Location: /delivery/login');
            }
        } else {
            return header('Location: /delivery/login');
        }
    }
    public function history(Request $request){
        if ($_SESSION['isDelivery']) {
//            TODO: add sell medicine route in index php
            if ($request -> isGet()) {
                $this -> render("delivery/history.php");
            } else if ($request -> isPost()) {
                $this -> render("delivery/history.php");
            } else {
                return header('Location: /delivery/login');
            }
        } else {
            return header('Location: /delivery/login');
        }
    }
    public function contactus(Request $request){
        if ($_SESSION['isLab']) {
//            TODO: add sell medicine route in index php
            if ($request -> isGet()) {
                $this -> render("lab/contact_us.php");
            } else if ($request -> isPost()) {
                $this -> render("lab/contact_us.php");
            } else {
                return header('Location: /lab/login');
            }
        } else {
            return header('Location: /lab/login');
        }
    }

}
