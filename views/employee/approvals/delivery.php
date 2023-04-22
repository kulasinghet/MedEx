<?php

use app\stores\EmployeeStore;
use app\views\employee\EmployeeViewComponents;

$components = new EmployeeViewComponents();
// $store = EmployeeStore::getEmployeeStore();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin | Approve: Delivery</title>

    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
    <!-- Simplebar -->
    <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css"/>
    <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>
    <!-- g28 style -->
    <link rel="stylesheet" href="/scss/main.css" />
    <script src="/js/g28-main.js"></script>
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
        <!-- DataBox -->
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
        <!-- DataBox -->
    </div>
</div>
<!-- Section: Dashboard Layout -->

<!-- g28 styling framework -->
<script type="application/javascript">
    // you can configure variables in here.
    configs.stage = 'dev';
    configs.customFormElmPath = '/scss/components/forms';

    //logging
    logger("Logging g28 initial state before loading specialized JS files...");
    for (let property in configs) {
        logger(`> ${property}: ${configs[property]}`);
    }
</script>
<script src="/js/g28-forms.js"></script>
<!-- g28 styling framework -->
</body>
</html>
