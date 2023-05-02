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
                    $volume = $med->getVolume($medid);
                    $manid = $med->getManufacture($id);
                    $manname = $manu->getManufactureName($manid);
                    $qauntity = $order->getMedQuantiy($id);
                    if ($supMed->getQuantity($medid) > $qauntity) {
                        if ($weight > 0) {
                            $mass = $weight;
                            echo "<tr><td>" . $id . "</td><td>" . $pharname . "</td><td>" . $medname . "</td><td>" . $weight . "</td><td>" . $manname . "</td><td>" . $qauntity . "</td><td><input type='submit' value='Accept' class='btn btn--primary' onclick='event.preventDefault(); confirmAccept(\"" . $id . "\", \"" . $medname . "\", \"" . $mass . "\", \"" . $manname . "\", \"" . $qauntity . "\", \"" . $medid . "\")'></td></tr></form>";
                        } else {
                            $mass = $volume;
                            echo "<tr><td>" . $id . "</td><td>" . $pharname . "</td><td>" . $medname . "</td><td>" . $volume . "</td><td>" . $manname . "</td><td>" . $qauntity . "</td><td><input type='submit' value='Accept' class='btn btn--primary' onclick='event.preventDefault(); confirmAccept(\"" . $id . "\",  \"" . $medname . "\", \"" . $mass . "\", \"" . $manname . "\", \"" . $qauntity . "\", \"" . $medid . "\")'></td></tr></form>";
                        }
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
                $orderid = $_POST['orderId'];
                $supmed = new SupplierMedicineModel;
                $medid = $_POST['medId'];
                $oldq = (int) $supmed->getQuantity($medid);
                $quantity = (int) $_POST['quantity'];
                $newq = $oldq - $quantity;
                $bnumber = $_POST['batch'];
                $expdate = $_POST['expdate'];
                if ($order->acceptOrder($_SESSION['username'], $orderid, $bnumber, $expdate) && $supmed->acceptOrder($newq, $medid, $_SESSION['username'])) {
                    echo (new \app\core\ExceptionHandler)->OrderAccepted();
                    return $this->render("/supplier/accept-orders.php");
                } else {
                    return $this->render("/supplier/accept-orders.php");
                }
            }
        }

    }

}

?>

<div id="AcceptModal" class="modal">
    <!--Update Modal content -->
    <div class="modal-content">
        <span class="acceptclose">&times;</span>
        <h5>Accept Order</h5>
        <form id="acceptOrder" method='post' action='/supplier/accept'>
            <input type="hidden" id="medId" name="medId" value="">
            <input type="hidden" id="orderId" name="orderId" value="">
            <label for="medName" style="display: block; padding: 0.5%; text-align: left;">Medicine Name:</label>
            <input type="text" id="medName" name="medName" value="" disabled class='form-input' style='width:60%;'>
            <label for="mass" style="display: block; padding: 0.5%; text-align: left;">Weight(mg)/Volume(ml):</label>
            <input type="number" id="mass" name="mass" value="" disabled class='form-input' style='width:60%;'>
            <label for="manname" style="display: block; padding: 0.5%; text-align: left;">Manufacturer Name:</label>
            <input type="text" id="manname" name="manname" value="" disabled class='form-input' style='width:60%;'>
            <label for="quantity" style="display: block; padding: 0.5%; text-align: left;">Quantity:</label>
            <input type="text" id="quantity" name="quantity" value="" disabled class='form-input' style='width:60%;'>
            <label for="batch" style="display: block; padding: 0.5%; text-align: left;">Batch Number:</label>
            <input type="text" id="batch" name="batch" value="" class='form-input' style='width:60%;' required>
            <label for="expdate" style="display: block; padding: 0.5%; text-align: left;">Expiration date:</label>
            <input type="date" id="expdate" name="expdate" value="" class='form-input' style='width:60%;' required>
            <button id="acceptconfirmBtn" class='btn btn-primary' type="submit">Accept</button>
        </form>
        <button id="acceptecancelBtn" class='btn btn-primary'>Cancel</button>
    </div>
</div>

<script>
    var acceptmodal = document.getElementById("AcceptModal");
    var acceptspan = document.getElementsByClassName("acceptclose")[0];
    var acceptecancelBtn = document.getElementById("acceptecancelBtn");
    var acceptconfirmBtn = document.getElementById("acceptconfirmBtn");
    var orderIdValue;
    var medNameValue;
    var massValue;
    var mannameValue
    var quantityValue;;
    var medIdValue;

    function confirmAccept(orderId, medName, mass, manname, quantity, medId) {
        orderIdValue = orderId;
        medNamValue = medName;
        massValue = mass;
        mannameValue = manname;
        quantityValue = quantity;
        medIdValue = medId;
        acceptmodal.style.display = "block";
        // Set the values in the modal
        document.getElementById("orderId").value = orderId;
        document.getElementById("medName").value = medName;
        document.getElementById("mass").value = mass;
        document.getElementById("quantity").value = quantity;
        document.getElementById("manname").value = manname;
        document.getElementById("medId").value = medId;
        const dateInput = document.getElementById("expdate");
        const currentDate = new Date();
        const minDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate() + 7);
        dateInput.setAttribute("min", minDate.toISOString().slice(0, 10));


    }

    acceptspan.onclick = function () {
        acceptmodal.style.display = "none";
    }

    acceptecancelBtn.onclick = function () {
        acceptmodal.style.display = "none";
    }

    acceptconfirmBtn.onclick = function () {
        // Execute the form submission when the button is clicked
        acceptmodal.style.display = "block";
    }
</script>