<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin - Approvals - Delivery Partner</title>

    <link href="../../scss/main.css" rel="stylesheet"/>
    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
</head>
<body>
<!-- Section: Fixed Components -->
<div class="sidebar-foldable">
    <div class="sidebar-inner">
        <nav class="sidebar-header">
            <div class="sidebar-logo">
                <a href="#">
                    <img alt="MedEx logo" src="../../res/logo/logo-text_light.svg"/>
                </a>
            </div>
        </nav>
        <div class="sidebar-context">
            <h6 class="sidebar-context-title">Menu</h6>
            <ul class="main-buttons">
                <li>
                    <a href="/dashboard"> <i class="fa-solid fa-house"></i> Home </a>
                </li>
                <li>
                    <i class="fa-solid fa-check"></i>
                    Approvals
                    <ul class="hidden">
                        <li><a href="/employee/approvals/pharmacy"> Pharmacy </a></li>
                        <li><a href="/employee/approvals/supplier"> Supplier </a></li>
                        <li><a href="/employee/approvals/lab"> Lab </a></li>
                        <li class="disabled"><a href="/employee/approvals/delivery"> Delivery Partner </a></li>
                    </ul>
                </li>
                <li>
                    <a href="/employee/reports"> <i class="fa-solid fa-newspaper"></i> Reports </a>
                </li>
                <li>
                    <a href="#"> <i class="fa-solid fa-server"></i> Resources </a>
                    <ul class="hidden">
                        <li>Pharmacy</li>
                        <li>Supplier</li>
                        <li>Laboratory</li>
                        <li>Delivery Partner</li>
                    </ul>
                </li>
                <li>
                    <a href="/employee/configs"> <i class="fa-solid fa-wrench"></i> Configurations </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<nav>
    <div class="nav-inner">
        <ul>
            <li><a href="#"><i class="fa-solid fa-gear"></i></a></li>
            <li><a href="#"><i class="fa-solid fa-bell"></i></a></li>
            <li><a href="/logout"><i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
        <a class="nav-profile" href="#">
            <div class="nav-profile-image">
                <img alt="Profile image" src="../../res/avatar-empty.png"/>
            </div>
        </a>
    </div>
</nav>
<!-- Section: Fixed Components -->

<!-- Section: Dashboard Layout -->
<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <div class="row search-box margin-bottom">
            <div class="nav-search col">
                <form onsubmit="preventDefault();" role="search">
                    <label for="search">Search for stuff</label>
                    <input autofocus id="search" placeholder="Search..." required type="search"/>
                    <button type="submit">Go</button>
                </form>
            </div>
        </div>
        <div class="row margin-bottom">
            <div class="col">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>City</th>
                        <th>Vehicle Type</th>
                        <th>Delivery Location</th>
                        <th class="c" style="max-width: 100px">Action</th>
                    </tr>
                    <thead>
                    <tbody>
                    <tr>
                        <td>Thilakarathna</td>
                        <td>Kurunegala</td>
                        <td>Lorry</td>
                        <td>Dambulla</td>
                        <td>
                            <div class="row action-buttons">
                                <div class="col">
                                    <a class="btn btn--success">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="btn btn--danger">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col card">
                <div class="card-body">
                    <h5 class="card-title">Delivery Partner Details</h5>
                    <div class="row">
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Username</th>
                                    <td>Test 1</td>
                                </tr>
                                <tr>
                                    <th>Licence ID</th>
                                    <td>Test 1</td>
                                </tr>
                                <tr>
                                    <th>Vehicle No</th>
                                    <td>Test 1</td>
                                </tr>
                                <tr>
                                    <th>Max Load</th>
                                    <td>Test 1</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>Test 1</td>
                                </tr>
                                <tr>
                                    <th>Licence Name</th>
                                    <td>Test 1</td>
                                </tr>
                                <tr>
                                    <th>Vehicle Type</th>
                                    <td>Test 1</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>Test 1</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row action-buttons">
                        <div class="col">
                            <a class="btn btn--success">
                                <i class="fa-solid fa-circle-check"></i>
                            </a>
                        </div>
                        <div class="col">
                            <a class="btn btn--danger">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Section: Dashboard Layout -->
</body>
</html>