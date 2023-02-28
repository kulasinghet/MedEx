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
        $supmed = new SupplierMedicineModel;
        $result = $order->getPendingOrders();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $pharname = $order->getPendingOrderPharm($id);
                $medid = $order->getPendingMedId($id);
                $medname = $med->getName($medid);
                $weight = $med->getWeight($medid);
                $manid = $med->getManufacture($id);
                $manname = $manu->getManufactureName($manid);
                $qauntity = $order->getPendingMedQuantiy($id);
                if ($supmed->getQuantity($medid) > $qauntity) {
                    echo "<form method='post' action='/supplier/accept'>";
                    echo " <input type='hidden' value='$medid' name='medid'/>";
                    echo " <input type='hidden' value='$qauntity' name='qauntity'/>";
                    echo " <input type='hidden' value='$id' name='orderid'/>";
                    echo "<tr><td>" . $id . "</td><td>" . $pharname . "</td><td>" . $medname . "</td><td>" . $weight . "</td><td>" . $manname . "</td><td>" . $qauntity . "</td><td><input type='submit' value='Accept' class='btn btn--primary'></td></tr></form>";

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