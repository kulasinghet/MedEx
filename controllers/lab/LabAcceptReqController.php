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
            $labreport->labName = $_SESSION['username'];
            $labreport->reqId = $reqid;
            if ($labreport->acceptReport() && $labreq->acceptReq($reqid)) {
                echo (new \app\core\ExceptionHandler)->RequestAccepted();
                return $this->render("/lab/requests.php");
            }

        }
        return $this->render('/lab/requests.php');

    }
}