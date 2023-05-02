<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\ContactUsModel;

class ContactUsController extends Controller
{

    public function contactUs(Request $request)
    {
        if ($request->isPost()) {
            $inqury = new ContactUsModel;
            $inqury->subject = $_POST["subject"];
            $inqury->message = $_POST["message"];
            $inqury->username = $_SESSION['username'];
            if ($inqury->insertInquiry()) {
                echo (new \app\core\ExceptionHandler)->InquirySent();
                return $this->render("/supplier/dashboard.php");
            }


        }

        return $this->render('/supplier/dashboard.php');
    }
}