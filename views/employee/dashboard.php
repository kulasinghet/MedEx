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
                <h5 class="card-title">Income (02/03 - today)</h5>
                <div class="row">
                    <canvas id="chart-income"></canvas>
                </div>
                <script>
                    const ctx = document.getElementById('chart-income');
                    const xValues = ['03', '04', '05', '06', '07', '08', '09'];
                    const yValues = [100000, 150000, 125000, 300000, 80000, 276500, 220067];

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: xValues,
                            datasets: [{
                                label: 'Daily Income (Rs)',
                                data: yValues,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<!-- Section: Dashboard Layout -->
</body>
</html>