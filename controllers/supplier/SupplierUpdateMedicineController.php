<?php
namespace app\controllers\supplier;

use app\core\Controller;
use app\core\Request;
use app\models\MedicineModel;
use app\models\SupplierMedicineModel;
use app\models\ManufactureModel;


class SupplierUpdateMedicineController extends Controller
{

    // Delete Medicine from Database
    public function deleteMed(Request $request)
    {
        if ($request->isPost()) {
            $id = $_POST['DelmedId'];
            $supName = $_SESSION['username'];
            $supmed = new SupplierMedicineModel;
            if ($supmed->DeleteMed($supName, $id)) {
                return $this->render("/supplier/update-inventory.php");
            }

        }
        return $this->render('/supplier/update-inventory.php');
    }

    // Update Medicine in DB
    public function updateMed(Request $request)
    {
        if ($request->isPost()) {
            $id = $_POST['medId'];
            $quantity = $_POST['quantity'];
            $unitPrice = $_POST['unitPrice'];
            $supName = $_SESSION['username'];
            $supmed = new SupplierMedicineModel;
            if ($supmed->UpdateMed($supName, $id, $unitPrice, $quantity)) {
                return $this->render("/supplier/update-inventory.php");
            } else {
                return $this->render('/supplier/update-inventory.php');
            }

        }
    }

    // Update Inventory Invetory Display
    public function updateInventory($supName)
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
                $quantity = $row["quantity"];
                $unitPrice = $row["unitPrice"];
                $manid = $med->getManufacture($medid);
                $manname = $man->getManufactureName($manid);
                echo "<tr><td>" . $medNam . "</td><td>" . $sciName . "</td><td>" . $weight . " mg</td><td>" . $manname . "</td><td>" . $quantity . "</td><td>" . $unitPrice . "</td><td><a href='#' onclick='event.preventDefault(); confirmUpdate(\"" . $medid . "\", \"" . $medNam . "\", \"" . $sciName . "\", \"" . $weight . "\", \"" . $quantity . "\", \"" . $unitPrice . "\", \"" . $manname . "\")'><i class='fa fa-pencil'></i></a></td><td><a href='#' onclick=' event.preventDefault();confirmDelete(\"" . $medid . "\")'><i class='fa fa-trash'></i></a></td></tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='padding:2%;'> No Medicine Added</td>";
        }
    }


}
?>
<div id="DelModal" class="modal">
    <!--Delete Modal content -->
    <div class="modal-content">
        <span class="delclose">&times;</span>
        <form method='post' action='/supplier/delete-medicine'>
            <h5>Are you sure you want to delete this item from your inventory?</h5>
            <input type="hidden" id="DelmedId" name="DelmedId" value="">
            <button id="delconfirmBtn" class='btn btn-primary' type="submit">Yes</button>
        </form>
        <button id="delcancelBtn" class='btn btn-primary'>No</button>
    </div>
</div>

<div id="UpdateModal" class="modal">
    <!--Update Modal content -->
    <div class="modal-content">
        <span class="updateclose">&times;</span>
        <h5>Update Medicine</h5>
        <form id="updateForm" method='post' action='/supplier/update-medicine'>
            <input type="hidden" id="medId" name="medId" value="">
            <label for="medNam" style="display: block; padding: 1%; text-align: left;">Medicine Name:</label>
            <input type="text" id="medNam" name="medNam" value="" disabled class='form-input' style='width:60%;'>
            <label for="sciName" style="display: block; padding: 1%; text-align: left;">Scientific Name:</label>
            <input type="text" id="sciName" name="sciName" value="" disabled class='form-input' style='width:60%;'>
            <label for="weight" style="display: block; padding: 1%; text-align: left;">Weight (mg):</label>
            <input type="number" id="weight" name="weight" value="" disabled class='form-input' style='width:60%;'>
            <label for="manname" style="display: block; padding: 1%; text-align: left;">Manufacturer Name:</label>
            <input type="text" id="manname" name="manname" value="" disabled class='form-input' style='width:60%;'>
            <label for="quantity" style="display: block; padding: 1%; text-align: left;">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="" class='form-input' style='width:60%;'>
            <label for="unitPrice" style="display: block; padding: 1%; text-align: left;">Unit Price:</label>
            <input type="number" id="unitPrice" name="unitPrice" value="" class='form-input' style='width:60%;'>
            <button id="updateconfirmBtn" class='btn btn-primary' type="submit">Update</button>
        </form>
        <button id="updatecancelBtn" class='btn btn-primary'>Cancel</button>
    </div>
</div>

<script>
    var delmodal = document.getElementById("DelModal");
    var delspan = document.getElementsByClassName("delclose")[0];
    var delcancelBtn = document.getElementById("delcancelBtn");
    var delconfirmBtn = document.getElementById("delconfirmBtn");
    var DelmedId;

    function confirmDelete(DelmedId) {
        DelmedIdValue = DelmedId;
        delmodal.style.display = "block";
        document.getElementById("DelmedId").value = DelmedId;
    }

    delspan.onclick = function () {
        delmodal.style.display = "none";
    }

    delcancelBtn.onclick = function () {
        delmodal.style.display = "none";
    }

    delconfirmBtn.onclick = function () {
        // Execute the form submission when the button is clicked
        delmodal.style.display = "block";
    }

    //UpdateModal Handling

    var updatemodal = document.getElementById("UpdateModal");
    var updatespan = document.getElementsByClassName("updateclose")[0];
    var updatecancelBtn = document.getElementById("updatecancelBtn");
    var updateconfirmBtn = document.getElementById("updateconfirmBtn");
    var medId;
    var medNamValue;
    var sciNameValue;
    var weightValue;
    var quantityValue;
    var unitPriceValue;
    var mannameValue;

    function confirmUpdate(medId, medNam, sciName, weight, quantity, unitPrice, manname) {
        medIdValue = medId;
        medNamValue = medNam;
        sciNameValue = sciName;
        weightValue = weight;
        quantityValue = quantity;
        unitPriceValue = unitPrice;
        mannameValue = manname;
        updatemodal.style.display = "block";
        // Set the values in the modal
        document.getElementById("medId").value = medId;
        document.getElementById("medNam").value = medNam;
        document.getElementById("sciName").value = sciName;
        document.getElementById("weight").value = weight;
        document.getElementById("quantity").value = quantity;
        document.getElementById("unitPrice").value = unitPrice;
        document.getElementById("manname").value = manname;
    }

    updatespan.onclick = function () {
        updatemodal.style.display = "none";
    }

    updatecancelBtn.onclick = function () {
        updatemodal.style.display = "none";
    }

    updateconfirmBtn.onclick = function () {
        // Execute the form submission when the button is clicked
        updatemodal.style.display = "block";
    }
</script>