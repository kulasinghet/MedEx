<?php
namespace app\controllers\supplier;

use app\core\Controller;
use app\core\Request;
use app\models\MedicineModel;
use app\models\SupplierMedicineModel;
use app\models\ManufactureModel;

class SupplierUpdateMedicineController extends Controller
{

    public function deleteMed(Request $request)
    {
        if ($request->isPost()) {
            $id = $request->getBody()['id'];
            $supmed = new SupplierMedicineModel;
            $supName = $_SESSION['username'];
            $supmed->unitPrice = 0;
            if ($supmed->DeleteMed($supName, $id)) {
                echo (new \app\core\ExceptionHandler)->DeleteCompleted();
                return $this->render("/supplier/update-inventory.php");
            }

        }
        return $this->render('/supplier/update-inventory.php');
    }

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
                $_SESSION['medid'] = $row["medId"];
                echo "<tr><td>" . $medNam . "</td><td>" . $sciName . "</td><td>" . $weight . " mg</td><td>" . $manname . "</td><td>" . $quantity . "</td><td>" . $unitPrice . "</td><td><a href='#' onclick=' event.preventDefault(); confirmUpdate()'><i class='fa fa-pencil'></i></a></td><td><a href='#' onclick=' event.preventDefault();confirmDelete()'><i class='fa fa-trash'></i></a></td></tr>";
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
            <h4>Are you sure you want to delete this item from your inventory?</h4>
            <input type='hidden' value="<?php echo $_SESSION['medid']; ?>" name='id' />
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
        <?php
        $med = new MedicineModel;
        $supMed = new SupplierMedicineModel;
        $man = new ManufactureModel;
        $value = $_SESSION['medid'];
        $medName = $med->getName($value);
        $sciName = $med->getSciname($value);
        $weight = $med->getWeight($value);
        $result1 = $supMed->getQty($_SESSION['username'], $value);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $quantity = $row1["quantity"];
            }
        }
        $result2 = $supMed->getUnitPrice($_SESSION['username'], $value);
        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                $unitPrice = $row2["unitPrice"];
            }
        }
        $manid = $med->getManufacture($value);
        $manname = $man->getManufactureName($manid);
        echo "<form method='post' action='/supplier/update-medicine'>
            <h6 style='text-align: left; padding:1%;'>Medicine Name:</h6>
            <input type='text' disabled class='form-input' style='width:60%;' value='$medName'>
            <h6 style='text-align: left; padding:1%;'>Scientific Name:</h6>
            <input type='text' disabled class='form-input' style='width:60%;' value='$sciName'>
            <h6 style='text-align: left; padding:1%;'>Weight:</h6>
            <input type='text' disabled class='form-input' style='width:60%;' value='$weight'>
            <h6 style='text-align: left; padding:1%;'>Mannufacture:</h6>
            <input type='text' disabled class='form-input' style='width:60%;' value='$manname'>
            <h6 style='text-align: left; padding:1%;'>Quantity:</h6>
            <input type='text' name='qty' class='form-input' style='width:60%;' value='$quantity'>
            <h6 style='text-align: left; padding:1%;'>Unit Price:</h6>
            <input type='text' name='unitp' class='form-input' style='width:60%;' value='$unitPrice'>

            <button id='updateconfirmBtn' class='btn btn-primary' type='submit'>Update</button>
        </form>"; ?>
        <button id="updatecancelBtn" class='btn btn-primary'>Cancel</button>
    </div>
</div>

<script>
    var delmodal = document.getElementById("DelModal");
    var delspan = document.getElementsByClassName("delclose")[0];
    var delcancelBtn = document.getElementById("delcancelBtn");
    var delconfirmBtn = document.getElementById("delconfirmBtn");

    function confirmDelete() {
        delmodal.style.display = "block";
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

    function confirmUpdate() {
        updatemodal.style.display = "block";
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