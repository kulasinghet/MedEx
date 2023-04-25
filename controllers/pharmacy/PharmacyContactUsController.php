<?php

namespace app\controllers\pharmacy;

use app\core\Controller;

class PharmacyContactUsController extends Controller
{

    public function contactUs(\app\core\Request $request)
    {
        if ($_SESSION['userType'] == 'pharmacy') {
            if ($request->isGet()) {
                $this->render("pharmacy/contact-us.php");
            } elseif ($request->isPost()) {

                $formBody = $request->getBody();

                $contactUs = new \app\models\ContactUsModel();
                $contactUs->setUsername($_SESSION['username']);
                $contactUs->setSubject($formBody['subject']);
                $contactUs->setMessage($formBody['message']);

                if ($contactUs -> insertInquiry()) {
                    return true;
                } else {
                    return false;
                }


            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }
}
