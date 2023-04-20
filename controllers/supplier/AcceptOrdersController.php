<?php

namespace app\controllers\supplier;

use app\core\Controller;
use app\core\Request;
use app\models\ManufactureModel;
use app\models\MedicineModel;
use app\models\SupplierMedicineModel;
use app\models\PharmacyOrderModel;



class AcceptOrdersController extends Controller
{

    public function ViewPendingOrders()
    {
        $order = new PharmacyOrderModel;
        $med = new MedicineModel;
        $manu = new ManufactureModel;
        $supMed = new SupplierMedicineModel;
        $supmedids = array();
        $supids = $supMed->getSupMedIds($_SESSION['username']);
        while ($row1 = $supids->fetch_assoc()) {
            array_push($supmedids, $row1['medId']);
        }
        $result = $order->getPendingOrders();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $pharname = $order->getOrderPharm($id);
                $medid = $order->getMedId($id);
                if (in_array($medid, $supmedids)) {
                    $medname = $med->getName($medid);
                    $weight = $med->getWeight($medid);
                    $manid = $med->getManufacture($id);
                    $manname = $manu->getManufactureName($manid);
                    $qauntity = $order->getMedQuantiy($id);
                    $supmedq = $supMed->getQuantity($medid);
                    if ($supMed->getQuantity($medid) > $qauntity) {
                        echo "<form method='post' action='/supplier/accept'>";
                        echo " <input type='hidden' value='$medid' name='medid'/>";
                        echo " <input type='hidden' value='$qauntity' name='qauntity'/>";
                        echo " <input type='hidden' value='$id' name='orderid'/>";
                        echo "<tr><td>" . $id . "</td><td>" . $pharname . "</td><td>" . $medname . "</td><td>" . $weight . "</td><td>" . $manname . "</td><td>" . $qauntity . "</td><td><input type='submit' value='Accept' class='btn btn--primary'></td></tr></form>";

                    } else {
                        echo "<tr><td>" . $id . "</td><td>" . $pharname . "</td><td>" . $medname . "</td><td>" . $weight . "</td><td>" . $manname . "</td><td>" . $qauntity . "</td><td><h6><font color='#FF5854'>Insufficient Inventory</font></h6> </td></tr>";

                    }

                }

            }
        } else {
            echo "<tr><td colspan=7>No Orders to accept</td></tr>";
        }


    }

    public function AcceptOrder(Request $request)
    { {
            if ($request->isPost()) {
                $order = new PharmacyOrderModel;
                $orderid = $_POST['orderid'];
                $supmed = new SupplierMedicineModel;
                $medid = $_POST['medid'];
                $oldq = (int) $supmed->getQuantity($medid);
                $quantity = (int) $_POST['qauntity'];
                $newq = $oldq - $quantity;
                if ($supmed->acceptOrder($newq, $medid, $_SESSION['username']) && $order->acceptOrder($_SESSION['username'], $orderid)) {
                    echo (new \app\core\ExceptionHandler)->RequestSent();
                    return $this->render("/supplier/inventory.php");
                }
            }
        }

    }

}