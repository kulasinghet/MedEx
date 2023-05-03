<?php

namespace app\controllers\supplier;

use app\core\Controller;
use app\core\ExceptionHandler;
use app\core\Logger;
use app\models\LabRequestModel;
use app\models\MedicineModel;
use app\models\SupplierMedicineModel;
use app\models\ManufactureModel;


class SupplierMedicineController extends Controller
{

    public function viewallMed($supName)
    {
        $med = new MedicineModel;
        $supMed = new SupplierMedicineModel;
        $man = new ManufactureModel;
        $result = $supMed->getSupMedicine($_SESSION['username']);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $medid = $row["medId"];
                $medNam = $med->getName($medid);
                $sciName = $med->getSciname($medid);
                $weight = $med->getWeight($medid);
                $volume = $med->getVolume($medid);
                $quantity = $row["quantity"];
                $unitPrice = $row["unitPrice"];
                $manid = $med->getManufacture($medid);
                $manname = $man->getManufactureName($manid);
                if ($weight > 0) {
                    echo "<tr><td>" . $medNam . "</td><td>" . $sciName . "</td><td>" . $weight . " mg</td><td>" . $manname . "</td><td>" . $quantity . "</td><td>" . $unitPrice . "</td></tr>";
                } else {
                    echo "<tr><td>" . $medNam . "</td><td>" . $sciName . "</td><td>" . $volume . " ml</td><td>" . $manname . "</td><td>" . $quantity . "</td><td>" . $unitPrice . "</td></tr>";
                }
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
        $man = new ManufactureModel;
        $result1 = $supMed->getPendingMedicine($_SESSION['username']);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $medid = $row1["medId"];
                $medNam = $med->getName($medid);
                $sciName = $med->getSciname($medid);
                $weight = $med->getWeight($medid);
                $volume = $med->getVolume($medid);
                $result2 = $labreq->getSupMedReq($medid, $_SESSION['username']);
                $manid = $med->getManufacture($medid);
                $manname = $man->getManufactureName($manid);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $labreqid = $row2["id"];
                        $status = $row2["status"];
                        if ($status == '0') {
                            $accpeted = 'Pending';
                        } else {
                            $accpeted = 'Accepted';
                        }
                        if ($weight > 0) {
                            echo "<tr style = 'padding:1%; border-bottom: 1pt solid black;'><td>" . $medNam . "</td><td>" . $sciName . "</td><td>" . $weight . " mg</td><td>" . $manname . "</td><td>" . $accpeted . "</td><td>" . $labreqid . "</td></tr>";
                        } else {
                            echo "<tr style = 'padding:1%; border-bottom: 1pt solid black;'><td>" . $medNam . "</td><td>" . $sciName . "</td><td>" . $volume . " ml</td><td>" . $manname . "</td><td>" . $accpeted . "</td><td>" . $labreqid . "</td></tr>";
                        }
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
        $man = new ManufactureModel;
        $supids = $supMed->getSupMedIds($_SESSION['username']);
        while ($row1 = $supids->fetch_assoc()) {
            array_push($supmedids, $row1['medId']);
        }
        $allids = $med->getallMedid();
        while ($row2 = $allids->fetch_assoc()) {
            array_push($allmedids, $row2['id']);
        }
        $otherids = array_diff($allmedids, $supmedids);


        echo "<div style='height: 300px;'>
        <table style = 'width: 100%; text-align:center; padding-top:5%;>
        <thead style='position:fixed;'><tr style = 'padding:1%; border-bottom: 1pt solid black;'><th>Medicine Name</th><th>Scientific Name</th><th>Weight/Volume</th><th>Mannufacture</th><th> Add Medicine</th></tr></thead>
        </table>
        <div style='height: 100%; overflow: auto;'>
        <table style = 'width: 100%; text-align:center; padding-bottom:5%;>
        <tbody>";
        foreach ($otherids as $value) {
            $name = $med->getName($value);
            $sciname = $med->getSciname($value);
            $weight = $med->getWeight($value);
            $volume = $med->getVolume($value);
            $manid = $med->getManufacture($value);
            $manname = $man->getManufactureName($manid);
            if ($weight > 0) {
                echo "<form method='post' action='/supplier/add-existing-medicine'>";
                echo " <input type='hidden' value='$value' name='id'/>";
                echo "<tr style = 'padding:1%; border-bottom: 1pt solid black;' ><td>" . $name . "</td><td>" . $sciname . "</td><td>" . $weight . " mg</td><td>" . $manname . "</td><td><input type='submit' value='+' class='btn btn--primary'></td></tr></form>";
            } else {
                echo "<form method='post' action='/supplier/add-existing-medicine'>";
                echo " <input type='hidden' value='$value' name='id'/>";
                echo "<tr style = 'padding:1%; border-bottom: 1pt solid black;' ><td>" . $name . "</td><td>" . $sciname . "</td><td>" . $volume . " ml</td><td>" . $manname . "</td><td><input type='submit' value='+' class='btn btn--primary'></td></tr></form>";
            }

        }
        echo "</tbody></table></div></div>";
    }
}