<?php

namespace app\controllers\lab;

use app\core\Controller;
use app\core\Request;
use app\models\LabReportModel;
use app\models\LabRequestModel;
use app\models\SupplierMedicineModel;


class LabReportController extends Controller
{
    public function genrateReport(Request $request)
    {
        if ($request->isPost()) {
            $labreport = new LabReportModel;
            $labreq = new LabRequestModel;
            $supMed = new SupplierMedicineModel;
            $reqid = $_POST['reqid'];
            $verfied = $_POST['status'];
            $comment = $_POST['comment'];
            $result1 = $labreq->getSup_Medid($reqid);
            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    $medId = $row1['medId'];
                    $supName = $row1['SupName'];
                }
            }
            if ($labreport->issueReport($reqid, $verfied, $comment) && $supMed->UpdateLabReport($supName, $medId, $verfied)) {
                echo (new \app\core\ExceptionHandler)->LabReportIssued();
                return $this->render("/lab/past-reports.php");
            }

        }
        return $this->render('/lab/past-reports.php');

    }

    public function getIssuedReports()
    {
        $labreport = new LabReportModel;
        $result = $labreport->getLabReports($_SESSION['username']);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reqid = $row['reqId'];
                $verfied = $row['verified'];
                if ($verfied == '1') {
                    $status = "Approved";
                } else {
                    $status = "Not Approved";

                }
                $comment = $row['comment'];
                echo "<tr><td>" . $reqid . "</td><td>" . $status . "</td><td>" . $comment . "</td></tr>";
            }

        }
    }
}