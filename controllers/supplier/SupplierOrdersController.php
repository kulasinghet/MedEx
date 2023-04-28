<?php

namespace app\controllers\supplier;

use app\core\Controller;
use app\core\Request;
use app\models\ManufactureModel;
use app\models\MedicineModel;
use app\models\SupplierMedicineModel;
use app\models\PharmacyOrderModel;



class SupplierOrdersController extends Controller
{

    public function ViewAcceptedOrders()
    {
        $order = new PharmacyOrderModel;
        $med = new MedicineModel;
        $manu = new ManufactureModel;
        $result1 = $order->getSupOrders($_SESSION['username']);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $id = $row1['id'];
                $result2 = $order->getOrder($id);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $pharname = $row2['pharmacyName'];
                        $medid = $row2['medId'];
                        $medname = $med->getName($medid);
                        $weight = $med->getWeight($medid);
                        $volume = $med->getVolume($medid);
                        $manid = $med->getManufacture($id);
                        $manname = $manu->getManufactureName($manid);
                        $qauntity = $row2['quantity'];
                        if ($weight > 0) {
                            echo "<tr><td>" . $id . "</td><td>" . $pharname . "</td><td>" . $medname . "</td><td>" . $weight . "mg</td><td>" . $manname . "</td><td>" . $qauntity . "</td></tr>";
                        } else {
                            echo "<tr><td>" . $id . "</td><td>" . $pharname . "</td><td>" . $medname . "</td><td>" . $volume . "ml</td><td>" . $manname . "</td><td>" . $qauntity . "</td></tr>";
                        }


                    }
                }
            }
        } else {
            echo "<tr><td colspan=7>No Orders Accepted yet</td></tr>";
        }


    }

}