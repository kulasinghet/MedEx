<?php

namespace app\controllers\lab;

use app\core\Controller;
use app\core\Request;
use app\models\LabRequestModel;
use app\models\MedicineModel;
use app\models\SupplierModel;


class LabRequestsController extends Controller
{
    public function AcceptRequests()
    {
        $req = new LabRequestModel;
        $result = $req->getNotAcceptedReq();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $medid = $row['medId'];
                $supuname = $row['SupName'];
                $sup = new SupplierModel;
                $med = new MedicineModel;
                $medname = $med->getName($medid);
                $medweight = $med->getWeight($medid);
                $medsci = $med->getSciname($medid);
                $supname = $sup->getName($supuname);
                echo "<form method='post' action='/lab/accept-req'>";
                echo " <input type='hidden' value='$id' name='id'/>";
                echo "<tr><td>" . $id . "</td><td>" . $supname . "</td><td>" . $medname . "</td><td>" . $medsci . "</td><td>" . $medweight . "</td><td><input type='submit' value='Accept' class='btn btn--primary'></td><tr></form>";

            }

        }
    }

    public function viewRequests()
    {
        $req = new LabRequestModel;
        $result = $req->getAcceptedReq($_SESSION['username']);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $medid = $row['medId'];
                $supuname = $row['SupName'];
                $sup = new SupplierModel;
                $med = new MedicineModel;
                $medname = $med->getName($medid);
                $medweight = $med->getWeight($medid);
                $medsci = $med->getSciname($medid);
                $supname = $sup->getName($supuname);
                echo "<tr><td>" . $id . "</td><td>" . $supname . "</td><td>" . $medname . "</td><td>" . $medsci . "</td><td>" . $medweight . "</td></tr>";

            }

        }
    }
}