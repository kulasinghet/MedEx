<?php

namespace app\controllers\lab;

use app\core\Controller;
use app\core\Request;
use app\models\LabRequestModel;
use app\models\LabReportModel;


class LabAcceptReqController extends Controller
{
    public function acceptRequest(Request $request)
    {
        if ($request->isPost()) {
            $labreq = new LabRequestModel;
            $labreport = new LabReportModel;
            $reqid = $_POST['id'];
            $labname = $_SESSION['username'];
            if ($labreport->acceptReport($reqid, $labname) && $labreq->acceptReq($reqid, $labname)) {
                echo (new \app\core\ExceptionHandler)->RequestAccepted();
                return $this->render("/lab/requests.php");
            }

        }
        return $this->render('/lab/requests.php');

    }
}