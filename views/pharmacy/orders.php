<?php

use app\controllers\pharmacy\PharmacyOrderHistoryController;
use app\core\ExceptionHandler;
use app\views\pharmacy\Components;

$components = new Components();
echo $components->viewHeader("Order History");
echo $components->navBar($_SESSION['username']);
echo $components->sideBar('orders');
?>


<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <div class="row" id="orders-page-row">
            <div class="col" id="orders-page-col">

                <div class="nav-search">
                    <form onsubmit="preventDefault();" role="search">
                        <label for="search">Search for stuff</label>
                        <input id="search" placeholder="Search Orders ..." required type="search" />
                        <button type="submit">Go</button>
                    </form>
                </div>


                <div class="filter-group">


                    <!-- <form style="width: auto;">
                        <input type="radio" class="form-input" id="pending" name="order-status" value="pending">
                        <label class="form-check-label" for="pending">Pending</label>


                        <input type="radio" class="form-input" id="accepted" name="order-status" value="accepted">
                        <label class="form-check-label" for="accepted">Accepted</label>


                        <input type="radio" class="form-input" id="rejected" name="order-status" value="rejected">
                        <label class="form-check-label" for="rejected">Rejected</label>


                        <input type="radio" class="form-input" id="delivered" name="order-status" value="delivered">
                        <label class="form-check-label" for="delivered">Delivered</label>


                        <input type="radio" class="form-input" id="cancelled" name="order-status" value="cancelled">
                        <label class="form-check-label" for="cancelled">Cancelled</label>

                        <i class="fa-solid fa-filter-circle-xmark" style="color: #333333; font-size: 1.5rem; margin-left: 1rem; cursor: pointer;" id="clear-filter"></i>
                    </form> -->

                    <div class="filter-group">

                        <button class="btn btn-primary" id="pending">Pending</button>

                        <button class="btn btn-primary" id="accepted">Accepted</button>

                        <button class="btn btn-primary" id="rejected">Rejected</button>

                        <button class="btn btn-primary" id="delivered">Delivered</button>

                        <button class="btn btn-primary" id="cancelled">Cancelled</button>

                        <i class="fa-solid fa-filter-circle-xmark" style="color: #999999; font-size: 1.5rem; margin-left: 1rem; cursor: pointer;" id="clear-filter"></i>

                    </div>

                </div>

                <!--                order table-->
                <div class=" orders">
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Order Total</th>
                                <th>Delivery Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'pharmacy') {
                                try {
                                    $username = $_SESSION['username'];
                                    $pharmacyOrderHistoryController = new PharmacyOrderHistoryController();
                                    $orders = $pharmacyOrderHistoryController->getOrdersByUsername($username);
                                    if ($orders) {
                                        foreach ($orders as $order) {
                                            echo "<tr>";
                                            echo "<td>" . $order['id'] . "</td>";
                                            echo "<td>" . $order['order_date'] . "</td>";
                                            echo "<td>" . $pharmacyOrderHistoryController->transformOrderStatus($order['order_status']) . "</td>";
                                            echo "<td>" . $pharmacyOrderHistoryController->transformOrderTotal($order['order_total']) . "</td>";
                                            echo "<td>" . $pharmacyOrderHistoryController->transformDeliveryDate($order['delivery_date']) . "</td>";
                                            echo "<td>" . "<a href='' id='" . $order['id'] . "'>" . "<i class='fa-solid fa-circle-arrow-right view-order-details' style='color:#333333'></i>" . "</a>" . "</td>";
                                            echo "</a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr>";
                                        echo "<td colspan='6' style='text-align: center'>You don't have any orders</td>";
                                        echo "</tr>";
                                    }
                                } catch (Exception $e) {
                                    echo (new ExceptionHandler)->somethingWentWrong();
                                }
                            } else {
                                echo "<tr>";
                                echo "<td colspan='6' style='text-align: center'>You don't have any orders</td>";
                                echo "</tr>";
                                echo (new ExceptionHandler)->somethingWentWrong();
                            }


                            ?>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>

</body>

</html>