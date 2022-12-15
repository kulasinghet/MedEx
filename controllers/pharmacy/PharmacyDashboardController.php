<?php

namespace app\controllers\pharmacy;

use app\core\Controller;
use app\core\Request;

class PharmacyDashboardController extends Controller
{

    public function sellMedicine(Request $request) {
        if ($_SESSION['isPharmacy']) {
//            TODO: add sell medicine route in index php
            if ($request -> isGet()) {
                $this -> render("pharmacy/sell-medicine.php");
            } else if ($request -> isPost()) {
                $this -> render("pharmacy/sell-medicine.php");
            } else {
                return header('Location: /pharmacy/login');
            }
        } else {
            return header('Location: /pharmacy/login');
        }
    }

    public function orderMedicine(Request $request) {
        if ($_SESSION['isPharmacy']) {
            // TODO: add order medicine route in index php
            if ($request -> isGet()) {
                $this -> render("pharmacy/order-medicine.php");
            } else if ($request -> isPost()) {
                $this -> render("pharmacy/order-medicine.php");
            } else {
                return header('Location: /pharmacy/login');
            }
        } else {
            return header('Location: /pharmacy/login');
        }
    }

    public function orders(Request $request) {
        if ($_SESSION['isPharmacy']) {
            // TODO: add orders route in index php
            if ($request -> isGet()) {
                $this -> render("pharmacy/orders.php");
            } else if ($request -> isPost()) {
                $this -> render("pharmacy/orders.php");
            } else {
                return header('Location: /pharmacy/login');
            }
        } else {
            return header('Location: /pharmacy/login');
        }
    }

    public function inventory(Request $request) {
        if ($_SESSION['isPharmacy']) {

            if ($request -> isGet()) {
                $this -> render("pharmacy/inventory.php");
            } else if ($request -> isPost()) {
                $this -> render("pharmacy/inventory.php");
            } else {
                return header('Location: /pharmacy/login');
            }
        } else {
            return header('Location: /pharmacy/login');
        }
    }

    public function contactUs(Request $request) {
        if ($_SESSION['isPharmacy']) {

            if ($request -> isGet()) {
                $this -> render("pharmacy/contact-us.php");
            } else if ($request -> isPost()) {
                $this -> render("pharmacy/contact-us.php");
            } else {
                return header('Location: /pharmacy/login');
            }
        } else {
            return header('Location: /pharmacy/login');
        }
    }


}
