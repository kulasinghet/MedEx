<?php

namespace app\controllers\pharmacy;

use app\core\Controller;
use app\core\NotificationHandler;
use app\core\Request;

class PharmacyDashboardController extends Controller
{
    const login = 'Location: /login';

    public function sellMedicine(Request $request)
    {
        if ($_SESSION['userType'] == 'pharmacy') {
//            TODO: add sell medicine route in index php
            if ($request -> isGet()) {
                $this -> render("pharmacy/sell-medicine.php");
            } elseif ($request -> isPost()) {
                $this -> render("pharmacy/sell-medicine.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function orderMedicine(Request $request)
    {
        if ($_SESSION['userType'] == 'pharmacy') {
            // TODO: add order medicine route in index php
            if ($request -> isGet()) {
                $this -> render("pharmacy/order-medicine.php");
            } elseif ($request -> isPost()) {
                $this -> render("pharmacy/order-medicine.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function orders(Request $request)
    {
        if ($_SESSION['userType'] == 'pharmacy') {
            // TODO: add orders route in index php
            if ($request -> isGet()) {
                $this -> render("pharmacy/orders.php");
            } else if ($request -> isPost()) {
                $this -> render("pharmacy/orders.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function inventory(Request $request) {
        if ($_SESSION['userType'] == 'pharmacy') {

            if ($request -> isGet()) {
                $this -> render("pharmacy/inventory.php");
            } else if ($request -> isPost()) {
                $this -> render("pharmacy/inventory.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function contactUs(Request $request) {
        if ($_SESSION['userType'] == 'pharmacy') {

            if ($request -> isGet()) {
                $this -> render("pharmacy/contact-us.php");
            } else if ($request -> isPost()) {

                $pharmacyContactUs = new PharmacyContactUsController();
                $flag = $pharmacyContactUs -> contactUs($request);

                if ($flag) {
                    echo (new NotificationHandler()) ->contactUsCreatedSuccessfully($_SESSION['username']);
                    $this -> render("pharmacy/contact-us.php");
                } else {
                    echo (new NotificationHandler()) ->somethingWentWrong();
                    $this -> render("pharmacy/contact-us.php");
                }
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function profile(Request $request) {
        if ($_SESSION['userType'] == 'pharmacy') {
            if ($request -> isGet()) {
                $user = $this -> getPharmacyProfile();
                $this -> render("pharmacy/profile.php", ['user' => $user]);
            } else if ($request -> isPost()) {
                $this -> render("pharmacy/profile.php");
            } else {
                return header('/login');
            }
        } else {
            return header('/login');
        }
    }

    public function settings(Request $request) {
        if ($_SESSION['userType'] == 'pharmacy') {
            if ($request -> isGet()) {
                $this -> render("pharmacy/settings.php");
            } else if ($request -> isPost()) {
                $this -> render("pharmacy/settings.php");
            } else {
                return header('/login');
            }
        } else {
            return header('/login');
        }
    }

    public function invoices(Request $request) {
        if ($_SESSION['userType'] == 'pharmacy') {
            if ($request -> isGet()) {
                $this -> render("pharmacy/invoices.php");
            } else if ($request -> isPost()) {
                $this -> render("pharmacy/invoices.php");
            } else {
                return header('/login');
            }
        } else {
            return header('/login');
        }
    }

    public function getPharmacyProfile() {
        if (isset($_SESSION['username'])) {
            $user = new \app\models\PharmacyModel();
            return $user->getPharmacyProfile($_SESSION['username']);
        } else {
            return header(self::login);
        }
    }

    public function isVerified() {
        if (isset($_SESSION['username'])) {
            $user = new \app\models\PharmacyModel();
            $flag = $user->isVerified($_SESSION['username']);

            if ($flag) {
                return 1;
            } else {
                return 0;
            }

        } else {
            return header(self::login);
        }
    }


}
