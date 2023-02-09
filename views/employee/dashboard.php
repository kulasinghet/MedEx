<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin - Dashboard</title>

    <link href="scss/main.css" rel="stylesheet"/>
    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<!-- Section: Fixed Components -->
<div class="sidebar-new">
    <div class="sidebar-inner">
        <nav class="sidebar-header">
            <div class="sidebar-logo">
                <a href="#">
                    <img alt="MedEx logo" src="res/logo/logo-text_light.svg"/>
                </a>
            </div>
        </nav>
        <div class="sidebar-context">
            <h6 class="sidebar-context-title">Menu</h6>
            <ul class="main-buttons">
                <li class="disabled">
                    <a href="/dashboard"> <i class="fa-solid fa-house"></i> Home </a>
                </li>
                <li>
                    <a href="/employee/approvals/pharmacy"> <i class="fa-solid fa-check"></i> Confirmations </a>
                    <ul class="hidden">
                        <li>SubMenu Item 2</li>
                        <li>SubMenu Item 2</li>
                        <li>SubMenu Item 2</li>
                        <li>SubMenu Item 2</li>
                    </ul>
                </li>
                <li>
                    <a href="/employee/reports"> <i class="fa-solid fa-newspaper"></i> Reports </a>
                </li>
                <li>
                    <a href="#"> <i class="fa-solid fa-server"></i> Resources </a>
                    <ul class="hidden">
                        <li>SubMenu Item 3</li>
                        <li>SubMenu Item 3</li>
                        <li>SubMenu Item 3</li>
                        <li>SubMenu Item 3</li>
                    </ul>
                </li>
                <li>
                    <a href="#"> <i class="fa-solid fa-wrench"></i> Configurations </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<nav>
    <div class="nav-search">
        <form onsubmit="preventDefault();" role="search">
            <label for="search">Search for stuff</label>
            <input autofocus id="search" placeholder="Search..." required type="search"/>
            <button type="submit">Go</button>
        </form>
    </div>
    <div class="nav-inner">
        <ul>
            <li><a href="#"><i class="fa-solid fa-circle-question"></i></a></li>
            <li><a href="#"><i class="fa-solid fa-gear"></i></a></li>
            <li><a href="#"><i class="fa-solid fa-bell"></i></a></li>
        </ul>
        <a class="nav-profile" href="#">
            <div class="nav-profile-image">
                <img alt="Profile image" src="res/avatar-empty.png"/>
            </div>
        </a>
    </div>
</nav>
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