<?php

use app\stores\EmployeeStore;
use app\views\employee\EmployeeViewComponents;

$components = new EmployeeViewComponents();
$store = EmployeeStore::getEmployeeStore();
$pharmacy = $store->g_obj;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin | Approve: Delivery Partner</title>

    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
    <!-- g28 style -->
    <link rel="stylesheet" href="/scss/main.css" />
    <link rel="stylesheet" href="/scss/vendor/employee.css" />
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
                    <h5 class="card-title">Delivery Partner Details</h5>
                    <!-- General info -->
                    <div class="row">
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Username</th>
                                    <td><?php echo $store->g_obj->username?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><?php echo $store->g_obj->address?? "N/A" ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo $store->g_obj->email?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td><?php echo $store->g_obj->mobile?? "N/A" ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Delivery info -->
                    <div class="row">
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo $store->g_obj->name?? "N/A" ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Deliverable Cities</th>
                                    <td><?php echo $store->g_obj->delivery_location?? "N/A" ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Vehicle info -->
                    <div class="row">
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Vehicle Register No.</th>
                                    <td><?php echo $store->g_obj->vehicle_no?? "N/A" ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Vehicle Type</th>
                                    <td><?php echo $store->g_obj->vehicle_type?? "N/A" ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Legal info -->
                    <div class="row">
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Driving License ID.</th>
                                    <td><?php echo $store->g_obj->license_id?? "N/A" ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Name in the license</th>
                                    <td><?php echo $store->g_obj->license_name?? "N/A" ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Legal Docs -->
                    <div class="row">
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>License</th>
                                    <td><a href="/public/uploads/delivery_partner/license/<?php echo $store->g_obj->username?? "N/A" ?>_license.png">Download</a></td>
                                </tr>
                                <tr>
                                    <th>Vehicle (Photo)</th>
                                    <td><a href="/public/uploads/delivery_partner/vehicle/<?php echo $store->g_obj->username?? "N/A" ?>_vehicle.png">Download</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <table class="status-table">
                                <tbody>
                                <tr>
                                    <th>Vehicle Registration form</th>
                                    <td><a href="/public/uploads/delivery_partner/vehicleReg/<?php echo $store->g_obj->username?? "N/A" ?>_vehicleReg.pdf">Download</a></td>
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
                            <a class="btn btn--success" href="/employee/approve/delivery?et=<?php echo $store->g_obj->username ?>&a=approve">
                                <i class="fa-solid fa-circle-check"></i>
                            </a>
                        </div>
                        <div class="col">
                            <a class="btn btn--danger" href="/employee/approve/delivery?et=<?php echo $store->g_obj->username ?>&a=ignore">
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
</body>
</html>
