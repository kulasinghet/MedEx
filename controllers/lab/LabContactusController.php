<?php

namespace app\controllers\lab;

use app\core\Controller;
use app\core\Request;
use app\models\ReportModel;

class LabContactUsController extends Controller
{
    public function contactUs(Request $request)
    {
        if ($request->isPost()) {
            $inqury = new ReportModel;
            $inqury->subject = $_POST["subject"];
            $inqury->message = $_POST["message"];
            $inqury->username = $_SESSION['username'];
            if ($inqury->insertInquiry()) {
                echo (new \app\core\ExceptionHandler)->InquirySent();
                return $this->render("/lab/dashboard.php");
            }


        }

        return $this->render('/lab/dashboard.php');
    }
}