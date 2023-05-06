<?php

namespace app\controllers\supplier;

use app\core\Controller;
use app\core\Request;
use app\models\InquiryModel;

class SupplierContactUsController extends Controller
{

    public function contactUs(Request $request)
    {
        if ($request->isPost()) {
            $inqury = new InquiryModel;
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