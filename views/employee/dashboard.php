<?php
use \app\views\employee\EmployeeViewComponents;

$components = new EmployeeViewComponents();
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
        <div class="g-col-1-start-1 g-row-2 card">
            <div class="card-body status-view">
                <h5 class="card-title">Status</h5>
                <div class="row">
                    <div class="col"> Medicines </div>
                    <div class="col"> 1024 </div>
                </div>
                <div class="row">
                    <div class="col"> Pharmacies </div>
                    <div class="col"> 52 </div>
                </div>
                <div class="row">
                    <div class="col"> Delivery Persons </div>
                    <div class="col"> 46 </div>
                </div>
            </div>
        </div>
        <div class="g-col-1-start-2 g-row-2 card analysed">
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