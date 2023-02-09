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
                    <form onsubmit="preventDefault();" role="search">
                        <label for="search">Search for stuff</label>
                        <input id="search" placeholder="Search Inventory . . ." required type="search" />
                        <button type="submit">Go</button>
                    </form>
                </div>


                <!-- <div class="filter-group">

                    <div class="filter-group">

                        <button class="btn btn-primary" id="pending">Pending</button>

                        <button class="btn btn-primary" id="accepted">Accepted</button>

                        <button class="btn btn-primary" id="rejected">Rejected</button>

                        <button class="btn btn-primary" id="delivered">Delivered</button>

                        <button class="btn btn-primary" id="cancelled">Cancelled</button>

                        <i class="fa-solid fa-filter-circle-xmark" style="color: #999999; font-size: 1.5rem; margin-left: 1rem; cursor: pointer;" id="clear-filter"></i>

                    </div>

                </div> -->

                <!--                order table-->
                <div class=" orders">
                    <table id = "inventory-table">
                        <thead>
                            <tr>
                                <th>Medicine ID</th>
                                <th>Medicine Name</th>
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
                                            echo "<tr" . " class='" . $pharmacyInventoryController->remainingDays($stock['remaining_days']) . "'>" . "</a>";
                                            echo "<td>" . $stock['medId'] . "</td>";
                                            echo "<td>" . $pharmacyInventoryController->transformMedicineName($stock['medId']) . "</td>";
                                            echo "<td>" . $stock['remQty'] . "</td>";
                                            echo "<td>" . $stock['buying_price'] . "</td>";
                                            echo "<td>" . $stock['sellingPrice'] . "</td>";
                                            echo "<td>" . $stock['remaining_days'] . "</td>";
                                            echo "<td>" . "<a href='' id='" . $stock['id'] . "'>" . "<i class='fa-solid fa-circle-arrow-right view-order-details' style='color:#333333'></i>" . "</a>" . "</td>";
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




</div>



</body>

</html>
