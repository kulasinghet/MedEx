<?php

namespace app\controllers\supplier;

use app\core\Controller;
use app\core\ExceptionHandler;
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
                echo "<tr><td>" . $medNam . "</td><td>" . $sciName . "</td><td>" . $weight . " mg</td><td>" . $quantity . "</td><td>" . $unitPrice . "</td> </tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='padding:2%;'> No Medicine Added</td>";
        }


    }

}