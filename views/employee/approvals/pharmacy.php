<?php

use app\stores\EmployeeStore;
use app\views\employee\EmployeeViewComponents;

$components = new EmployeeViewComponents();
$store = EmployeeStore::getEmployeeStore();
$pharmacy = $store->aprv_one_obj;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin | Approve: Pharmacy</title>

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
            <div class="col card data-box">
                <div class="card-body">
                    <h5 class="card-title">Pharmacy Details</h5>
                    <div class="row">
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Username</th>
                                    <td><?php echo $store->aprv_one_obj->username?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Owner Name</th>
                                    <td><?php echo $store->aprv_one_obj->owner_name?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo $store->aprv_one_obj->email?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td><?php echo $store->aprv_one_obj->mobile?? "N/A" ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo $store->aprv_one_obj->name?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td><?php echo $store->aprv_one_obj->city?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><?php echo $store->aprv_one_obj->address?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Delivery Time</th>
                                    <td><?php echo $store->aprv_one_obj->delivery_time?? "N/A" ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Pharmacy Register Number</th>
                                    <td><?php echo $store->aprv_one_obj->phar_reg_no?? "N/A" ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Business Registration ID</th>
                                    <td><?php echo $store->aprv_one_obj->business_reg_id?? "N/A" ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col" style="text-align: center; margin-bottom: .5rem">
                            <span>Approve?</span>
                        </div>
                    </div>
                    <div class="row action-buttons">
                        <div class="col">
                            <a class="btn btn--success" href="/employee/approve/pharmacy?et=<?php echo $store->aprv_one_obj->username ?>&a=approve">
                                <i class="fa-solid fa-circle-check"></i>
                            </a>
                        </div>
                        <div class="col">
                            <a class="btn btn--danger" href="/employee/approve/pharmacy?et=<?php echo $store->aprv_one_obj->username ?>&a=ignore">
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
