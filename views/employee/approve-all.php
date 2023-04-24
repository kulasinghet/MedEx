<?php
use \app\views\employee\EmployeeViewComponents;

$components = new EmployeeViewComponents();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin | Approvals</title>

    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
    <!-- g28 style -->
    <link rel="stylesheet" href="../scss/main.css" />
    <script src="../js/g28-main.js"></script>
</head>
<body>
<!-- Section: Fixed Components -->
<?php
echo $components->createSidebar('approval');
echo $components->createNavbar();
?>
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
                        <th>Pharmacy Reg No.</th>
                        <th>City</th>
                        <th>Owner</th>
                        <th class="c" style="max-width: 100px">Action</th>
                    </tr>
                    <thead>
                    <tbody>
                    <tr>
                        <td>Thilakarathna Pharmacy</td>
                        <td>PH200789</td>
                        <td>Kurunegala</td>
                        <td>Thilakarathna</td>
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
                    <h5 class="card-title">Pharmacy Details</h5>
                    <div class="row">
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Username</th>
                                    <td>Test 1</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>Test 1</td>
                                </tr>
                                <tr>
                                    <th>Pharmacy Reg No.</th>
                                    <td>Test 1</td>
                                </tr>
                                <tr>
                                    <th>Pharmacy Certification</th>
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
                                    <th>Phone</th>
                                    <td>Test 1</td>
                                </tr>
                                <tr>
                                    <th>Business Reg No.</th>
                                    <td>Test 1</td>
                                </tr>
                                <tr>
                                    <th>Business Certification</th>
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
