<?php

namespace app\controllers\supplier;

use app\core\Controller;
use app\core\Request;
use app\models\ManufactureModel;
use app\models\MedicineModel;
use app\models\SupplierMedicineModel;
use app\models\PharmacyOrderMedicineMedicineModel;



class SupplierOrdersController extends Controller
{

    public function ViewAcceptedOrders()
    {
        $order = new PharmacyOrderMedicineMedicineModel;
        $med = new MedicineModel;
        $manu = new ManufactureModel;
        $result1 = $order->getSupOrders($_SESSION['username']);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $id = $row1['orderid'];
                $pharname = $order->getOrderPharm($id);
                $medid = $order->getMedId($id);
                $medname = $med->getName($medid);
                $weight = $med->getWeight($medid);
                $volume = $med->getVolume($medid);
                $manid = $med->getManufacture($id);
                $manname = $manu->getManufactureName($manid);
                $qauntity = $order->getMedQuantiy($id);
                if ($weight > 0) {
                    echo "<tr><td>" . $id . "</td><td>" . $pharname . "</td><td>" . $medname . "</td><td>" . $weight . "mg</td><td>" . $manname . "</td><td>" . $qauntity . "</td></tr>";
                } else {
                    echo "<tr><td>" . $id . "</td><td>" . $pharname . "</td><td>" . $medname . "</td><td>" . $volume . "ml</td><td>" . $manname . "</td><td>" . $qauntity . "</td></tr>";
                }


            }
        } else {
            echo "<tr><td colspan=7>No Orders Accepted yet</td></tr>";
        }

    }

    public function ViewAcceptedOrdersFilterd($searchTerm)
    {
        $order = new PharmacyOrderMedicineMedicineModel;
        $med = new MedicineModel;
        $manu = new ManufactureModel;
        $result1 = $order->getSupOrdersFilter($_SESSION['username'], $searchTerm);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $id = $row1['orderid'];
                $pharname = $order->getOrderPharm($id);
                $medid = $order->getMedId($id);
                $medname = $med->getName($medid);
                $weight = $med->getWeight($medid);
                $volume = $med->getVolume($medid);
                $manid = $med->getManufacture($id);
                $manname = $manu->getManufactureName($manid);
                $qauntity = $order->getMedQuantiy($id);
                if ($weight > 0) {
                    echo "<tr><td>" . $id . "</td><td>" . $pharname . "</td><td>" . $medname . "</td><td>" . $weight . "mg</td><td>" . $manname . "</td><td>" . $qauntity . "</td></tr>";
                } else {
                    echo "<tr><td>" . $id . "</td><td>" . $pharname . "</td><td>" . $medname . "</td><td>" . $volume . "ml</td><td>" . $manname . "</td><td>" . $qauntity . "</td></tr>";
                }


            }
        } else {
            echo "<tr><td colspan=7>No Orders Accepted yet</td></tr>";
        }

    }

}