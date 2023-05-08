<?php

use app\controllers\pharmacy\PharmacyInventoryController;
use app\controllers\pharmacy\PharmacyOrderHistoryController;
use app\core\ExceptionHandler;
use app\views\pharmacy\Components;

$components = new Components();
echo $components->viewHeader("Dashboard");
echo $components->navBar($_SESSION['username']);
echo $components->sideBar('dashboard');

?>


<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">

        <?php if ($isVerified == 0) { ?>
            <div class="modal not-verified" role="alert">
                <strong>Warning!</strong> Your pharmacy is not verified yet. Please wait until the verification process is completed.
            </div>
        <?php } ?>


        <div class="dashboard-row">
            <div class="card g-col-4 g-row-1-start-1">
                <div class="card-body">
                    <h5 class="card-title">Sales in the Week</h5>
                    <p class="card-text">
                        <canvas id="myChart" style="width: 20vw; height: auto;"></canvas>

                        <script>
                            const username = document.getElementsByClassName('nav-profile-name')[0].innerHTML;
                            const api_call = "http://146.190.15.95/pharmacy/api/sales-by-day?pharmacyUsername=" + username;

                            fetch(api_call)
                                .then(response => response.json())
                                .then(data => {
                                    // Sort the data by invoice date in ascending order
                                    data.sort((a, b) => new Date(a.invoice_date) - new Date(b.invoice_date));

                                    const labels = data.map(item => item.date);
                                    const values = data.map(item => item.total);

                                    console.log(labels);
                                    console.log(values);

                                    // Create the chart
                                    const ctx = document.getElementById('myChart').getContext('2d');
                                    const myChart = new Chart(ctx, {
                                        type: 'line',
                                        data: {
                                            labels: labels,
                                            datasets: [{
                                                label: 'Total Sales',
                                                data: values,
                                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    }
                                                }]
                                            }
                                        }
                                    });
                                });


                        </script>


                    </p>
                </div>
            </div>

            <div class="card g-col-4 g-row-1-start-1">
                <div class="card-body">
                    <h5 class="card-title">Sales and Cost <?php echo date("F"); ?></h5>
                    <p class="card-text">
                        <canvas id="sales-and-cost" style="max-height: 25vh"></canvas>

                        <script>
                            const salescost = "http://146.190.15.95/pharmacy/api/sales-and-cost-for-current-month?pharmacyUsername=" + username;

                            // Fetch the data and create the chart
                            fetch(salescost)
                                .then(response => response.json())
                                .then(data => {

                                    console.log(data);
                                    // Get the sales and cost data from the response
                                    const sales = data.sales;
                                    const cost = data.cost;

                                    // Create the chart
                                    const ctx = document.getElementById('sales-and-cost').getContext('2d');
                                    const myChart = new Chart(ctx, {
                                        type: 'doughnut',
                                        data: {
                                            labels: ['Sales', 'Cost'],
                                            datasets: [{
                                                label: 'Sales vs. Cost',
                                                data: [sales, cost],
                                                backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                                                borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            legend: {
                                                display: true,
                                                position: 'bottom'
                                            }
                                        }
                                    });
                                });
                        </script>


                    </p>
                </div>
            </div>

            <div class="card g-col-4 g-row-1-start-1">
                <div class="card-body">
<!--                    // order summary for current month-->
                    <h5 class="card-title">Orders Summary <?php echo date("F"); ?></h5>
                    <p class="card-text">
                        <table>
                        <tr>
                            <td>Pending Orders</td>
                            <td><?php echo $pendingOrders ?></td>
                        </tr>
                        <tr>
                            <td>Accepted Orders</td>
                            <td><?php echo $acceptedOrders ?></td>
                        </tr>
                        <tr>
                            <td>Delivering Orders</td>
                            <td><?php echo $deliveringOrders ?></td>
                        </tr>
                        <tr>
                            <td>Delivered Orders</td>
                            <td><?php echo $deliveredOrders ?></td>
                        </tr>
                        <tr>
                            <td>Rejected Orders</td>
                            <td><?php echo $rejectedOrders ?></td>
                        </tr>
                        <tr>
                            <td>Cancelled Orders</td>
                            <td><?php echo $cancelledOrders ?></td>
                        </tr>
                        <tr>
                            <td>Total Orders</td>
                            <td><?php echo $totalOrders ?></td>
                        </tr>
                    </table>
                    </p>
                </div>
            </div>
        </div>


        <div class="row" id="inventory-page-row">
            <div class="col" id="inventory-page-col">

                <div class=" orders">
                    <table id="inventory-table">
                        <thead>
                        <tr>
                            <th style="width: 1%;">Medicine ID</th>
                            <th>Medicine Name</th>
                            <th style="width: 1%">Remaining Quantity</th>
                            <th style="width: 1%">Buying Price</th>
                            <th style="width: 1%">Selling Price</th>
                            <th style="width: 1%">Remaining Days</th>
                            <th style="width: 1%"></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'pharmacy') {
                            try {
                                $username = $_SESSION['username'];
                                $pharmacyInventoryController = new PharmacyInventoryController();
                                $stocks = $pharmacyInventoryController->getInventoryByUsernameForDashboard($username);
                                if ($stocks) {
                                    foreach ($stocks as $stock) {
                                        echo "<tr" . " class='" . $pharmacyInventoryController->remainingDays($stock['remaining_days']) . "'>" . "</a>";
                                        echo "<td>" . $stock['medId'] . "</td>";
                                        echo "<td>" . $pharmacyInventoryController->transformMedicineName($stock['medId']) . "</td>";
                                        echo "<td>" . $stock['remQty'] . "</td>";
                                        echo "<td>" . $stock['buying_price'] . "</td>";
                                        echo "<td>" . $stock['sellingPrice'] . "</td>";
                                        echo "<td>" . $stock['remaining_days'] . "</td>";
                                        echo "<td>" . "<a href='/pharmacy/inventory' id='" . $stock['id'] . "'>" . "<i class='fa-solid fa-circle-arrow-right view-order-details' style='color:#333333'></i>" . "</a>" . "</td>";
                                        echo "</a>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='7' style='text-align: center'>You don't have any medicine required to be ordered</td>";
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


<!--                <div class=" orders">-->
<!--                    <table id="orders-table">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th>Order ID</th>-->
<!--                            <th>Order Date</th>-->
<!--                            <th>Order Status</th>-->
<!--                            <th>Order Total</th>-->
<!--                            <th>Delivery Date</th>-->
<!--                            <th></th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!---->
<!--                        --><?php
//
//                        if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'pharmacy') {
//                            try {
//                                $username = $_SESSION['username'];
//                                $pharmacyOrderHistoryController = new PharmacyOrderHistoryController();
//                                $orders = $pharmacyOrderHistoryController->getOrdersByUsernameForDashboard($username);
//                                if ($orders) {
//                                    foreach ($orders as $order) {
//                                        echo "<tr" . " class='" . $pharmacyOrderHistoryController->transformOrderStatus($order['order_status']) . "'>";
//                                        echo "<td>" . $order['id'] . "</td>";
//                                        echo "<td>" . $order['order_date'] . "</td>";
//                                        echo "<td>" . $pharmacyOrderHistoryController->transformOrderStatus($order['order_status']) . "</td>";
//                                        echo "<td>" . $pharmacyOrderHistoryController->transformOrderTotal($order['order_total']) . "</td>";
//                                        echo "<td>" . $pharmacyOrderHistoryController->transformDeliveryDate($order['delivery_date']) . "</td>";
//                                        echo "<td>" . "<a href='' id='" . $order['id'] . "'>" . "<i class='fa-solid fa-circle-arrow-right view-order-details' style='color:#333333'></i>" . "</a>" . "</td>";
//                                        echo "</a>";
//                                        echo "</tr>";
//                                    }
//                                } else {
//                                    echo "<tr>";
//                                    echo "<td colspan='6' style='text-align: center'>You don't have any orders</td>";
//                                    echo "</tr>";
//                                }
//                            } catch (Exception $e) {
//                                echo (new ExceptionHandler)->somethingWentWrong();
//                            }
//                        } else {
//                            echo "<tr>";
//                            echo "<td colspan='6' style='text-align: center'>You don't have any orders</td>";
//                            echo "</tr>";
//                            echo (new ExceptionHandler)->somethingWentWrong();
//                        }
//
//
//                        ?>
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->

            </div>
        </div>
    </div>
</div>

</body>

</html>
