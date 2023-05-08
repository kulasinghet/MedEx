<?php

use app\stores\EmployeeStore;
use app\views\employee\EmployeeViewComponents;

$components = new EmployeeViewComponents();
$store = EmployeeStore::getEmployeeStore();
$supplier = $store->g_obj;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin | Supplier Management</title>

    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
    <!-- Simplebar -->
    <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css"/>
    <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>
    <!-- g28 style -->
    <link rel="stylesheet" href="/scss/main.css" />
    <link rel="stylesheet" href="/scss/vendor/employee.css" />
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
        <!-- Details Form -->
        <div class="row justify-content-center">
            <div class="col card details-form">
                <div class="card-body">
                    <h4 class="card-title">Supplier Details</h4>
                    <form action="/employee/res/supplier/push" method="post">
                        <?php if ($supplier != null) { ?>
                            <div class="row margin-bottom">
                                <div class="col">
                                    <!-- General info -->
                                    <h5>General Details</h5>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-input disabled" id="username" value=<?php echo $supplier->username ?> disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-input" id="email" value=<?php echo $supplier->email ?>>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-input" id="address" rows="3">
                                            <?php echo $supplier->address ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Phone Number</label>
                                        <input type="text" class="form-input" id="mobile" value=<?php echo $supplier->mobile ?>>
                                    </div>

                                    <!-- Supplier info -->
                                    <h5>Supplier Information</h5>
                                    <div class="form-group">
                                        <label for="name">Supplier Name</label>
                                        <input type="text" class="form-input" id="name" value=<?php echo $supplier->name ?>>
                                    </div>

                                    <!-- Legal info -->
                                    <h5>Legal Information</h5>
                                    <div class="form-group">
                                        <label for="supp_reg_no">Supplier Registration No.</label>
                                        <input type="text" class="form-input" id="supp_reg_no" value=<?php echo $supplier->supp_reg_no ?>>
                                    </div>
                                    <div class="form-group">
                                        <label for="business_reg_id">Business Registration Id</label>
                                        <input type="text" class="form-input" id="business_reg_id" value=<?php echo $supplier->business_reg_id ?>>
                                    </div>
                                    <div class="form-group">
                                        <label for="supp_cert_id">Supplier Certificate Id</label>
                                        <input type="text" class="form-input" id="supp_cert_id" value=<?php echo $supplier->supp_cert_id ?>>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="row margin-bottom">
                                <div class="col">
                                    <!-- General info -->
                                    <h5>General Details</h5>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-input" id="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-input" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-input" id="address" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Phone Number</label>
                                        <input type="text" class="form-input" id="mobile">
                                    </div>

                                    <!-- Supplier info -->
                                    <h5>Supplier Information</h5>
                                    <div class="form-group">
                                        <label for="name">Supplier Name</label>
                                        <input type="text" class="form-input" id="name">
                                    </div>

                                    <!-- Legal info -->
                                    <h5>Legal Information</h5>
                                    <div class="form-group">
                                        <label for="supp_reg_no">Supplier Registration No.</label>
                                        <input type="text" class="form-input" id="supp_reg_no">
                                    </div>
                                    <div class="form-group">
                                        <label for="business_reg_id">Business Registration Id</label>
                                        <input type="text" class="form-input" id="business_reg_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="business_cert_name">Business Registration Certificate</label>
                                        <input class="form-input" type="file" id="business_cert_name" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label for="supp_cert_id">Supplier Certificate Id</label>
                                        <input type="text" class="form-input" id="supp_cert_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="supp_cert_name">Supplier Certificate</label>
                                        <input class="form-input" type="file" id="supp_cert_name" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col">
                                <div class="button-group center">
                                    <button type="submit" class="btn btn--primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
    configs.scssStylePath = '../scss/';

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
