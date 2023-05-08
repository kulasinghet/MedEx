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
    <div class="canvas-inner grid flow-row-dense">
        <!-- Counters -->
        <div class="g-col-2-start-1 g-row-2-start-1 counters">
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

        <div class="g-col-5-start-3 g-row-2-start-1 card revenue">
            <div class="card-body">
                <canvas id="daily-revenue" style="max-height: 50vh"></canvas>
                <script>
                    const revenue = "/employee/dashboard/revenue";

                    // Fetch the data and create the chart
                    fetch(revenue)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);

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
                                        label: 'Daily Revenue of all the pharmacies',
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
    </div>
</div>
<!-- Section: Dashboard Layout -->

<!-- Section: Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>