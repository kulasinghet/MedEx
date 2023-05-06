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
            $file1 = $_FILES["LabReport"];
            $file_ext1 = explode('.', $file1['name']);
            $file_ext1 = strtolower(end($file_ext1));
            if ($file1['size'] <= 3145728) {
                $LabReportName_New = $_POST["reqid"] . "LabReport." . $file_ext1;
                $filedestination1 = '..\public\uploads\laboratory\labReport' . DIRECTORY_SEPARATOR . $LabReportName_New;
                move_uploaded_file($file1['tmp_name'], $filedestination1);

            } else {
                echo (new \app\core\ExceptionHandler)->uploadtobig();
                return $this->render('/lab/reports.php');
            }

            $result1 = $labreq->getSup_Medid($reqid);
            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    $medId = $row1['medId'];
                    $supName = $row1['SupName'];
                }
            }
            if ($labreport->issueReport($reqid, $verfied, $comment, $LabReportName_New) && $supMed->UpdateLabReport($supName, $medId, $verfied)) {
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
                $report = $row['LabReportName'];
                $link = '/uploads/laboratory/labReport' . DIRECTORY_SEPARATOR . $report;
                echo "<tr><td>" . $reqid . "</td><td>" . $status . "</td><td>" . $comment . "</td><td>" . "<a class='btn btn--primary' target='_blank' href='" . $link . "'>Check Lab Report</a>" . "</td></tr>";
            }

        }
    }
}