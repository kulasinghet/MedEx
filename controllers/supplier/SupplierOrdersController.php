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
        $supmed = new SupplierMedicineModel;
        $result = $order->getSupOrders($_SESSION['username']);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $pharname = $order->getOrderPharm($id);
                $medid = $order->getMedId($id);
                $medname = $med->getName($medid);
                $weight = $med->getWeight($medid);
                $manid = $med->getManufacture($id);
                $manname = $manu->getManufactureName($manid);
                $qauntity = $order->getMedQuantiy($id);
                if ($supmed->getQuantity($medid) > $qauntity) {
                    echo "<form method='post' action='/supplier/accept'>";
                    echo " <input type='hidden' value='$medid' name='medid'/>";
                    echo " <input type='hidden' value='$qauntity' name='qauntity'/>";
                    echo " <input type='hidden' value='$id' name='orderid'/>";
                    echo "<tr><td>" . $id . "</td><td>" . $pharname . "</td><td>" . $medname . "</td><td>" . $weight . "</td><td>" . $manname . "</td><td>" . $qauntity . "</td><td>Pending</td></tr></form>";

                }

            }
        } else {
            echo "<tr><td colspan=7>No Orders Accepted yet</td></tr>";
        }


    }

}