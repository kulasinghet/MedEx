<?php

namespace app\controllers\supplier;

use app\core\Controller;
use app\core\ExceptionHandler;
use app\models\LabRequestModel;
use app\models\MedicineModel;
use app\models\SupplierMedicineModel;


class SupplierMedicineController extends Controller
{

    public function viewallMed($supName)
    {
        $med = new MedicineModel;
        $supMed = new SupplierMedicineModel;
        $result = $supMed->getSupMedicine($_SESSION['username']);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $medid = $row["medId"];
                $medNam = $med->getName($medid);
                $sciName = $med->getSciname($medid);
                $weight = $med->getWeight($medid);
                $quantity = $row["quantity"];
                $unitPrice = $row["unitPrice"];
                echo "<tr><td>" . $medNam . "</td><td>" . $sciName . "</td><td>" . $weight . " mg</td><td>" . $quantity . "</td><td>" . $unitPrice . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='padding:2%;'> No Medicine Added</td>";
        }


    }
    public function viewPendig($supName)
    {
        $med = new MedicineModel;
        $supMed = new SupplierMedicineModel;
        $labreq = new LabRequestModel;
        $result1 = $supMed->getPendingMedicine($_SESSION['username']);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $medid = $row1["medId"];
                $medNam = $med->getName($medid);
                $sciName = $med->getSciname($medid);
                $weight = $med->getWeight($medid);
                $result2 = $labreq->getSupMedReq($medid, $_SESSION['username']);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $labreqid = $row2["id"];
                        $status = $row2["status"];
                        if ($status == '0') {
                            $accpeted = 'Not Accepted by a Lab';
                        } else {
                            $accpeted = 'Accepted by a Lab';
                        }

                        echo "<tr style = 'padding:1%; border-bottom: 1pt solid black;'><td>" . $medNam . "</td><td>" . $sciName . "</td><td>" . $weight . " mg</td><td>" . $accpeted . "</td><td>" . $labreqid . "</td></tr>";
                    }
                }
            }
        } else {
            echo "<tr><td colspan='5' style='padding:2%;'> No Requests</td>";
        }


    }

    public function viewOtherMed($supName)
    {
        $supmedids = array();
        $allmedids = array();
        $otherids = array();
        $med = new MedicineModel;
        $supMed = new SupplierMedicineModel;
        $supids = $supMed->getSupMedIds($_SESSION['username']);
        while ($row1 = $supids->fetch_assoc()) {
            array_push($supmedids, $row1['medId']);
        }
        $allids = $med->getallMedid();
        while ($row2 = $allids->fetch_assoc()) {
            array_push($allmedids, $row2['id']);
        }
        $otherids = array_diff($allmedids, $supmedids);

        echo "<table style = 'width: 100%; text-align:center; padding-top:5%' class='scrollable'> <tr style = 'padding:1%; border-bottom: 1pt solid black;'><th>Medicine Name</th><th>Scientific Name</th><th>Weight</th><th></th></tr>";
        foreach ($otherids as $value) {
            $name = $med->getName($value);
            $sciname = $med->getSciname($value);
            $weight = $med->getWeight($value);
            echo "<form method='post' action='/supplier/add-existing-medicine'>";
            echo " <input type='hidden' value='$value' name='id'/>";
            echo "<tr style = 'padding:1%; border-bottom: 1pt solid black;' ><td>" . $name . "</td><td>" . $sciname . "</td><td>" . $weight . "mg</td><td><input type='submit' value='+' class='btn btn--primary'></td></tr></form>";
        }
        echo "</table>";

    }

    public function updateInventory($supName)
    {
        $med = new MedicineModel;
        $supMed = new SupplierMedicineModel;
        $result = $supMed->getSupMedicine($_SESSION['username']);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $medid = $row["medId"];
                $medNam = $med->getName($medid);
                $sciName = $med->getSciname($medid);
                $weight = $med->getWeight($medid);
                $quantity = $row["quantity"];
                $unitPrice = $row["unitPrice"];
                echo "<tr><td>" . $medNam . "</td><td>" . $sciName . "</td><td>" . $weight . " mg</td><td>" . $quantity . "</td><td>" . $unitPrice . "</td><td><a href='#'><i class='fa fa-pencil'></i></a></td><td><a href='#'><i class='fa fa-trash'></i></a></td></tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='padding:2%;'> No Medicine Added</td>";
        }


    }

}