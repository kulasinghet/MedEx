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
        include("../../public/views/supplier/deletemedmodal.php");
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
                echo "<tr><td>" . $medNam . "</td><td>" . $sciName . "</td><td>" . $weight . " mg</td><td>" . $manname . "</td><td>" . $quantity . "</td><td>" . $unitPrice . "</td><td><a href='#'><i class='fa fa-pencil'></i></a></td><td><a href='#' onclick=' event.preventDefault();confirmDelete()'><i class='fa fa-trash'></i></a></td></tr>";
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
        <span class="close">&times;</span>
        <form method='post' action='/supplier/delete-medicine'>
            <p>Are you sure you want to delete this item from your inventory?</p>
            <input type='hidden' value="<?php echo $_SESSION['medid']; ?>" name='id' />
            <button id="confirmBtn" class='btn btn-primary' type="submit">Yes</button>
        </form>
        <button id="cancelBtn" class='btn btn-primary'>No</button>
    </div>
</div>

<script>
    var modal = document.getElementById("DelModal");
    var span = document.getElementsByClassName("close")[0];
    var cancelBtn = document.getElementById("cancelBtn");
    var confirmBtn = document.getElementById("confirmBtn");

    function confirmDelete() {
        modal.style.display = "block";
    }

    span.onclick = function () {
        modal.style.display = "none";
    }

    cancelBtn.onclick = function () {
        modal.style.display = "none";
    }

    confirmBtn.onclick = function () {
        // Execute the form submission when the button is clicked
        document.querySelector("form").submit();
        modal.style.display = "block";

        // Hide the modal after the form is submitted
        modal.style.display = "none";
    }

</script>