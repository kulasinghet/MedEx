<?php

namespace app\controllers\lab;

use app\core\Controller;
use app\core\Request;

class LabDashboardController extends Controller
{
    const login = 'Location: /login';

    public function viewRequest(Request $request)
    {
        if ($_SESSION['userType'] == 'lab') {
            if ($request->isGet()) {
                $this->render("lab/requests.php");
            } elseif ($request->isPost()) {
                $this->render("lab/requests.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function addLabReport(Request $request)
    {
        if ($_SESSION['userType'] == 'lab') {

            if ($request->isGet()) {
                $this->render("lab/reports.php");
            } elseif ($request->isPost()) {
                $this->render("lab/reports.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }
    public function contactUs(Request $request)
    {
        if ($_SESSION['userType'] == 'lab') {

            if ($request->isGet()) {
                $this->render("lab/contact-us.php");
            } else if ($request->isPost()) {
                $this->render("lab/contact-us.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function PastReq(Request $request)
    {
        if ($_SESSION['userType'] == 'lab') {

            if ($request->isGet()) {
                $this->render("lab/past-requests.php");
            } else if ($request->isPost()) {
                $this->render("lab/past-requests.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function PastReports(Request $request)
    {
        if ($_SESSION['userType'] == 'lab') {

            if ($request->isGet()) {
                $this->render("lab/past-reports.php");
            } else if ($request->isPost()) {
                $this->render("lab/past-reports.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

}