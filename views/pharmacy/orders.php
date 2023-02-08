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
        <div class="row">
            <div class="col">


                <div class="orders">
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
