<?php

use app\controllers\employee\EmployeeDashboardController;
use \app\views\employee\EmployeeViewComponents;

$components = new EmployeeViewComponents();
$controller = new EmployeeDashboardController();

$counters = $controller->getCounters();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin - Dashboard</title>

    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- g28 style -->
    <link rel="stylesheet" href="scss/main.css" />
    <link rel="stylesheet" href="/scss/vendor/employee.css" />
    <script src="js/g28-main.js"></script>
</head>
<body>
<!-- Section: Fixed Components -->
<?php
echo $components->createSidebar('home');
echo $components->createNavbar();
?>
<!-- Section: Fixed Components -->

<!-- Section: Dashboard Layout -->
<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <div class="row master">
            <!-- Counters -->
            <div class="col counters">
                <div class="row">
                    <div class="col">
                        <div class="card counter">
                            <div class="card-body">
                                <h5><?php echo $counters['pharmacy'] ?></h5>
                                <span>Pharmacies</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card counter">
                            <div class="card-body">
                                <h5><?php echo $counters['supplier'] ?></h5>
                                <span>Suppliers</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card counter">
                            <div class="card-body">
                                <h5><?php echo $counters['delivery'] ?></h5>
                                <span>Delivery Partners</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card counter">
                            <div class="card-body">
                                <h5><?php echo $counters['lab'] ?></h5>
                                <span>Laboratories</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Counters -->

            <!-- Daily Revenue -->
            <div class="col card revenue">
                <div class="card-body">
                    <h5 class="card-title">Daily Revenue of all the pharmacies</h5>
                    <canvas id="daily-revenue" style="max-height: 32vh"></canvas>
                    <script>
                        const revenue = "/employee/dashboard/revenue";

                        // Fetch the data and create the chart
                        fetch(revenue)
                            .then(response => response.json())
                            .then(data => {
                                let convertedData = data.slice(-7);
                                convertedData = convertedData.map(obj => {
                                    const full_date = obj.revenue_date;
                                    const revenue = obj.daily_revenue;

                                    // Convert date format from 'YYYY-MM-DD' to 'MM-DD'
                                    const date = full_date.substring(5);

                                    return { date, revenue };
                                });

                                // Create the chart
                                const ctx = document.getElementById('daily-revenue').getContext('2d');
                                const myChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: ['Date', 'Revenue'],
                                        datasets: [{
                                            label: 'Total Revenue',
                                            data: convertedData,
                                            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                                            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        parsing: {
                                            xAxisKey: 'date',
                                            yAxisKey: 'revenue'
                                        },
                                        legend: {
                                            display: true,
                                            position: 'bottom'
                                        }
                                    }
                                });
                            });
                    </script>
                </div>
            </div>
            <!-- Daily Revenue -->
        </div>
        <div class="row">
            <!-- Pharmacy Orders -->
            <div class="col card pharmacy-orders">
                <div class="card-body">
                    <h5 class="card-title">Latest Pharmacy orders</h5>
                    <table class="table approval-table">
                        <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Pharmacy Username</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        try {
                            $order_list = $controller->getPharmacyOrders();
                            if (!empty($order_list)) {
                                for ($i = 0; $i < 5; $i++) {
                                    if (array_key_exists($i, $order_list)) {
                                        $data = $order_list[$i];
                                        $data_row = "
                                    <tr>
                                        <td>$data->id</td>
                                        <td>$data->pharmacyUsername</td>
                                        <td>$data->order_date</td>
                                        <td>$data->status</td>
                                    </tr>";
                                        echo $data_row;
                                    } else {
                                        echo "<tr class='empty'>";
                                        echo "<td colspan='5'></td>";
                                        echo "</tr>";
                                    }
                                }
                            } else {
                                echo "<tr class='empty'>";
                                echo "<td class='no-data' colspan='5' rowspan='5'>No records found!</td>";
                                echo "</tr>";
                                for ($i = 0; $i < no_of_reports - 1; $i++) {
                                    echo "<tr></tr>";
                                }
                            }
                        } catch (Exception $e) {
                            echo "Something went wrong! $e";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Pharmacy Orders -->
    </div>
</div>
<!-- Section: Dashboard Layout -->

<!-- Section: Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>