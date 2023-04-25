<?php

use app\views\pharmacy\Components;
use app\controllers\pharmacy\PharmacyInventoryController;
use app\core\ExceptionHandler;

$components = new Components();
echo $components->viewHeader("Inventory");
echo $components->navBar($_SESSION['username']);
echo $components->sideBar('inventory');

?>


<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <div class="row" id="inventory-page-row">
            <div class="col" id="inventory-page-col">


                <div class="nav-search">
                    <form onclick= "() => {
						event.preventDefault();
						showMedicineRowOnSearch(event);
                          }">
                        <label for="search-medicine">Search for stuff</label>
                        <input id="search-medicine" placeholder="Search Medicine . . ." required type="search" onchange="showMedicineRowOnSearch(event)">
                        <button type="submit" onclick="showMedicineRowOnSearch(event)">Go</button>
                    </form>
                </div>

                <script>
                    function showMedicineRowOnSearch(event) {

                        // prevent default form submit
                        event.preventDefault();

                        // get search value
                        let search = document.getElementById('search-medicine').value;
                        let orderMedicineRows = document.getElementsByClassName('order-medicine-row');

                        for (let i = 0; i < orderMedicineRows.length; i++) {
                            orderMedicineRows[i].classList.remove('order-medicine-row-after');
                            orderMedicineRows[i].classList.add('order-medicine-row-before');
                        }
                        if (search === "") {
                            for (let i = 0; i < orderMedicineRows.length; i++) {
                                orderMedicineRows[i].classList.remove('order-medicine-row-before');
                                orderMedicineRows[i].classList.add('order-medicine-row-after');
                            }
                        }

                        let flag = false;
                        if (search !== "") {
                            for (let i = 0; i < orderMedicineRows.length; i++) {
                                let medicineId = orderMedicineRows[i].getAttribute('data-id');
                                if (medicineId.toLowerCase().includes(search.toLowerCase())) {
                                    // change class name
                                    orderMedicineRows[i].classList.remove('order-medicine-row-before');
                                    orderMedicineRows[i].classList.add('order-medicine-row-after');
                                    // document.getElementById('clear-filter').classList.remove('clear-filter-icon-hidden');
                                    flag = true;
                                } else {
                                    orderMedicineRows[i].classList.remove('order-medicine-row-after');
                                    orderMedicineRows[i].classList.add('order-medicine-row-before');
                                }
                            }
                            if (flag === false) {
                                swal("No medicine found", "Please try again", "error");
                            }
                        }
                    }
                </script>

                <!--                order table-->
                <div class=" orders">
                    <table id = "inventory-table">
                        <thead>
                            <tr>
                                <th>Medicine ID</th>
                                <th>Medicine Name</th>
                                <th>Medicine Scientific Name</th>
                                <th>Remaining Quantity</th>
                                <th>Buying Price</th>
                                <th>Selling Price</th>
                                <th>Remaining Days</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'pharmacy') {
                                try {
                                    $username = $_SESSION['username'];
                                    $pharmacyInventoryController = new PharmacyInventoryController();
                                    $stocks = $pharmacyInventoryController->getInventoryByUsername($username);
                                    if ($stocks) {
                                        foreach ($stocks as $stock) {
                                            echo "<tr" . " class='" . $pharmacyInventoryController->remainingDays($stock['remaining_days']) . " order-medicine-row order-medicine-row-after' data-id='" . $stock['medId'] . $stock['sciName'] . $stock['medName'] . "'>";
                                            echo "<td>" . $stock['medId'] . "</td>";
                                            echo "<td>" . $pharmacyInventoryController->transformMedicineName($stock['medId']) . "</td>";
                                            echo "<td>" . $stock['sciName'] . "</td>";
                                            echo "<td>" . $stock['remQty'] . "</td>";
                                            echo "<td>" . $stock['buying_price'] . "</td>";
                                            echo "<td>" . $stock['sellingPrice'] . "</td>";
                                            echo "<td>" . $stock['remaining_days'] . "</td>";
                                            echo "<td>" . "<a class='view-stock' id='" . $stock['id'] ."'>" . "<i class='fa-solid fa-circle-arrow-right view-order-details' style='color:#333333'></i>" . "</a>" . "</td>";
                                            echo "</a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr>";
                                        echo "<td colspan='7' style='text-align: center'>You don't have any medicine in your inventory</td>";
                                        echo "</tr>";
                                    }
                                } catch (Exception $e) {
                                    echo (new ExceptionHandler)->somethingWentWrong();
                                }
                            } else {
                                echo "<tr>";
                                echo "<td colspan='7' style='text-align: center'>You don't have any medicine in your inventory</td>";
                                echo "</tr>";
                                echo (new ExceptionHandler)->somethingWentWrong();
                            }


                            ?>
                        </tbody>
                    </table>
                </div>






            </div>



            <div id="order-new-medicine">
                <a class="btn ' . ($selectedPage == 'order-medicine' ? 'disabled' : '') . '" href="/pharmacy/order-medicine"> <i class="fa-solid fa-truck-moving"></i> Order Medicine </a>
            </div>

        </div>




    </div>

<script>
    function handleViewStockDetailsClick(id) {
        if (id == '') {
            swal("Something went wrong", "Please try again", "error");
        } else {

        }

    document.addEventListener('DOMContentLoaded', function() {
        var viewOrderButtons = document.getElementsByClassName('view-stock');
        for (var i = 0; i < viewOrderButtons.length; i++) {
            viewOrderButtons[i].addEventListener('click', function() {
                // pass id of the anchor tag to the function
                handleViewStockDetailsClick(this.id);
            });
        }
    });
</script>


</div>



</body>

</html>
